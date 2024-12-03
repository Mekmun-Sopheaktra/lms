@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Course Create')

@push('styles')
    <style>
        .ck-editor__editable {
            min-height: 140px;
        }
    </style>
@endpush

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Course</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    <div class="main-card card d-flex h-100 flex-column">
                        <div class="card-body">
                            <h5 class="card-title py-2">New Course</h5>
                            <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="titleInput" class="form-label">Course Title<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <input type="text" name="title" value="{{ old('title') }}"
                                                class="form-control" id="titleInput" placeholder="Enter course title...">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" data-select2-id="62">
                                            <label class="form-label" for="categoryInput">Category<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <select id="categoryInput"
                                                class="form-select select2bs4 select2-hidden-accessible"
                                                style="width: 100%;" name="category_id" aria-hidden="true">
                                                <option value="0" {{ old('category_id') == 0 ? 'selected' : '' }}>
                                                    {{ __('-- Select Category --') }}
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group" data-select2-id="62">
                                            <label class="form-label" for="instructorInput">Instructor<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <select id="instructorInput"
                                                class="form-select select2bs4 select2-hidden-accessible"
                                                style="width: 100%;" name="instructor_id" aria-hidden="true">
                                                <option value="0" {{ old('instructor_id') == 0 ? 'selected' : '' }}>
                                                    {{ __('-- Select Category --') }}
                                                </option>
                                                @foreach ($instructors as $instructor)
                                                    <option value="{{ $instructor->id }}"
                                                        {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                                        {{ $instructor->user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('instructor_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="regularPriceInput" class="form-label">Regular Price<span
                                                    class="text-danger fw-bold">*</span> </label>
                                            <input type="number" value="{{ old('regular_price') }}" step="any"
                                                name="regular_price" min="1" class="form-control"
                                                id="regularPriceInput" placeholder="Enter regular price">
                                            @error('regular_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="priceInput" class="form-label">Offer Price</label>
                                            <input type="number" value="{{ old('price') }}" step="any" name="price"
                                                min="1" class="form-control" id="priceInput"
                                                placeholder="Enter offer price">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="imageInput" class="form-label">Thumbnail (JPG, JPEG, PNG)<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file w-100">
                                                    <input name="media" type="file"
                                                        class="form-control custom-file-input" id="imageInput">
                                                    @error('media')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="videoInput" class="form-label">Video (MP4, MPEG)</label>
                                            <div class="input-group">
                                                <div class="custom-file w-100">
                                                    <input name="video" type="file"
                                                        class="form-control custom-file-input" id="videoInput">
                                                    @error('video')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <div id="descriptionWrapper">

                                            @if (old('description'))
                                                @foreach (old('description') as $key => $description)
                                                    <div id="description{{$key}}">
                                                        <label class="form-label fw-bold">About the Course (Section
                                                            {{ $key }})</label>
                                                        <div class="row mb-3">
                                                            <div class="col-10 px-0">
                                                                <label for="headingInput" class="form-label">Title<span
                                                                        class="text-danger fw-bold">*</span></label>
                                                                <input type="text"
                                                                    value="{{ old('description.'.$key.'.heading') }}"
                                                                    name="description[{{ $key }}][heading]" class="form-control"
                                                                    id="headingInput"
                                                                    placeholder="Enter description title...">
                                                                @error('description.'.$key.'.heading')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-2 text-end">
                                                                <label class="form-label">&nbsp;</label>
                                                                <div>
                                                                    <button type="button" class="btn btn-danger mb-4"
                                                                        onclick="removeDescriptionItem({{ $key }})">-
                                                                        Remove Description</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <textarea id="texteditor{{$key}}" name="description[{{ $key }}][body]" class="form-control description-item"
                                                                placeholder="Enter description body...">{{ old('description.'.$key.'.body') }}</textarea>
                                                            @error('description.'.$key.'.body')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div id="description1">
                                                    <label class="form-label fw-bold">About the Course (Section 1)</label>
                                                    <div class="row mb-3">
                                                        <div class="col-10 px-0">
                                                            <label for="headingInput" class="form-label">Title<span
                                                                    class="text-danger fw-bold">*</span></label>
                                                            <input type="text"
                                                                value="{{ old('description.1.heading') }}"
                                                                name="description[1][heading]" class="form-control"
                                                                id="headingInput"
                                                                placeholder="Enter description title...">
                                                            @error('description.1.heading')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2 text-end">
                                                            <label class="form-label">&nbsp;</label>
                                                            <div>
                                                                <button type="button" class="btn btn-danger mb-4"
                                                                    onclick="removeDescriptionItem(1)" disabled>-
                                                                    Remove Description</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <textarea id="texteditor1" name="description[1][body]" class="form-control description-item"
                                                            placeholder="Enter description body...">{{ old('description.1.body') }}</textarea>
                                                        @error('description.1.body')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <button type="button" class="btn bgBlue btn-dipBlue"
                                            onclick="addDescriptionItem()">+ Add Description
                                            Item</button>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input id="activeInput" name="is_active" class="form-check-input"
                                                    type="checkbox">
                                                <label for="activeInput" class="form-check-label">Approve and
                                                    Publish</label>
                                            </div>
                                        </div>
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
    <script src="{{ asset('assets/scripts/ckeditor.js') }}"></script>
    <script>
        function ckeditorInit(index) {
            ClassicEditor
                .create(document.querySelector('#texteditor' + index))
                .catch(error => {
                    console.error(error);
                });
        }

        ckeditorInit(1);

        let oldDescriptions = @json("{{ old('description') ?? [] }}");
        if(oldDescriptions.length > 1){
            for (let index = 1; index < oldDescriptions.length; index++) {
                ckeditorInit(index+1);
            }
        }

        function addDescriptionItem() {
            var descriptionCounter = descriptionWrapper.childElementCount + 1;
            var descriptionRow = `<div id="description${descriptionCounter}">
                                <label class="form-label fw-bold">About the Course (Section ${descriptionCounter})</label>
                                <div class="row mb-3">
                                    <div class="col-10 px-0">
                                        <label for="headingInput" class="form-label">Title</label>
                                        <input type="text" required name="description[${descriptionCounter}][heading]"
                                            class="form-control" id="headingInput" placeholder="Enter description title...">
                                    </div>
                                    <div class="col-2 text-end">
                                        <label class="form-label">&nbsp;</label>
                                        <div>
                                            <button type="button" class="btn btn-danger mb-4"
                                                onclick="removeDescriptionItem(${descriptionCounter})">-
                                                Remove Description</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea id="texteditor${descriptionCounter}" name="description[${descriptionCounter}][body]" class="form-control description-item" placeholder="Enter description body..."></textarea>
                                </div>
                            </div>`;

            $('#descriptionWrapper').append(descriptionRow);

            ckeditorInit(descriptionCounter);

            ++descriptionCounter;
        }

        function removeDescriptionItem(elementNumber) {
            $(`#description${elementNumber}`).remove();
        }
    </script>
@endpush
