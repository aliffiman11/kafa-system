<x-app-layout>

    <x-slot name="title">
        List of Class 
    </x-slot>

    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Admin List Class</h4>
                    </div>
                    <div class="card-body">


                        <table class="table table-bordered table-striped ">
                            <thead>
                                <th class="text-center bg-secondary">ID</th>
                                <th class="text-center bg-secondary">Class</th>
                                <th class="text-center bg-secondary">Action</th>
                            </thead>
                            <tbody>
                                @foreach ($AdminlistClass as $class)
                                    <tr>
                                        <td class="text-center">{{ $class->id }}</td>
                                        <td class="text-center">{{ $class->class_name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('AdminlistStudent', ['ClassName' => $class->class_name]) }}"
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
