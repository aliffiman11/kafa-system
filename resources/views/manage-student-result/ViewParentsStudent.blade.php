<x-app-layout>

    <x-slot name="title">
        Add Student Results
    </x-slot>

    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Parent</h4>
                    </div>
                    <div class="card-body">


                        <table class="table table-bordered table-striped ">
                            <thead>
                                <th class="text-center bg-secondary">Name</th>
                                <th class="text-center bg-secondary">Class</th>
                                <th class="text-center bg-secondary">Action</th>
                            </thead>
                            <tbody>
                                @foreach ($Liststudent as $Pstudent)
                                    <tr>
                                        <td class="text-center">{{ $Pstudent->name }}</td>
                                        <td class="text-center">{{ $Pstudent->class }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('StudentResults.View', ['Student' => $Pstudent->id]) }}"
                                                class="btn btn-light">Show</a>
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
