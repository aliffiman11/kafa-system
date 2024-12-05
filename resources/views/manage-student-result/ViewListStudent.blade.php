<x-app-layout>

    <x-slot name="title">
        List of Student
    </x-slot>

    @if (session('message'))
        <script>
            alert('{{ session('message') }}');
        </script>
    @endif

    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Hello List Student</h4>
                        <a class="btn btn-primary float-end"
                            href="{{ route('listClass.view') }}">Back</a>
                    </div>
                    <div class="card-body">


                        <table class="table table-bordered table-stripped">
                            <thead>
                                <th class="text-center bg-secondary">ID</th>
                                <th class="text-center bg-secondary">Student List</th>
                                <th class="text-center bg-secondary">Class</th>
                                <th class="text-center bg-secondary col-3">Action</th>
                            </thead>
                            <tbody>
                                @foreach ($listStudent as $student)
                                    <tr>
                                        <td class="text-center">{{ $student->id }}</td>
                                        <td class="text-center">{{ $student->name }}</td>
                                        <td class="text-center">{{ $student->class }}</td>
                                        <td class="text-center">
                                            @if ($resultForm->where('Students_id', $student->id)->isEmpty())
                                                <a href="{{ route('resultform', ['id' => $student->id]) }}"
                                                    class="btn btn-primary">Add Results</a>
                                            @else
                                                <a href="{{ route('resultform.update', ['stdid' => $student->id]) }}"
                                                    class="btn btn-success mx-2">Edit</a>
                                                <a href="{{ route('destroy.data', ['id' => $student->id]) }}"
                                                    class="btn btn-danger mx-1">
                                                    Delete
                                                </a>
                                            @endif
                                        </td>
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
