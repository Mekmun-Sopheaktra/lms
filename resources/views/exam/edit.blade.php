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
                        <li class="breadcrumb-item"><a href="{{ route('exam.index', $exam->id) }}">Exam</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                            <h5 class="card-title py-2">Edit Exam</h5>
                            <form action="{{ route('exam.update', $exam->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label" for="categoryInput">Course</label>
                                            <select id="categoryInput"
                                                class="form-select select2bs4 select2-hidden-accessible" name="course_id"
                                                aria-hidden="true">
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        {{ $course->id === $exam->course?->id ? 'selected="selected"' : '' }}>
                                                        {{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="titleInput" class="form-label">Exam Title</label>
                                            <input type="text" name="title" value="{{ $exam->title }}" required
                                                class="form-control" id="titleInput" placeholder="Enter exam title">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="durationInput" class="form-label">Duration <small>(In
                                                    Minutes)</small></label>
                                            <input type="number" min="1" name="duration"
                                                value="{{ $exam->duration }}" required class="form-control"
                                                id="durationInput" placeholder="Enter exam duration">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="perQuestionMarkInput" class="form-label">Marks Per
                                                Question<small></small></label>
                                            <input type="number" min="1" name="mark_per_question"
                                                value="{{ $exam->mark_per_question }}" required class="form-control"
                                                id="perQuestionMarkInput" placeholder="Enter marks per question">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="passMarkInput" class="form-label">Pass Marks<small></small></label>
                                            <input type="number" min="1" name="pass_marks"
                                                value="{{ $exam->pass_marks }}" required class="form-control"
                                                id="passMarkInput" placeholder="Enter marks required to pass">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex">
                                            <label class="form-label fs-5 me-auto my-auto">Questions</label>
                                            <button type="button" class="btn bgBlue btn-dipBlue my-3 me-2"
                                                onclick="addMcqQuestionItem()">+
                                                Add Multiple Choice Question</button>
                                            <button type="button" class="btn bgBlue btn-dipBlue my-3 me-2"
                                                onclick="addSingleChoiceQuestionItem()">+
                                                Add Single Choice Question</button>
                                            <button type="button" class="btn bgBlue btn-dipBlue my-3"
                                                onclick="addBinaryChoiceQuestionItem()">+
                                                Add True/False Question</button>
                                        </div>
                                        <div id="questionsWrapper">
                                            @foreach ($exam->questions as $question)
                                                @if ($question->question_type == 'multiple_choice')
                                                    <div id="question{{ $loop->index }}" class="row border p-3 mb-3">
                                                        <input type="hidden"
                                                            name="questions[{{ $loop->index }}][question_type]"
                                                            value="multiple_choice">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="textInput" class="form-label">Question
                                                                    Title</label>
                                                                <input type="text" required
                                                                    name="questions[{{ $loop->index }}][question_text]"
                                                                    value="{{ $question->question_text }}"
                                                                    class="form-control" id="textInput"
                                                                    placeholder="Enter question text">
                                                            </div>
                                                        </div>

                                                        <div class="col-2">
                                                            <label class="form-label">&nbsp;</label>
                                                            <div>
                                                                <button type="button" class="btn btn-danger mb-4"
                                                                    onclick="removeQuestionItem({{ $loop->index }})">-
                                                                    Remove Question</button>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $options = json_decode($question->options);
                                                        @endphp
                                                        <div class="row border py-3 mx-3">
                                                            <div class="col-6 d-flex mb-3">
                                                                <label class="form-check-label my-auto me-3">
                                                                    Option A
                                                                </label>
                                                                <input class="form-control w-50 my-auto me-2"
                                                                    type="text"
                                                                    name="questions[{{ $loop->index }}][option_1][text]"
                                                                    value="{{ $options->option_1->text }}"
                                                                    placeholder="Enter option text">
                                                                <input class="form-check-input my-auto me-2"
                                                                    type="checkbox" value="1"
                                                                    name="questions[{{ $loop->index }}][option_1][is_correct]"
                                                                    @if ($options->option_1->is_correct) checked @endif>
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
                                                                    name="questions[{{ $loop->index }}][option_2][text]"
                                                                    value="{{ $options->option_2->text }}"
                                                                    placeholder="Enter option text">
                                                                <input class="form-check-input my-auto me-2"
                                                                    type="checkbox" value="1"
                                                                    name="questions[{{ $loop->index }}][option_2][is_correct]"
                                                                    @if ($options->option_2->is_correct) checked @endif>
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
                                                                    name="questions[{{ $loop->index }}][option_3][text]"
                                                                    value="{{ $options->option_3->text }}"
                                                                    placeholder="Enter option text">
                                                                <input class="form-check-input my-auto me-2"
                                                                    type="checkbox" value="1"
                                                                    name="questions[{{ $loop->index }}][option_3][is_correct]"
                                                                    @if ($options->option_3->is_correct) checked @endif>
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
                                                                    name="questions[{{ $loop->index }}][option_4][text]"
                                                                    value="{{ $options->option_4->text }}"
                                                                    placeholder="Enter option text">
                                                                <input class="form-check-input my-auto me-2"
                                                                    type="checkbox" value="1"
                                                                    name="questions[{{ $loop->index }}][option_4][is_correct]"
                                                                    @if ($options->option_4->is_correct) checked @endif>
                                                                <label class="form-check-label my-auto">
                                                                    Correct
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif ($question->question_type == 'single_choice')
                                                    <div id="question{{ $loop->index }}" class="row border p-3 mb-3">
                                                        <input type="hidden"
                                                            name="questions[{{ $loop->index }}][question_type]"
                                                            value="single_choice">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="textInput" class="form-label">Question
                                                                    Text</label>
                                                                <input type="text" required
                                                                    name="questions[{{ $loop->index }}][question_text]"
                                                                    value="{{ $question->question_text }}"
                                                                    class="form-control" id="textInput"
                                                                    placeholder="Enter question text">
                                                            </div>
                                                        </div>

                                                        <div class="col-2">
                                                            <label class="form-label">&nbsp;</label>
                                                            <div>
                                                                <button type="button" class="btn btn-danger mb-4"
                                                                    onclick="removeQuestionItem({{ $loop->index }})">-
                                                                    Remove Question</button>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $options = json_decode($question->options);
                                                        @endphp
                                                        <div class="row border py-3 mx-3">
                                                            <div class="col-6 d-flex mb-3">
                                                                <label class="form-check-label my-auto me-3">
                                                                    Option A
                                                                </label>
                                                                <input class="form-control w-50 my-auto me-2"
                                                                    type="text"
                                                                    name="questions[{{ $loop->index }}][option_1][text]"
                                                                    value="{{ $options->option_1->text }}"
                                                                    placeholder="Enter option text">
                                                                <input class="form-check-input my-auto me-2"
                                                                    type="radio" value="option_1"
                                                                    name="questions[{{ $loop->index }}][correct_option]"
                                                                    @if ($options->option_1->is_correct) checked @endif>
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
                                                                    name="questions[{{ $loop->index }}][option_2][text]"
                                                                    value="{{ $options->option_2->text }}"
                                                                    placeholder="Enter option text">
                                                                <input class="form-check-input my-auto me-2"
                                                                    type="radio" value="option_2"
                                                                    name="questions[{{ $loop->index }}][correct_option]"
                                                                    @if ($options->option_2->is_correct) checked @endif>
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
                                                                    name="questions[{{ $loop->index }}][option_3][text]"
                                                                    value="{{ $options->option_3->text }}"
                                                                    placeholder="Enter option text">
                                                                <input class="form-check-input my-auto me-2"
                                                                    type="radio" value="option_3"
                                                                    name="questions[{{ $loop->index }}][correct_option]"
                                                                    @if ($options->option_3->is_correct) checked @endif>
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
                                                                    name="questions[{{ $loop->index }}][option_4][text]"
                                                                    value="{{ $options->option_4->text }}"
                                                                    placeholder="Enter option text">
                                                                <input class="form-check-input my-auto me-2"
                                                                    type="radio" value="option_4"
                                                                    name="questions[{{ $loop->index }}][correct_option]"
                                                                    @if ($options->option_4->is_correct) checked @endif>
                                                                <label class="form-check-label my-auto">
                                                                    Correct
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif ($question->question_type == 'binary')
                                                    <div id="question{{ $loop->index }}" class="row border p-3 mb-3">
                                                        <input type="hidden"
                                                            name="questions[{{ $loop->index }}][question_type]"
                                                            value="binary">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="textInput" class="form-label">Question
                                                                    Text</label>
                                                                <input type="text" required
                                                                    name="questions[{{ $loop->index }}][question_text]"
                                                                    value="{{ $question->question_text }}"
                                                                    class="form-control" id="textInput"
                                                                    placeholder="Enter question text">
                                                            </div>
                                                        </div>

                                                        <div class="col-2">
                                                            <label class="form-label">&nbsp;</label>
                                                            <div>
                                                                <button type="button" class="btn btn-danger mb-4"
                                                                    onclick="removeQuestionItem({{ $loop->index }})">-
                                                                    Remove Question</button>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $options = json_decode($question->options);
                                                        @endphp
                                                        <div class="row border py-3 mx-3">
                                                            <div class="d-flex mb-3">
                                                                <input class="form-check-input my-auto me-2"
                                                                    type="radio" value="yes"
                                                                    name="questions[{{ $loop->index }}][correct_option]"
                                                                    @if ($options->yes->is_correct) checked @endif>
                                                                <label class="form-check-label my-auto">
                                                                    True
                                                                </label>
                                                            </div>
                                                            <div class="d-flex">
                                                                <input class="form-check-input my-auto me-2"
                                                                    type="radio" value="no"
                                                                    name="questions[{{ $loop->index }}][correct_option]"
                                                                    @if ($options->no->is_correct) checked @endif>
                                                                <label class="form-check-label my-auto">
                                                                    False
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn bgBlue btn-dipBlue">Update</button>
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
        var questionCounter = questionsWrapper.childElementCount;

        function addMcqQuestionItem() {
            var questionRow = `<div id="question${questionCounter}" class="row border p-3 mb-3">
                                <input type="hidden" name="questions[${questionCounter}][question_type]" value="multiple_choice">
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

        function addSingleChoiceQuestionItem() {
            var questionRow = `<div id="question${questionCounter}" class="row border p-3 mb-3">
                                <input type="hidden" name="questions[${questionCounter}][question_type]" value="single_choice">
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
                                        <div class="col-6 d-flex mb-3">
                                            <label class="form-check-label my-auto me-3">
                                                Option A
                                            </label>
                                            <input class="form-control w-50 my-auto me-2" type="text"
                                                name="questions[${questionCounter}][option_1][text]" placeholder="Enter option text">
                                            <input class="form-check-input my-auto me-2" type="radio"
                                                value="option_1" name="questions[${questionCounter}][correct_option]">
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
                                            <input class="form-check-input my-auto me-2" type="radio"
                                                value="option_2" name="questions[${questionCounter}][correct_option]">
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
                                            <input class="form-check-input my-auto me-2" type="radio"
                                                value="option_3" name="questions[${questionCounter}][correct_option]">
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
                                            <input class="form-check-input my-auto me-2" type="radio"
                                                value="option_4" name="questions[${questionCounter}][correct_option]">
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
