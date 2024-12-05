<x-app-layout>
    <x-slot name="title">
        Edit Activity
    </x-slot>
    <div class="container" style="margin-top: 10px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kafa-class.index') }}">Class List</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('kafa-class.show', ['kafa_class' => $data->class_id]) }}">Activity
                        List</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">
                    Edit Activity</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Edit Activity</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action={{ route('student-activity.update', ['student_activity' => $data->id]) }}
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Activity Name</label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ $data->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Activity Description</label>
                                        <textarea class="form-control" cols="30" rows="5" name="description" required>{{ $data->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Start Time</label>
                                        <input class="form-control" type="time" name="start_at"
                                            value="{{ $data->start_at }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">End Time</label>
                                        <input class="form-control" type="time" name="end_at"
                                            value="{{ $data->end_at }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Date</label>
                                        <input class="form-control" type="date" name="date"
                                            value="{{ $data->date }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-3 text-right">
                                <a href="{{ route('kafa-class.show', ['kafa_class' => $data->class_id]) }}"
                                    class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
