@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Chapter List')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Course</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chapter</li>
                    </ol>
                </nav>
                <div class="ms-auto">
                    <a href="{{ route('chapter.create', $course->id) }}" class="btn-shadow mr-3 btn btn-dark ms-auto">
                        + New Chapter
                    </a>
                </div>
            </div>

            <div class="ms-3 mb-4">
                <h4>Showing chapters for: {{ $course->title }}</h4>
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
                                            <th><strong>Chapter Title</strong></th>
                                            <th><strong>Sequence</strong></th>
                                            <th><strong>Number of Contents</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($chapters as $chapter)
                                            <tr>
                                                <td class="tableId">{{ $loop->iteration }}</td>
                                                <td class="tableId">
                                                    @if (strlen($chapter->title) > 50)
                                                        {{ substr($chapter->title, 0, 50) . '...' }}
                                                    @else
                                                        {{ $chapter->title }}
                                                    @endif
                                                </td>
                                                <td class="tableId">{{ $chapter->serial_number }}</td>
                                                <td class="tableId">{{ $chapter->contents->count() }}</td>
                                                <td class="tableAction">
                                                    <div class="action-icon">
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Edit Chapter"
                                                            href="{{ route('chapter.edit', $chapter->id) }}"><i
                                                                class="bi bi-pen Circleicon"></i></a>
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Delete Chapter" href="#"
                                                            onclick="deleteAction('{{ route('chapter.destroy', $chapter->id) }}')"><i
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
