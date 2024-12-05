<?php

namespace App\Http\Controllers;

use App\Models\KafaClass;
use App\Models\Parents;
use App\Models\Student;
use App\Models\StudentActivity;
use App\Models\StudentClass;
use App\Models\teacher;
use Illuminate\Http\Request;

class KafaClassController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $datas = KafaClass::get();
        } else if (auth()->user()->role == 'teacher') {
            $datas = KafaClass::whereHas('teacher', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
        } else if (auth()->user()->role == 'parent') {
            $datas = KafaClass::whereHas('students', function ($query) {
                $parent = Parents::with('student')->where('user_id', auth()->user()->id)->first();
                $query->where('student_id', $parent->student->id);
            })->get();
        }
        return view('manage-class.index', compact('datas'));
    }

    public function show($id)
    {
        $datas = StudentActivity::where('class_id', $id)->get();

        return view('manage-activity.index', compact('datas', 'id'));
    }

    public function edit($id)
    {
        $data = KafaClass::with('students.student')->find($id);
        $teachers = teacher::get();
        $students = Student::get();

        return view('manage-class.edit', compact('data', 'teachers', 'students'));
    }

    public function store(Request $request)
    {
        $class = KafaClass::create($request->all());

        foreach ($request->students as $student) {
            StudentClass::create([
                'class_id' => $class->id,
                'student_id' => $student
            ]);
        }

        return redirect()->route('kafa-class.index')->with('status', 'Class Created Successfully');
    }

    public function create()
    {
        $teachers = teacher::get();
        $students = Student::get();

        return view('manage-class.create', compact('teachers', 'students'));
    }

    public function update(Request $request, $id)
    {
        $data = KafaClass::find($id);
        $data->update($request->all());

        StudentClass::where('class_id', $data->id)->delete();

        foreach ($request->students as $student) {
            StudentClass::create([
                'class_id' => $data->id,
                'student_id' => $student
            ]);
        }

        return redirect()->route('kafa-class.index')->with('status', 'Class Updated Successfully');
    }

    public function destroy($id)
    {
        $data = KafaClass::find($id);
        $data->delete();

        return redirect()->route('kafa-class.index')->with('status', 'Class Deleted Successfully');
    }
}
