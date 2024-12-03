<?php

namespace App\Http\Controllers\WebAdmin;

use App\Events\MailSendEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\AccountActivationRepository;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'users' => UserRepository::query()->withTrashed()->latest('id')->get(),
        ]);
    }

    public function admin()
    {
        return view('user.index', [
            'users' => UserRepository::query()->where('is_admin', true)->withTrashed()->latest('id')->get(),
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserStoreRequest $request)
    {
        $newUser = UserRepository::storeByRequest($request);

        // Set account activation and admin status
        if (isset($request->is_active)) {
            $isActive = $request->is_active == 'on' ? true : false;
        } else {
            $isActive = false;

            $code = rand(1111, 9999);

            AccountActivationRepository::create([
                'user_id' => $newUser->id,
                'code' => $code,
                'valid_until' => now()->addHour(),
            ]);

            try {
                MailSendEvent::dispatch($code, $newUser->email);
            } catch (\Exception $e) {
            }
        }

        if (isset($request->is_admin)) {
            $isAdmin = $request->is_admin == 'on' ? true : false;
        } else {
            $isAdmin = false;
        }

        $newUser->update([
            'is_active' => $isActive,
            'is_admin' => $isAdmin
        ]);

        return to_route('user.index')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        if (app()->isLocal() && $user->is_admin) {
            return to_route('user.index')->withError('Admin cannot be updated in demo mode');
        }

        UserRepository::updateByRequest($request, $user);

        // Set account activation and admin status
        if (isset($request->is_active)) {
            $isActive = $request->is_active == 'on' ? true : false;
        } else {
            $isActive = false;
        }

        if (isset($request->is_admin)) {
            $isAdmin = $request->is_admin == 'on' ? true : false;
        } else {
            $isAdmin = false;
        }

        $user->update([
            'is_active' => $isActive,
            'is_admin' => $isAdmin
        ]);

        return to_route('user.index')->withSuccess('User updated');
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withSuccess('User deleted');
    }

    public function restore(int $id)
    {
        UserRepository::query()->onlyTrashed()->find($id)->restore();

        return redirect()->route('user.index')->withSuccess('User restored');
    }
}
