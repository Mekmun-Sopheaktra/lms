@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Select Quiz Course')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <h3 class="mb-4 px-3">Select a course to view quizzes</h3>
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-4 mb-2">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $course->mediaPath }}" class="img-fluid w-100 rounded-start"
                                        alt="{{ $course->title }}" style="object-fit: cover; height: 137px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <a title="{{ $course->title }}" href="{{ route('course.edit', $course->id) }}">
                                            <h5 class="card-title">
                                                @if (strlen($course?->title) > 30)
                                                    {{ substr($course?->title, 0, 30) . '...' }}
                                                @else
                                                    {{ $course?->title ?? 'N/A' }}
                                                @endif
                                            </h5>
                                        </a>
                                        <p class="card-text mb-3"><span class="pe-3"> <strong>Category:</strong>
                                                @if (strlen($course?->category?->title ?? 'N/A') > 10)
                                                    {{ substr($course?->category?->title, 0, 10) . '...' }}
                                                @else
                                                    {{ $course?->category?->title ?? 'N/A' }}
                                                @endif
                                            </span>
                                            <span class="pe-3"><strong>Price:</strong>
                                                @if ($app_setting['currency_position'] == 'Left')
                                                    {{ $app_setting['currency_symbol'] }}{{ $course->price ? $course->price : $course->regular_price }}
                                                @else
                                                    {{ $course->price ? $course->price : $course->regular_price }}{{ $app_setting['currency_symbol'] }}
                                                @endif
                                            </span>
                                        </p>
                                        <a href="{{ route('quiz.index', $course->id) }}"
                                            class="btn btn-sm btn-primary bgBlue btn-dipBlue px-3">View
                                            Quizzes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="px-3 text-center">{{ $courses->links() }}</div>
        </div>

        <!-- ****End-Body-Section**** -->
    </div>
@endsection
