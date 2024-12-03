@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Exam List')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Course</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Exam</li>
                    </ol>
                </nav>
                <div class="ms-auto">
                    <a href="{{ route('exam.create', $course->id) }}" class="btn-shadow mr-3 btn btn-dark ms-auto">
                        + New Exam
                    </a>
                </div>
            </div>

            <div class="ms-3 mb-4">
                <h4>Showing exams for: {{ $course->title }}</h4>
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
                                            <th><strong>Exam Title</strong></th>
                                            <th><strong>Total Questions</strong></th>
                                            <th><strong>Duration</strong></th>
                                            <th><strong>Mark Per Question</strong></th>
                                            <th><strong>Pass Marks</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exams as $exam)
                                            <tr>
                                                <td class="tableId">{{ $loop->iteration }}</td>
                                                <td class="tableId">
                                                    @if (strlen($exam->title) > 50)
                                                        {{ substr($exam->title, 0, 50) . '...' }}
                                                    @else
                                                        {{ $exam->title }}
                                                    @endif
                                                </td>
                                                <td class="tableId">{{ $exam->questions->count() }}</td>
                                                <td class="tableId">{{ $exam->duration }}</td>
                                                <td class="tableId">{{ $exam->mark_per_question }}</td>
                                                <td class="tableId">{{ $exam->pass_marks }}</td>
                                                <td class="tableAction">
                                                    <div class="action-icon">
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip" data-bs-title="Edit Exam"
                                                            href="{{ route('exam.edit', $exam->id) }}"><i
                                                                class="bi bi-pen Circleicon"></i></a>
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Delete Exam" href="#"
                                                            onclick="deleteAction('{{ route('exam.destroy', $exam->id) }}')"><i
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
