<x-app-layout>
    <x-slot name="title">
        Update Student Results
    </x-slot>

    @if (session('message'))
        <script>
            alert('{{ session('message') }}');
        </script>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Student Results</h4>
                        <a class="btn btn-primary float-end"
                            href="{{ route('listStudent', ['ClassName' => $resultForm->className]) }}">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.result', ['id' => $resultForm->id]) }}" method="POST"
                            class="row g-3">
                            @csrf
                            @method('PUT')

                            <div>
                                <h3>Student Information</h3>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $resultForm->name }}"
                                    class="form-control" readonly/>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Student ID</label>
                                <input type="text" name="studentID" value="{{ $resultForm->Students_id }}"
                                    class="form-control" readonly/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Class</label>
                                <input type="text" name="StudentClass" value="{{ $resultForm->className }}"
                                    class="form-control" readonly/>
                            </div>
                            <div>
                                <hr>
                            </div>

                            <div>
                                <h3>Student Academic Subjects</h3>
                            </div>

                            @foreach ($filteredResults as $subject => $marks)
                                <div class="col-12 mb-3">
                                    <label class="form-label">{{ $loop->iteration }}.
                                        {{ ucfirst(str_replace('Marks', '', $subject)) }}</label>
                                    <input type="text" name="{{ $subject }}" class="form-control"
                                        value="{{ $marks }}" placeholder="0-100" />
                                </div>
                            @endforeach


                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
