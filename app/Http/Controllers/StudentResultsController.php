<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\StudentResult;
use App\Models\Student;
use App\Models\KafaClass;
use App\Models\Subject;
use App\Models\teacher;
use App\Models\Parents;






class StudentResultsController extends Controller

{
    public function index($ClassName)
    {

        $resultForm = StudentResult::get();

        $listStudent = Student::where('class', $ClassName)->get();



        // dd($listStudent);


        return view('manage-student-result.ViewListStudent', compact('listStudent', 'resultForm'));
    }

    public function showresultform($id)
    {
        $std = Student::findOrFail($id);

        $KafaClass = KafaClass::get();

        $SubjectDetails = Subject::where('Sclass_name', $std->class)->get();

        // dd($SubjectDetails);

        return view('manage-student-result.ViewInsertStudentResults', compact('std', 'SubjectDetails'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255|string'
        ]);

        StudentResult::create([
            'Students_id' => $request->studentID,
            'name' => $request->name,
            'className' => $request->StudentClass,
            'AmaliSolatMarks' => $request->AmaliSolatMarks ?? 0,
            'PenghayatanMarks' => $request->PenghayatanMarks ?? 0,
            'TilawahMarks' => $request->TilawahMarks ?? 0,
            'PelajaranJawiMarks' => $request->PelajaranJawiMarks ?? 0,
            'SirahMarks' => $request->SirahMarks ?? 0,
            'UlumMarks' => $request->UlumMarks ?? 0,
            'AdabMarks' => $request->AdabMarks ?? 0,
            'LughahMarks' => $request->LughahMarks ?? 0,


        ]);


        return redirect()->route('listStudent', ['ClassName' => $request->StudentClass])->with('message', 'Results saved successfully.');
    }

    public function edit($stdid)
    {
        $resultForm = StudentResult::where('Students_id', $stdid)->first();

        // Filter out subjects with zero marks
        $filteredResults = collect($resultForm->toArray())->filter(function ($value, $key) {
            return in_array($key, [
                'AmaliSolatMarks',
                'PenghayatanMarks',
                'TilawahMarks',
                'PelajaranJawiMarks',
                'SirahMarks',
                'UlumMarks',
                'AdabMarks',
                'LughahMarks'
            ]) && $value != 0;
        });

        return view('manage-student-result.ViewUpdateStudentResults', compact('resultForm', 'filteredResults'));
    }


    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:255|string'
        ]);

        StudentResult::findOrFail($id)->update([
            'Students_id' => $request->studentID,
            'name' => $request->name,
            'className' => $request->StudentClass,
            'AmaliSolatMarks' => $request->AmaliSolatMarks ?? 0,
            'PenghayatanMarks' => $request->PenghayatanMarks ?? 0,
            'TilawahMarks' => $request->TilawahMarks ?? 0,
            'PelajaranJawiMarks' => $request->PelajaranJawiMarks ?? 0,
            'SirahMarks' => $request->SirahMarks ?? 0,
            'UlumMarks' => $request->UlumMarks ?? 0,
            'AdabMarks' => $request->AdabMarks ?? 0,
            'LughahMarks' => $request->LughahMarks ?? 0,
        ]);

        return redirect()->back()->with('message', 'Success Update Marks');
        // return redirect()->route('resultform', ['id' => $request->studentID])->with('message', 'Success Update Marks');
    }

    public function destroy($stdid)
    {

        $resultForm = StudentResult::where('Students_id', $stdid)->first();
        $resultForm->delete();

        return redirect()->back()->with('message', 'Success Delete');
    }

    public function showListClass()
    {
        $userId = Auth::id();

        // Retrieve the teacher's record associated with the authenticated user
        $teacher = Teacher::where('user_id', $userId)->first();

        if (!$teacher) {
            // Handle the case where the teacher is not found, e.g., return an error or an empty collection
            dd('Teacher not found');
        }

        // Retrieve the list of classes for the found teacher
        $listClass = KafaClass::where('teacher_id', $teacher->id)->get();

        // dd($listClass);

        return view('manage-student-result.ViewListClass', compact('listClass'));
    }


    public function showAdminListClass()
    {

        $AdminlistClass = KafaClass::get();

        // dd($AdminlistClass);

        return view('manage-student-result.ViewListClassAdmin', compact('AdminlistClass'));
    }

    public function showAdminListStudent($ClassName)
    {

        $resultForm = StudentResult::get();

        $listStudent = Student::where('class', $ClassName)->get();

        $listSubject = Subject::where('Sclass_Name', $ClassName)->get();

        $kafaclass = KafaClass::where('class_name', $ClassName)->get();



        // dd($listStudent);


        return view('manage-student-result.ViewListStudentAdmin', compact('listStudent', 'resultForm', 'listSubject', 'kafaclass'));
    }

    public function showAddSubject($ClassName)
    {
        return view('manage-student-result.ViewAddNewSubject', compact('ClassName'));
    }


    public function Subjectstore(Request $request)
    {
        $request->validate([
            'SubjectName' => 'required|max:255|string',
            'SubjectCode' => 'required|string|max:255',
            'Sclass_Name' => 'required|string|max:255',  // Ensure this is part of the form
        ]);

        Subject::create([
            'SubjectName' => $request->SubjectName,
            'SubjectCode' => $request->SubjectCode,
            'Sclass_Name' => $request->Sclass_Name,
        ]);

        return redirect()->route('AdminlistStudent', ['ClassName' => $request->Sclass_Name])->with('message', 'Successfully added Subject');
    }


    public function destroySubject($subID)
    {
        $SubjectDelete = Subject::where('id', $subID)->first();
        $SubjectDelete->delete();

        return redirect()->back()->with('message', 'Success Delete Subject');
    }

    public function showParentStudent()
    {
        $id = Auth::id();

        // Retrieve the student records associated with the parent's ID
        $Liststudent = Student::where('parents_id', $id)->get();

        // Pass the data to the view as an associative array
        return view('manage-student-result.ViewParentsStudent', ['Liststudent' => $Liststudent]);
    }

    public function showResults($stdid)
    {

        $resultForm = StudentResult::where('Students_id', $stdid)->first();

        // Filter out subjects with zero marks
        $filteredResults = collect($resultForm->toArray())->filter(function ($value, $key) {
            return in_array($key, [
                'AmaliSolatMarks',
                'PenghayatanMarks',
                'TilawahMarks',
                'PelajaranJawiMarks',
                'SirahMarks',
                'UlumMarks',
                'AdabMarks',
                'LughahMarks'
            ]) && $value != 0;
        });

        return view('manage-student-result.ViewStudentResultsForm', compact('resultForm', 'filteredResults'));
    }
}
