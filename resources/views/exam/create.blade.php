@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Exam Create')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Course</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('exam.index', $selectedCourse->id) }}">Exam</a>
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
                            <h5 class="card-title py-2">New Exam</h5>
                            <form action="{{ route('exam.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <label for="titleInput" class="form-label">Exam Title</label>
                                            <input type="text" name="title" required class="form-control"
                                                id="titleInput" placeholder="Enter exam title" value="{{ old('title') }}">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="durationInput" class="form-label">Duration <small>(In
                                                    Minutes)</small></label>
                                            <input type="number" min="1" name="duration" required
                                                class="form-control" id="durationInput" placeholder="Enter exam duration"
                                                value="{{ old('duration') }}">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="perQuestionMarkInput" class="form-label">Marks Per
                                                Question<small></small></label>
                                            <input type="number" min="1" name="mark_per_question" required
                                                class="form-control" id="perQuestionMarkInput"
                                                placeholder="Enter marks per question"
                                                value="{{ old('mark_per_question') }}">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="passMarkInput" class="form-label">Pass Marks<small></small></label>
                                            <input type="number" min="1" name="pass_marks" required
                                                class="form-control" id="passMarkInput"
                                                placeholder="Enter marks required to pass" value="{{ old('pass_marks') }}">
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="d-flex">
                                            <label class="form-label fs-5 me-auto my-auto">Questions</label>
                                            <button type="button" class="btn bgBlue btn-dipBlue my-3 me-2"
                                                onclick="addMcqQuestionItem()">+
                                                Add Multiple Choice Question</button>
                                            <button type="button" class="btn bgBlue btn-dipBlue my-3"
                                                onclick="addBinaryChoiceQuestionItem()">+
                                                Add True/False Question</button>
                                        </div>

                                        {{-- @dd(old('questions')) --}}
                                        @if (old('questions'))
                                            @foreach (old('questions', []) as $key => $question)
                                                @if ($question['question_type'] == 'multiple_choice')
                                                    <div id="questionsWrapper">
                                                        <div id="question{{ $key }}" class="row border p-3 mb-3">
                                                            <input type="hidden"
                                                                name="questions[{{ $key }}][question_type]"
                                                                value="multiple_choice">
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label for="textInput" class="form-label">Question Title
                                                                        (can add
                                                                        multiple choice.)
                                                                    </label>
                                                                    <input type="text"
                                                                        name="questions[{{ $key }}][question_text]"
                                                                        class="form-control" id="textInput"
                                                                        placeholder="Enter question text"
                                                                        value="{{ old('questions.' . $key . '.question_text') }}">
                                                                    @error('questions.' . $key . '.question_text')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            @if (old('questions.' . $key . '.option_1.text'))
                                                                <div class="col-2">
                                                                    <label class="form-label">&nbsp;</label>
                                                                    <div>
                                                                        <button type="button" class="btn btn-danger mb-4"
                                                                            onclick="removeQuestionItem({{ $key }})">-
                                                                            Remove Question</button>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="row border py-3 mx-3">
                                                                <div class="col-6 d-flex mb-3">
                                                                    <label class="form-check-label my-auto me-3">
                                                                        Option A
                                                                    </label>
                                                                    <input class="form-control w-50 my-auto me-2"
                                                                        type="text"
                                                                        name="questions[{{ $key }}][option_1][text]"
                                                                        placeholder="Enter option text"
                                                                        value="{{ old('questions.' . $key . '.option_1.text') }}">
                                                                    <input class="form-check-input my-auto me-2"
                                                                        type="checkbox" value="1"
                                                                        name="questions[{{ $key }}][option_1][is_correct]"
                                                                        {{ old("questions.$key.option_1.is_correct") == 1 ? 'checked' : '' }}>
                                                                    <label class="form-check-label my-auto">
                                                                        Correct
                                                                    </label>
                                                                </div>
                                                                <div class="col-6 d-flex mb-3">
                                                                    <label class="form-check-label my-auto me-3">
                                                                        Option B
                                                                    </label>
                                                                    <input class="form-control w-50 my-auto me-2"
                                                                        type="text"
                                                                        name="questions[{{ $key }}][option_2][text]"
                                                                        placeholder="Enter option text"
                                                                        value="{{ old('questions.' . $key . '.option_2.text') }}">
                                                                    <input class="form-check-input my-auto me-2"
                                                                        type="checkbox" value="1"
                                                                        name="questions[{{ $key }}][option_2][is_correct]"
                                                                        {{ old("questions.$key.option_2.is_correct") == 1 ? 'checked' : '' }}>
                                                                    <label class="form-check-label my-auto">
                                                                        Correct
                                                                    </label>
                                                                </div>
                                                                <div class="col-6 d-flex">
                                                                    <label class="form-check-label my-auto me-3">
                                                                        Option C
                                                                    </label>
                                                                    <input class="form-control w-50 my-auto me-2"
                                                                        type="text"
                                                                        name="questions[{{ $key }}][option_3][text]"
                                                                        placeholder="Enter option text"
                                                                        value="{{ old('questions.' . $key . '.option_3.text') }}">
                                                                    <input class="form-check-input my-auto me-2"
                                                                        type="checkbox" value="1"
                                                                        name="questions[{{ $key }}][option_3][is_correct]"
                                                                        {{ old("questions.$key.option_3.is_correct") == 1 ? 'checked' : '' }}>
                                                                    <label class="form-check-label my-auto">
                                                                        Correct
                                                                    </label>
                                                                </div>
                                                                <div class="col-6 d-flex">
                                                                    <label class="form-check-label my-auto me-3">
                                                                        Option D
                                                                    </label>
                                                                    <input class="form-control w-50 my-auto me-2"
                                                                        type="text"
                                                                        name="questions[{{ $key }}][option_4][text]"
                                                                        placeholder="Enter option text"
                                                                        value="{{ old('questions.' . $key . '.option_4.text') }}">
                                                                    <input class="form-check-input my-auto me-2"
                                                                        type="checkbox" value="1"
                                                                        name="questions[{{ $key }}][option_4][is_correct]"
                                                                        {{ old("questions.$key.option_4.is_correct") == 1 ? 'checked' : '' }}>
                                                                    <label class="form-check-label my-auto">
                                                                        Correct
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($question['question_type'] == 'binary')
                                                    <div id="questionsWrapper">
                                                        <div id="question{{ $key }}"
                                                            class="row border p-3 mb-3">
                                                            <input type="hidden"
                                                                name="questions[{{ $key }}][question_type]"
                                                                value="binary">
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label for="textInput" class="form-label">Question
                                                                        Title</label>
                                                                    <input type="text" required
                                                                        name="questions[{{ $key }}][question_text]"
                                                                        class="form-control" id="textInput"
                                                                        placeholder="Enter question text"
                                                                        value="{{ old('questions.' . $key . '.question_text') }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-2">
                                                                <label class="form-label">&nbsp;</label>
                                                                <div>
                                                                    <button type="button" class="btn btn-danger mb-4"
                                                                        onclick="removeQuestionItem({{ $key }})">-
                                                                        Remove Question</button>
                                                                </div>
                                                            </div>
                                                            <div class="row border py-3 mx-3">
                                                                <div class="d-flex mb-3">
                                                                    <input class="form-check-input my-auto me-2"
                                                                        type="radio" value="yes"
                                                                        name="questions[{{ $key }}][correct_option]"
                                                                        {{ old("questions.$key.correct_option") == 'yes' ? 'checked' : '' }}>
                                                                    <label class="form-check-label my-auto">
                                                                        True
                                                                    </label>
                                                                </div>
                                                                <div class="d-flex">
                                                                    <input class="form-check-input my-auto me-2"
                                                                        type="radio" value="no"
                                                                        name="questions[{{ $key }}][correct_option]"
                                                                        {{ old("questions.$key.correct_option") == 'no' ? 'checked' : '' }}>
                                                                    <label class="form-check-label my-auto">
                                                                        False
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div id="questionsWrapper">
                                                <div id="question1" class="row border p-3 mb-3">
                                                    <input type="hidden" name="questions[1][question_type]"
                                                        value="multiple_choice">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="textInput" class="form-label">Question Title (can
                                                                add
                                                                multiple choice.)</label>
                                                            <input type="text" name="questions[1][question_text]"
                                                                class="form-control" id="textInput"
                                                                placeholder="Enter question text"
                                                                value="{{ old('questions.1.question_text') }}">
                                                            @error('questions.1.question_text')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    @if (old('questions.1.option_1.text'))
                                                        <div class="col-2">
                                                            <label class="form-label">&nbsp;</label>
                                                            <div>
                                                                <button type="button" class="btn btn-danger mb-4"
                                                                    onclick="removeQuestionItem(1)">-
                                                                    Remove Question</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="row border py-3 mx-3">
                                                        <div class="col-6 d-flex mb-3">
                                                            <label class="form-check-label my-auto me-3">
                                                                Option A
                                                            </label>
                                                            <input class="form-control w-50 my-auto me-2" type="text"
                                                                name="questions[1][option_1][text]"
                                                                placeholder="Enter option text"
                                                                value="{{ old('questions.1.option_1.text') }}">
                                                            <input class="form-check-input my-auto me-2" type="checkbox"
                                                                value="1" name="questions[1][option_1][is_correct]">
                                                            <label class="form-check-label my-auto">
                                                                Correct
                                                            </label>
                                                        </div>
                                                        <div class="col-6 d-flex mb-3">
                                                            <label class="form-check-label my-auto me-3">
                                                                Option B
                                                            </label>
                                                            <input class="form-control w-50 my-auto me-2" type="text"
                                                                name="questions[1][option_2][text]"
                                                                placeholder="Enter option text"
                                                                value="{{ old('questions.1.option_2.text') }}">
                                                            <input class="form-check-input my-auto me-2" type="checkbox"
                                                                value="1" name="questions[1][option_2][is_correct]">
                                                            <label class="form-check-label my-auto">
                                                                Correct
                                                            </label>
                                                        </div>
                                                        <div class="col-6 d-flex">
                                                            <label class="form-check-label my-auto me-3">
                                                                Option C
                                                            </label>
                                                            <input class="form-control w-50 my-auto me-2" type="text"
                                                                name="questions[1][option_3][text]"
                                                                placeholder="Enter option text"
                                                                value="{{ old('questions.1.option_3.text') }}">
                                                            <input class="form-check-input my-auto me-2" type="checkbox"
                                                                value="1" name="questions[1][option_3][is_correct]">
                                                            <label class="form-check-label my-auto">
                                                                Correct
                                                            </label>
                                                        </div>
                                                        <div class="col-6 d-flex">
                                                            <label class="form-check-label my-auto me-3">
                                                                Option D
                                                            </label>
                                                            <input class="form-control w-50 my-auto me-2" type="text"
                                                                name="questions[1][option_4][text]"
                                                                placeholder="Enter option text"
                                                                value="{{ old('questions.1.option_4.text') }}">
                                                            <input class="form-check-input my-auto me-2" type="checkbox"
                                                                value="1" name="questions[1][option_4][is_correct]">
                                                            <label class="form-check-label my-auto">
                                                                Correct
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
        var questionCounter = 2;

        function addMcqQuestionItem() {
            var questionRow = `<div id="question${questionCounter}" class="row border p-3 mb-3">
                                <input type="hidden" name="questions[${questionCounter}][question_type]" value="multiple_choice">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="textInput" class="form-label">Question Title (can add multiple choice.)</label>
                                            <input type="text" required name="questions[${questionCounter}][question_text]"
                                                class="form-control" id="textInput"
                                                placeholder="Enter question text">
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <label class="form-label">&nbsp;</label>
                                        <div>
                                            <button type="button" class="btn btn-danger mb-4"
                                                onclick="removeQuestionItem(${questionCounter})">-
                                                Remove Question</button>
                                        </div>
                                    </div>
                                    <div class="row border py-3 mx-3">
                                        <div class="col-6 d-flex mb-3">
                                            <label class="form-check-label my-auto me-3">
                                                Option A
                                            </label>
                                            <input class="form-control w-50 my-auto me-2" type="text"
                                                name="questions[${questionCounter}][option_1][text]" placeholder="Enter option text">
                                            <input class="form-check-input my-auto me-2" type="checkbox"
                                                value="1" name="questions[1][option_1][is_correct]">
                                            <label class="form-check-label my-auto">
                                                Correct
                                            </label>
                                        </div>
                                        <div class="col-6 d-flex mb-3">
                                            <label class="form-check-label my-auto me-3">
                                                Option B
                                            </label>
                                            <input class="form-control w-50 my-auto me-2" type="text"
                                                name="questions[${questionCounter}][option_2][text]" placeholder="Enter option text">
                                            <input class="form-check-input my-auto me-2" type="checkbox"
                                                value="1" name="questions[${questionCounter}][option_2][is_correct]">
                                            <label class="form-check-label my-auto">
                                                Correct
                                            </label>
                                        </div>
                                        <div class="col-6 d-flex">
                                            <label class="form-check-label my-auto me-3">
                                                Option C
                                            </label>
                                            <input class="form-control w-50 my-auto me-2" type="text"
                                                name="questions[${questionCounter}][option_3][text]" placeholder="Enter option text">
                                            <input class="form-check-input my-auto me-2" type="checkbox"
                                                value="1" name="questions[${questionCounter}][option_3][is_correct]">
                                            <label class="form-check-label my-auto">
                                                Correct
                                            </label>
                                        </div>
                                        <div class="col-6 d-flex">
                                            <label class="form-check-label my-auto me-3">
                                                Option D
                                            </label>
                                            <input class="form-control w-50 my-auto me-2" type="text"
                                                name="questions[${questionCounter}][option_4][text]" placeholder="Enter option text">
                                            <input class="form-check-input my-auto me-2" type="checkbox"
                                                value="1" name="questions[${questionCounter}][option_4][is_correct]">
                                            <label class="form-check-label my-auto">
                                                Correct
                                            </label>
                                        </div>
                                    </div>
                                </div>`

            $('#questionsWrapper').prepend(questionRow);

            ++questionCounter;
        }

        function addBinaryChoiceQuestionItem() {
            var questionRow = `<div id="question${questionCounter}" class="row border p-3 mb-3">
                                <input type="hidden" name="questions[${questionCounter}][question_type]" value="binary">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="textInput" class="form-label">Question Title</label>
                                            <input type="text" required name="questions[${questionCounter}][question_text]"
                                                class="form-control" id="textInput"
                                                placeholder="Enter question text">
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <label class="form-label">&nbsp;</label>
                                        <div>
                                            <button type="button" class="btn btn-danger mb-4"
                                                onclick="removeQuestionItem(${questionCounter})">-
                                                Remove Question</button>
                                        </div>
                                    </div>
                                    <div class="row border py-3 mx-3">
                                        <div class="d-flex mb-3">
                                            <input class="form-check-input my-auto me-2" type="radio"
                                                value="yes" name="questions[${questionCounter}][correct_option]">
                                            <label class="form-check-label my-auto">
                                                True
                                            </label>
                                        </div>
                                        <div class="d-flex">
                                            <input class="form-check-input my-auto me-2" type="radio"
                                                value="no" name="questions[${questionCounter}][correct_option]">
                                            <label class="form-check-label my-auto">
                                                False
                                            </label>
                                        </div>
                                    </div>
                                </div>`

            $('#questionsWrapper').prepend(questionRow);
            ++questionCounter;
        }

        function removeQuestionItem(elementNumber) {
            $(`#question${elementNumber}`).remove();
        }
    </script>
@endpush
