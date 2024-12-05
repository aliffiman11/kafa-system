<x-app-layout>

    <x-slot name="title">
        Student Results
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
                        <h3>Add Student Results</h3>
                        <a class="btn btn-primary float-end"
                            href="{{ route('listStudent', ['ClassName' => $std->class]) }}">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('resultform.store') }}" method="POST" class="row g-3">
                            @csrf

                            <div>
                                <h3>Student Information</h3>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $std->name }}" class="form-control"
                                    readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Student ID</label>
                                <input type="text" name="studentID" value="{{ $std->id }}"
                                    class="form-control"readonly />
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Class</label>
                                <input type="text" name="StudentClass" value="{{ $std->class }}"
                                    class="form-control"readonly />
                            </div>
                            <div>
                                <hr>
                            </div>

                            <div>
                                <h3>Student Academic Subjects</h3>
                            </div>

                            @foreach ($SubjectDetails as $index => $Subject)
                                <div class="col-12 mb-3">
                                    <label class="form-label">{{ $index + 1 }}. {{ $Subject->SubjectName }}</label>
                                    <input type="text" name="{{ $Subject->SubjectCode }}" class="form-control"
                                        placeholder="0-100" />
                                </div>
                            @endforeach


                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
