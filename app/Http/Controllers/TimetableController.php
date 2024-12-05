<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\KafaClass;
use App\Models\Subject;
use App\Models\teacher;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    //method to display TimetableIndex
    public function index(){
        
        $user = auth()->user();

        if ($user->role === 'teacher') {
            $teacher = Teacher::where('user_id', $user->id)->first();
            $timetable = Timetable::select('id', 'class_id', 'teacher_id', 'year')
                ->where('teacher_id', $teacher->id)
                ->with('class', 'teacher') // eager load the class and teacher models
                ->orderBy('id', 'desc')
                ->get();
        } elseif ($user->role === 'parent') {
            $timetable = Timetable::with('class')
                ->whereIn('id', function ($query) {
                    $query->select('max_id')
                        ->from(function ($subQuery) {
                            $subQuery->from('timetables')
                                ->selectRaw('MAX(id) as max_id')
                                ->groupBy('class_id');
                        }, 'ubquery');
                })
                ->orderBy('id', 'desc')
                ->get();
        } else { // user is admin
            $timetable = Timetable::orderBy('id', 'desc')
                ->get();
        }

        return view('manage-yearly-timetable.TimetableIndex', compact('timetable', 'user'));
    }

    //method to display CreateTimetable
    public function showCreateTimetable(){
        $this->authorize('admin');
        $classes = KafaClass::all();
        $subjects = Subject::all();
        $teachers = teacher::all();
        return view('manage-yearly-timetable.CreateTimetable', compact('classes', 'subjects', 'teachers'));
    }
    
    //method to display ViewTimetable
    public function viewTimetable(int $id){
        
        $timetable = Timetable::findOrFail($id);
        $timetableData = [];
        $user = auth()->user();

        foreach (['08:30', '09:00', '09:30', '10:00', '10:30', '11:00'] as $start_time) {
            $row = [
                'time' => $start_time . ' - ' . date('H:i', strtotime($start_time) + 30 * 60),
            ];

            $is_recess = $start_time === '10:00';

            foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day) {
                if ($is_recess) {
                    $row[$day] = '<span class="recess">Rehat</span>';
                } else {
                    if ($user->role === 'teacher') {
                        $record = Timetable::where('class_id', $timetable->class_id)
                            ->where('start_time', $start_time)
                            ->where('weekday', $day)
                            ->where('teacher_id', $timetable->teacher->id) // Filter by the teacher's ID
                            ->with('subject', 'teacher')
                            ->first();
                    } else {
                        $record = Timetable::where('class_id', $timetable->class_id)
                            ->where('start_time', $start_time)
                            ->where('weekday', $day)
                            ->with('subject', 'teacher')
                            ->first();
                    }

                    if ($record) {
                        $row[$day] = '<span class="subject-name">' . ucwords(strtolower($record->subject->SubjectName)) . '</span>' .
                                    '<br><span class="teacher-name">(' . ucwords(strtolower($record->teacher->name)) . ')</span>';
                    } else {
                        $row[$day] = '-';
                    }
                }
            }
            $timetableData[] = $row;
        }

        return view('manage-yearly-timetable.ViewTimetable', compact('timetable', 'timetableData'));
    }
    
    //method to create timetable 
    public function createTimetable(Request $request){

        $this->authorize('admin');

        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'weekday' => 'required',
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'], // Ensure end_time is after start_time
            'year' => 'required|numeric',
        ], [
            'start_time.validate_time_range' => 'The selected start time is not valid.',
            'end_time.validate_time_range' => 'The selected end time is not valid.',
            'end_time.after' => 'The end time must be after the start time.',
            'start_time.date_format' => 'The start time field must match the format H:i.',
            'end_time.date_format' => 'The end time field must match the format H:i.',
        ]);

        // Check for existing entry with the same subject, weekday, and start_time
        $existingTimetable = Timetable::where([
            'subject_id' => $request->subject_id,
            'weekday' => $request->weekday,
            'start_time' => $request->start_time,
        ])->first();

        if ($existingTimetable) {
            return redirect('/timetable/create-timetable')
            ->withErrors(['subject_id' => 'This time slot is already occupied for the selected subject.'])
            ->withInput($request->input()); // Preserve form data for re-submission
        }

        //insert data into timetables table in db
        $timetable = new Timetable([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'weekday' => $request->weekday,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'year' => $request->year,
        ]);

        if ($timetable->save()) {
            // Record saved successfully
            return redirect('/timetable')->with('status', 'Timetable Created Successfully');
        } else {
            // Handle the error
            return "Error persists";
        }
    }
    
    //method to update timetable in db using put method
    public function updateTimetable(Request $request, int $id){

        $this->authorize('admin');

        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'weekday' => 'required',
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'year' => 'required|numeric',
        ]);

        //insert data into timetables table in db
        $timetable = Timetable::findOrFail($id);
        $timetable->class_id = $request->class_id;
        $timetable->subject_id = $request->subject_id;
        $timetable->teacher_id = $request->teacher_id;
        $timetable->weekday = $request->weekday;
        $timetable->start_time = $request->start_time;
        $timetable->end_time = $request->end_time;
        $timetable->year = $request->year;

        if ($timetable->update()) {
            // Record updated successfully
            return redirect('/timetable/'. $timetable->id .'/view-timetable')->with('status', 'Timetable Updated Successfully');
        } else {
            // Handle the error
            return "Error persists";
        }
    }
    
    //method to edit timetable (retrieve data from db & display in CreateTimetable)
    public function editTimetable(Request $request, int $id){

        $this->authorize('admin');

        $timetable = Timetable::findOrFail($id);
        $classes = KafaClass::all();
        $subjects = Subject::all();
        $teachers = teacher::all();
        return view('manage-yearly-timetable.CreateTimetable', compact('timetable', 'classes', 'subjects', 'teachers'));
    }

    //method to delete timetable via post
    public function deleteTimetable(int $id){
        
        $this->authorize('admin');

        $timetable = Timetable::findOrFail($id);
        $timetable->delete();
        return redirect()->back()->with('status', 'Timetable Deleted Successfully');
    }
}