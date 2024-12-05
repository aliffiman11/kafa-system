<x-app-layout>
    <x-slot name="title">
        {{ isset($timetable->id) ? 'Update Timetable' : 'Create Timetable' }}
    </x-slot>
    <div class="container" style="margin-top: 10px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/timetable">Timetable</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ isset($timetable->id) ? 'Update timetable' : 'Create timetable' }}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>{{ isset($timetable->id) ? 'Update timetable' : 'Create timetable' }}</h3>
                    </div>
                    <div class="card-body">
                        @if (isset ($timetable->id))
                            <form action="{{ url('timetable/'.$timetable->id.'/update-timetable') }}" method="POST" class="row g-3">
                            @method('PUT')
                        @else
                            <form action="{{ url('timetable/create-timetable') }}" method="POST" class="row g-3">
                        @endif
                            @csrf
                            <div>
                                <h5>{{ isset($timetable->id) ? 'Update the timetable details.' : 'Please enter the timetable details.' }}</h5>
                            </div>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="col-md-12">
                                <label for="class_id" class="form-label">Class</label>
                                <select class="form-select" name="class_id">
                                    {{-- <option selected>{{ isset($timetable->id) ? $timetable->class_id . ' - ' . $timetable->class->class_name : 'Select class' }}</option>
                                    @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->id }} - {{ $class->class_name }}</option>
                                    @endforeach --}}
                                    @if (isset($timetable->id))
                                    <option value="{{ $timetable->class_id }}" selected>{{ $timetable->class_id }} - {{ Str::title($timetable->class->class_name) }}</option>
                                    @else
                                        <option value="" selected>Select class</option>
                                    @endif
                                    @foreach ($classes as $class)
                                        @if (isset($timetable->id) && $class->id == $timetable->class_id)
                                            {{-- Skip the current timetable's class option, as it's already displayed above --}}
                                            @continue
                                        @endif
                                        <option value="{{ $class->id }}">{{ $class->id }} - {{ Str::title($class->class_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="subject_id" class="form-label">Subject</label>
                                <select class="form-select" name="subject_id">
                                    @if (isset($timetable->id))
                                    <option value="{{ $timetable->subject_id }}" selected>{{ $timetable->subject_id }} - {{ Str::title($timetable->subject->SubjectName) }}</option>
                                    @else
                                        <option value="" selected>Select subject</option>
                                    @endif
                                    @foreach ($subjects as $subject)
                                        @if (isset($timetable->id) && $subject->id == $timetable->subject_id)
                                            {{-- Skip the current timetable's subject option, as it's already displayed above --}}
                                            @continue
                                        @endif
                                        <option value="{{ $subject->id }}">{{ $subject->id }} - {{ Str::title($subject->SubjectName) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="teacher_id" class="form-label">Teacher</label>
                                <select class="form-select" name="teacher_id">                                    
                                    @if (isset($timetable->id))
                                    <option value="{{ $timetable->teacher_id }}" selected>{{ $timetable->teacher_id }} - {{ Str::title($timetable->teacher->name) }}</option>
                                    @else
                                        <option value="" selected>Select teacher</option>
                                    @endif
                                    @foreach ($teachers as $teacher)
                                        @if (isset($timetable->id) && $teacher->id == $timetable->teacher_id)
                                            {{-- Skip the current timetable's teacher option, as it's already displayed above --}}
                                            @continue
                                        @endif
                                        <option value="{{ $teacher->id }}">{{ $teacher->id }} - {{ Str::title($teacher->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="weekday" class="form-label">Weekday</label>
                                <select class="form-select" name="weekday">
                                    @if (isset($timetable->id))
                                        <option value="{{ $timetable->weekday }}" selected>{{ Str::title($timetable->weekday) }}</option>
                                    @else
                                        <option value="" selected>Select weekday</option>
                                    @endif
                                    @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day)
                                        @if (isset($timetable->id) && $timetable->weekday == $day)
                                            @continue
                                        @endif
                                        <option value="{{ $day }}">{{ Str::title($day) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="start_time" class="form-label">Start time</label>
                                <select class="form-select" name="start_time">
                                    @if (isset($timetable->id))
                                        <option value="{{ $timetable->start_time }}" selected>{{ $timetable->start_time }}</option>
                                    @else
                                        <option value="" selected>Select start time</option>
                                    @endif
                                    @foreach (['08:30', '09:00', '09:30', '10:30', '11:00'] as $time)
                                        @if (isset($timetable->id) && $timetable->start_time == $time)
                                            @continue
                                        @endif
                                        <option value="{{ $time }}">{{ $time }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="end_time" class="form-label">End time</label>
                                <select class="form-select" name="end_time">
                                    @if (isset($timetable->id))
                                        <option value="{{ $timetable->end_time }}" selected>{{ $timetable->end_time }}</option>
                                    @else
                                        <option value="" selected>Select end time</option>
                                    @endif
                                    @foreach (['09:00', '09:30', '10:00', '11:00', '11:30'] as $time)
                                        @if (isset($timetable->id) && $timetable->end_time == $time)
                                            @continue
                                        @endif
                                        <option value="{{ $time }}">{{ $time }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="year" class="form-label">Year</label>
                                <select class="form-select" name="year">
                                    @if (isset($timetable->id))
                                        <option value="{{ $timetable->year }}">{{ $timetable->year }}</option>
                                    @else
                                        <option value="" selected>Select year</option>
                                    @endif
                                    @if (!isset($timetable->id) || $timetable->year != 2024)
                                        <option value="2024">2024</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <a href="{{ url('/timetable') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success">{{ isset($timetable->id) ? 'Update': 'Save' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>