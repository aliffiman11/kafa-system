<x-app-layout>
    <x-slot name="title">
        View Activity
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
                    View Activity</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>View Activity</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"><strong>Activity Name</strong></label>
                                    <p>{{ $data->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"><strong>Activity Description</strong></label>
                                    <p>{{ $data->description }}</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"><strong>Start Time</strong></label>
                                    <p>{{ $data->start_at }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"><strong>End Time</strong></label>
                                    <p>{{ $data->end_at }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"><strong>Date</strong></label>
                                    <p>{{ $data->date }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-3 text-right">
                            <a href="{{ route('kafa-class.show', ['kafa_class' => $data->class_id]) }}"
                                class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
