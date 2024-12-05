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
                        <h4>Admin List Student ({{ $listStudent->first()->class }})</h4>
                        <a class="btn btn-primary float-end" href="{{ route('AdminlistClass.view') }}">Back</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <th class="text-center bg-secondary">ID</th>
                                <th class="text-center bg-secondary">Student List</th>
                                <th class="text-center bg-secondary">Class</th>
                            </thead>
                            <tbody>
                                @foreach ($listStudent as $student)
                                    <tr>
                                        <td class="text-center">{{ $student->id }}</td>
                                        <td class="text-center">{{ $student->name }}</td>
                                        <td class="text-center">{{ $student->class }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" style="margin-top: 20px">
                    <div class="card-header">
                        <h4>List Subject ({{ $listStudent->first()->class }})</h4>
                        <a class="btn btn-primary float-end" href="{{ route('AddSubject', ['ClassName' => $listStudent->first()->class]) }}">Add Subject</a>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <th class="text-center bg-secondary">Subjects Name</th>
                                <th class="text-center bg-secondary col-3">Action</th>
                            </thead>
                            <tbody>
                                @foreach ($listSubject as $subject)
                                    <tr>
                                        <td class="text-center">{{ $subject->SubjectName }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('destroySubject.data', ['id' => $subject->id]) }}"
                                                class="btn btn-danger mx-1">
                                                Delete
                                            </a>
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
