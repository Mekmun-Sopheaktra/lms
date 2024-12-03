@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Chapter Create')

@section('content')
    <style>
        .hidden {
            display: none;
        }
    </style>
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Course</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('chapter.index', $selectedCourse->id) }}">Chapter</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="main-card card d-flex h-100 flex-column">
                        <div class="card-body">
                            <h5 class="card-title py-2">New Chapter</h5>
                            <form action="{{ route('chapter.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label" for="categoryInput">Course</label>
                                            <select id="categoryInput"
                                                class="form-select select2bs4 select2-hidden-accessible" name="course_id"
                                                aria-hidden="true">
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        {{ $course->id === $selectedCourse->id ? 'selected="selected"' : '' }}">
                                                        {{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="titleInput" class="form-label">Chapter Title</label>
                                            <input type="text" name="title" required class="form-control"
                                                id="titleInput" placeholder="Enter chapter title"
                                                value="{{ old('title') }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="titleInput" class="form-label">Sequence</label>
                                            <input type="number" required min="1" name="serial_number"
                                                class="form-control" id="titleInput"
                                                value="{{ $course->chapters()->count() + 1 }}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="" class="form-label">Contents</label>
                                        <div id="contentsWrapper">
                                            @php $contentCounter = 1; @endphp
                                            @foreach (old('contents', [1 => ['title' => '', 'serial_number' => 1]]) as $key => $content)
                                                <div id="content{{ $key }}"
                                                    class="row border p-3 mb-3 d-flex align-items-center">
                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Content Title</label>
                                                            <input type="text" required
                                                                name="contents[{{ $key }}][title]"
                                                                class="form-control" placeholder="Enter content title"
                                                                value="{{ old("contents.$key.title") }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-1">
                                                        <div class="mb-3">
                                                            <label class="form-label">Sequence</label>
                                                            <input type="number" min="1" required
                                                                name="contents[{{ $key }}][serial_number]"
                                                                class="form-control"
                                                                value="{{ old("contents.$key.serial_number", $key) }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="mb-3">
                                                            <label for="fileInput" class="form-label">Select Video
                                                                Type</label>
                                                            <select class="form-select videoTypeSelect"
                                                                name="contents[{{ $key }}][video_type]"
                                                                data-key="{{ $key }}">
                                                                <option value="0">----Select Option----</option>
                                                                <option value="upload"
                                                                    {{ old("contents.$key.video_type") == 'upload' ? 'selected' : '' }}>
                                                                    Upload Files</option>
                                                                <option value="link"
                                                                    {{ old("contents.$key.video_type") == 'link' ? 'selected' : '' }}>
                                                                    Cloud Link</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-2 {{ old("contents.$key.video_type") == 'upload' ? '' : 'hidden' }}"
                                                        id="uploadSection{{ $key }}">
                                                        <div class="mb-3">
                                                            <label for="fileInput" class="form-label">Upload File</label>
                                                            <input name="contents[{{ $key }}][media]"
                                                                type="file" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-2 {{ old("contents.$key.video_type") == 'link' ? '' : 'hidden' }}"
                                                        id="linkSection{{ $key }}">
                                                        <div class="mb-3">
                                                            <label for="fileInput" class="form-label">Upload Link (only
                                                                embed link)</label>
                                                            <input name="contents[{{ $key }}][link]"
                                                                type="text" class="form-control"
                                                                value="{{ old("contents.$key.link") }}"
                                                                placeholder="Enter Video Links">
                                                        </div>
                                                    </div>

                                                    <div class="col-2 {{ old("contents.$key.video_type") == 'link' ? '' : 'hidden' }}"
                                                        id="duration{{ $key }}">
                                                        <div class="mb-3">
                                                            <label for="fileInput" class="form-label">Set Duration</label>
                                                            <input name="contents[{{ $key }}][duration]"
                                                                type="number" class="form-control"
                                                                value="{{ old("contents.$key.duration") }}"
                                                                placeholder="Enter Link Duration">
                                                        </div>
                                                    </div>

                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <input name="contents[{{ $key }}][is_forwardable]"
                                                                class="form-check-input"
                                                                id="isForwardable{{ $key }}" type="checkbox"
                                                                {{ old("contents.$key.is_forwardable") ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="isForwardable{{ $key }}">Forwardable</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <input name="contents[{{ $key }}][is_free]"
                                                                class="form-check-input" type="checkbox"
                                                                {{ old("contents.$key.is_free") ? 'checked' : '' }}
                                                                id="isFree{{ $key }}">
                                                            <label class="form-check-label"
                                                                for="isFree{{ $key }}">Free Content</label>
                                                        </div>
                                                    </div>

                                                    @if (old("contents.$key.title"))
                                                        <div class="col-2">
                                                            <button type="button" class="btn btn-danger mb-4"
                                                                onclick="removeContentItem({{ $key }})">-
                                                                Remove Content</button>
                                                        </div>
                                                    @endif

                                                </div>
                                                @php $contentCounter++; @endphp
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn bgBlue btn-dipBlue mb-4"
                                            onclick="addContentItem()">+
                                            Add Content
                                            Item</button>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn bgBlue btn-dipBlue">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ****End-Body-Section**** -->
    </div>

@endsection
@push('scripts')
    <script>
        var contentCounter = 2;

        function addContentItem() {
            var contentRow = `<div id="content${contentCounter}" class="row border p-3 mb-3">
                                    <div class="col-3">
                                        <div class="mb-3">
                                            <label class="form-label">Content Title</label>
                                            <input type="text" required name="contents[${contentCounter}][title]" class="form-control" placeholder="Enter content title">
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="mb-3">
                                            <label class="form-label">Sequence</label>
                                            <input type="number" min="1" required value="${contentCounter}" name="contents[${contentCounter}][serial_number]" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mb-3">
                                            <label for="fileInput" class="form-label">Select Video Type</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <select class="form-select" id="videoTypeSelect" name="contents[${contentCounter}][video_type]" data-counter="${contentCounter}">
                                                        <option value="0">----Select Option----</option>
                                                        <option value="upload">Upload Files</option>
                                                        <option value="link">Cloud Link</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2 hidden" id="uploadSection${contentCounter}">
                                                    <div class="mb-3">
                                                        <label for="fileInput" class="form-label">Upload File</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input name="contents[${contentCounter}][media]" type="file"
                                                                    class="custom-file-input form-control" id="fileInput">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-2 hidden" id="linkSection${contentCounter}">
                                                    <div class="mb-3">
                                                        <label for="fileInput" class="form-label">Upload Link(only embed link)</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input name="contents[${contentCounter}][link]" type="text"
                                                                    class="custom-file-input form-control" id="fileInput" placeholder="Enter Video Links">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                               <div class="col-2 hidden" id="duration${contentCounter}">
                                                    <div class="mb-3">
                                                        <label for="fileInput" class="form-label">Set Duration</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input name="contents[${contentCounter}][duration]" type="number"
                                                                    class="custom-file-input form-control" id="fileInput" placeholder="Enter Link Duration">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                    <div class="col-1">
                                        <div class="mb-3">
                                            <label for="fileInput" class="form-label">&nbsp;</label>
                                            <div class="form-check">
                                                <input name="contents[${contentCounter}][is_forwardable]"
                                                    class="form-check-input" type="checkbox" id="isForwardable${contentCounter}">
                                                <label class="form-check-label" for="isForwardable${contentCounter}">Forwardable</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="mb-3">
                                            <label for="fileInput" class="form-label">&nbsp;</label>
                                            <div class="form-check">
                                                <input name="contents[${contentCounter}][is_free]"
                                                    class="form-check-input" type="checkbox" id="isFree${contentCounter}">
                                                <label class="form-check-label" for="isFree${contentCounter}">Free Content</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <label class="form-label">&nbsp;</label>
                                        <div>
                                            <button type="button" class="btn btn-danger mb-4"
                                                onclick="removeContentItem(${contentCounter})">-
                                                Remove Content</button>
                                        </div>
                                    </div>
                                </div>`

            $('#contentsWrapper').append(contentRow);

            $(`#content${contentCounter} #videoTypeSelect`).on('change', function() {
                const selectedValue = $(this).val();
                const counter = $(this).data('counter');

                // Hide all sections
                $(`#uploadSection${counter}`).addClass('hidden');
                $(`#linkSection${counter}`).addClass('hidden');
                $(`#duration${counter}`).addClass('hidden');

                // Show the selected section
                if (selectedValue === 'upload') {
                    $(`#uploadSection${counter}`).removeClass('hidden');
                } else if (selectedValue === 'link') {
                    $(`#linkSection${counter}`).removeClass('hidden');
                    $(`#duration${counter}`).removeClass('hidden');
                }
            });

            ++contentCounter;
        }

        function removeContentItem(elementNumber) {
            $(`#content${elementNumber}`).remove();
        }
    </script>


    <script>
        // Event delegation for videoTypeSelect changes
        document.addEventListener('DOMContentLoaded', function() {
            const contentsWrapper = document.getElementById('contentsWrapper');

            contentsWrapper.addEventListener('change', function(event) {
                if (event.target.classList.contains('videoTypeSelect')) {
                    const selectedValue = event.target.value;
                    const key = event.target.getAttribute('data-key');

                    // Hide all sections
                    document.getElementById(`uploadSection${key}`).classList.add('hidden');
                    document.getElementById(`linkSection${key}`).classList.add('hidden');
                    document.getElementById(`duration${key}`).classList.add('hidden');

                    // Show the appropriate section based on the selection
                    if (selectedValue === 'upload') {
                        document.getElementById(`uploadSection${key}`).classList.remove('hidden');
                    } else if (selectedValue === 'link') {
                        document.getElementById(`linkSection${key}`).classList.remove('hidden');
                        document.getElementById(`duration${key}`).classList.remove('hidden');
                    }
                }
            });
        });
    </script>
@endpush
