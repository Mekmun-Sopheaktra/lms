@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Quiz List')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Course</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quiz</li>
                    </ol>
                </nav>
                <div class="ms-auto">
                    <a href="{{ route('quiz.create', $course->id) }}" class="btn-shadow mr-3 btn btn-dark ms-auto">
                        + New Quiz
                    </a>
                </div>
            </div>

            <div class="ms-3 mb-4">
                <h4>Showing quizzes for: {{ $course->title }}</h4>
            </div>

            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table id="dataTable" class="table">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Quiz Title</strong></th>
                                            <th><strong>Total Questions</strong></th>
                                            <th><strong>Duration Per Question</strong></th>
                                            <th><strong>Mark Per Question</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quizzes as $quiz)
                                            <tr>
                                                <td class="tableId">{{ $loop->iteration }}</td>
                                                <td class="tableId">
                                                    @if (strlen($quiz->title) > 50)
                                                        {{ substr($quiz->title, 0, 50) . '...' }}
                                                    @else
                                                        {{ $quiz->title }}
                                                    @endif
                                                </td>
                                                <td class="tableId">{{ $quiz->questions->count() }}</td>
                                                <td class="tableId">{{ $quiz->duration_per_question }}</td>
                                                <td class="tableId">{{ $quiz->mark_per_question }}</td>
                                                <td class="tableAction">
                                                    <div class="action-icon">
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip" data-bs-title="Edit Quiz"
                                                            href="{{ route('quiz.edit', $quiz->id) }}"><i
                                                                class="bi bi-pen Circleicon"></i></a>
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Delete Quiz" href="#"
                                                            onclick="deleteAction('{{ route('quiz.destroy', $quiz->id) }}')"><i
                                                                class="bi bi-trash3 Circleicon"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ****End-Body-Section**** -->
    </div>
@endsection
