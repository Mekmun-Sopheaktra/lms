<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Http\Resources\InstructorResource;
use App\Models\Instructor;
use App\Repositories\InstructorRepository;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('items_per_page', 10);
        $pageNumber = $request->input('page_number', 1);
        $skip = ($pageNumber - 1) * $perPage;

        $instructors = InstructorRepository::query()
            ->when($request->input('is_featured'), function ($query) {
                $query->where('is_featured', true);
            })
            ->skip($skip)->take($perPage)->get();

        return $this->json('Instructors found', [
            'instructors' => InstructorResource::collection($instructors),
            'total_items' => count($instructors),
        ]);
    }

    public function show(Instructor $instructor)
    {
        return $this->json('Instructor found', [
            'instructor' => InstructorResource::make($instructor),
            'courses' => CourseResource::collection($instructor->courses),
        ]);
    }
}
