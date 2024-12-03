<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Repositories\ReviewRepository;

class ReviewController extends Controller
{
    public function index()
    {
        return view('review.index', [
            'reviews' => ReviewRepository::query()->latest('id')->get(),
        ]);
    }

    public function delete(Review $review)
    {
        $review->delete();
        return redirect()->route('review.index')->withSuccess('Review removed');
    }
}
