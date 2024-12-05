<x-app-layout>
    <x-slot name="title">
        Class List
    </x-slot>
    <div class="container" style="margin-top: 10px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Class List</li>
            </ol>
        </nav>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>List of Class</h4>
                    </div>
                    <div class="card-body">
                        @if (auth()->user()->role == 'admin')
                            <div class="text-right">
                                <a href="{{ route('kafa-class.create') }}" class="btn btn-success mb-3">Add Class</a>
                            </div>
                        @endif
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <th class="text-center bg-secondary">#</th>
                                <th class="text-center bg-secondary">Class Name</th>
                                <th class="text-center bg-secondary">Teacher</th>
                                <th class="text-center bg-secondary">Action</th>
                            </thead>
                            <tbody>
                                @if ($datas->count() > 0)
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach ($datas as $data)
                                        @php
                                            $index = $index + 1;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $index }}</td>
                                            <td class="text-center">{{ $data->class_name }}</td>
                                            <td class="text-center">{{ $data->teacher->name }}</td>
                                            <td class="text-center">
                                                <form
                                                    action="{{ route('kafa-class.destroy', ['kafa_class' => $data->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a href="{{ route('kafa-class.show', ['kafa_class' => $data->id]) }}"
                                                        class="btn btn-warning">View</a>
                                                    @if (auth()->user()->role == 'admin')
                                                        <a href="{{ route('kafa-class.edit', ['kafa_class' => $data->id]) }}"
                                                            class="btn btn-primary">Edit</a>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">No classes found.</td>
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
