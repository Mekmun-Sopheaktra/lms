<?php

namespace App\Http\Controllers\WebAdmin;

use App\Events\MailSendEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\InstructorStoreRequest;
use App\Http\Requests\InstructorUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Instructor;
use App\Models\User;
use App\Repositories\AccountActivationRepository;
use App\Repositories\InstructorRepository;
use App\Repositories\UserRepository;

class InstructorController extends Controller
{
    public function index()
    {
        return view('instructor.index', [
            'instructors' => InstructorRepository::query()->withTrashed()->latest('id')->get(),
        ]);
    }

    public function featured()
    {
        return view('instructor.featured', [
            'instructors' => InstructorRepository::query()->withTrashed()->where('is_featured', true)->latest('id')->get(),
        ]);
    }

    public function create()
    {
        return view('instructor.create');
    }

    public function promote(User $user)
    {
        return view('instructor.promote', [
            'user' => $user
        ]);
    }

    public function migrate(InstructorStoreRequest $request, User $user)
    {
        if ($user->instructor) {
            return to_route('instructor.index')->withSuccess('User is already an instructor');
        }
        InstructorRepository::storeByRequest($request, $user->id);
        return to_route('instructor.index')->withSuccess('Promoted to instructor');
    }

    public function store(InstructorStoreRequest $instructorRequest, UserStoreRequest $userRequest)
    {
        $user = UserRepository::storeByRequest($userRequest);
        InstructorRepository::storeByRequest($instructorRequest, $user->id);

        // Set account activation and admin status
        if (isset($userRequest->is_active)) {
            $isActive = $userRequest->is_active == 'on' ? true : false;
        } else {
            $isActive = false;

            $code = rand(1111, 9999);

            AccountActivationRepository::create([
                'user_id' => $user->id,
                'code' => $code,
                'valid_until' => now()->addHour(),
            ]);

            try {
                MailSendEvent::dispatch($code, $user->email);
            } catch (\Exception $e) {
            }
        }

        $user->update([
            'is_active' => $isActive,
        ]);

        return to_route('instructor.index')->with('success', 'Instructor created');
    }

    public function edit(Instructor $instructor)
    {
        return view('instructor.edit', [
            'users' => UserRepository::query()->get(),
            'instructor' => $instructor,
        ]);
    }

    public function update(InstructorUpdateRequest $instructorRequest, UserUpdateRequest $userRequest, Instructor $instructor)
    {
        if (app()->isLocal() && $instructor->user->is_admin) {
            return to_route('instructor.index')->withError('Admin cannot be updated in demo mode');
        }

        UserRepository::updateByRequest($userRequest, $instructor->user);
        InstructorRepository::updateByRequest($instructorRequest, $instructor);

        // Set account activation and admin status
        if (isset($userRequest->is_active)) {
            $isActive = $userRequest->is_active == 'on' ? true : false;
        } else {
            $isActive = false;
        }

        $instructor->user->update([
            'is_active' => $isActive,
        ]);

        return to_route('instructor.index')->withSuccess('Instructor updated');
    }

    public function delete(Instructor $instructor)
    {
        $instructor->delete();
        return redirect()->route('instructor.index')->withSuccess('Instructor deleted');
    }

    public function restore(int $id)
    {
        InstructorRepository::query()->onlyTrashed()->find($id)->restore();

        return redirect()->route('instructor.index')->withSuccess('Instructor restored');
    }
}
