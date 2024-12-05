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
                        {{-- <a class="btn btn-primary float-end"
                            href="{{ route('listStudent', ['ClassName' => $std->class]) }}">Back</a> --}}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Subject.store') }}" method="POST" class="row g-3">
                            @csrf

                            <div>
                                <h3>Subject Details</h3>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Subject Name</label>
                                <select class="form-select" id="inputGroupSelect01" name="SubjectName">
                                    <option selected>Choose...</option>
                                    <option value="Amali Solat">01 - Amali Solat </option>
                                    <option value="Penghayatan Cara Hidup Islam">02 - Penghayatan Cara Hidup Islam (PCHI) </option>
                                    <option value="Tilawah Al-Quran">03 - Tilawah Al-Quran </option>
                                    <option value="Pelajaran Jawi dan Khat">04 - Pelajaran Jawi dan Khat </option>
                                    <option value="Sirah">05 - Sirah </option>
                                    <option value="Ulum Syariah">06 - Ulum Syariah (Ibadah & Aqidah) </option>
                                    <option value="Adab">07 - Adab (Akhlak Islamiah) </option>
                                    <option value="Lughah Al-Quran">08 - Lughah Al-Quran </option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Subject Code</label>
                                <select class="form-select" name="SubjectCode">
                                    <option selected>Choose...</option>
                                    <option value="AmaliSolatMarks">01 - Amali Solat </option>
                                    <option value="PenghayatanMarks">02 - Penghayatan Cara Hidup Islam (PCHI) </option>
                                    <option value="TilawahMarks">03 - Tilawah Al-Quran </option>
                                    <option value="PelajaranJawiMarks">04 - Pelajaran Jawi dan Khat </option>
                                    <option value="SirahMarks">05 - Sirah </option>
                                    <option value="UlumMarks">06 - Ulum Syariah (Ibadah & Aqidah) </option>
                                    <option value="AdabMarks">07 - Adab (Akhlak Islamiah) </option>
                                    <option value="LughahMarks">08 - Lughah Al-Quran </option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Class</label>
                                <input type="text" name="Sclass_Name" value="{{ $ClassName }}" class="form-control" readonly />
                            </div>
                            <div>
                                <hr>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
