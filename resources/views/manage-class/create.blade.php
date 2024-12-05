<x-app-layout>
    <x-slot name="title">
        Add Class
    </x-slot>
    <div class="container" style="margin-top: 10px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kafa-class.index') }}">Class List</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Create Class</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Create Class</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action={{ route('kafa-class.store') }} enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Class Name</label>
                                        <input class="form-control" type="text" name="class_name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Teacher</label>
                                        <select name="teacher_id" id="" class="form-control" required>
                                            <option value="">Select Teacher</option>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Students</label>
                                        <select name="students[]" id="" class="form-control" multiple required>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-3 text-right">
                                <a href="{{ route('kafa-class.index') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
