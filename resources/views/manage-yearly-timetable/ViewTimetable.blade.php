<x-app-layout>
    <x-slot name="title">
        View Timetable
    </x-slot>
    <div class="container" style="margin-top: 10px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/timetable">Timetable</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Timetable</li>
            </ol>
        </nav>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Timetable for {{ $timetable->class->class_name }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center bg-secondary">Time</th>
                                    @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day)
                                    <th class="text-center bg-secondary">{{ Str::title($day) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timetableData as $row)
                                <tr>
                                    <td class="text-center">{{ $row['time'] }}</td>
                                    @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day)
                                    <td class="text-center">{!! ($row[$day]) !!}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>