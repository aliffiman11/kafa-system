<x-app-layout>

    <x-slot name="title">
        Timetable
    </x-slot>
    <div class="container" style="margin-top: 10px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Timetable</li>
            </ol>
        </nav>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>List of Timetable</h4>
                    </div>
                    <div class="card-body">
                        {{-- create timetable button is hidden if the user is not admin --}}
                        @can ('admin')
                        <a href="{{ url('timetable/create-timetable') }}" class="btn btn-success mb-3">Create timetable</a>
                        @endcan
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <th class="text-center bg-secondary">Id</th>
                                <th class="text-center bg-secondary">Class</th>
                                <th class="text-center bg-secondary">Year</th>
                                @if ($user->role === 'teacher')
                                <th class="text-center bg-secondary">Teacher</th>
                                @endif
                                <th class="text-center bg-secondary">Action</th>
                            </thead>
                            <tbody>
                                @if(isset($timetable) && count($timetable) > 0)
                                    @foreach ($timetable as $timetable)
                                        <tr>
                                            <td class="text-center">{{ $timetable->id }}</td>
                                            <td class="text-center">{{ $timetable->class->class_name }}</td>
                                            <td class="text-center">{{ $timetable->year }}</td>
                                            @if ($user->role === 'teacher')
                                            <td class="text-center">{{ $timetable->teacher->name }}</td>
                                            @endif
                                            <td class="text-center">
                                            <a href="{{ url('timetable/'.$timetable->id.'/view-timetable') }}" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            @can ('admin')
                                            <a href="{{ url('timetable/'.$timetable->id.'/update-timetable') }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            <a href="{{ url('timetable/'.$timetable->id.'/delete-timetable') }}" class="btn btn-danger" 
                                                onclick="return confirm('Are you sure to delete this timetable?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="{{ $user->role === 'teacher' ? '5' : '4' }}" class="text-center">No timetables found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>