<?php

namespace App\Http\Controllers;

use App\Models\StudentActivity;
use Illuminate\Http\Request;

class StudentActivityController extends Controller
{
    public function show($id)
    {
        $data = StudentActivity::find($id);

        return view('manage-activity.show', compact('data'));
    }

    public function edit($id)
    {
        $data = StudentActivity::find($id);

        return view('manage-activity.edit', compact('data'));
    }

    public function store(Request $request)
    {
        StudentActivity::create($request->all());

        return redirect()->route('kafa-class.show', ['kafa_class' => $request->class_id])->with('status', 'Activity Created Successfully');
    }

    public function create(Request $request)
    {
        $class_id = $request->class_id;

        return view('manage-activity.create', compact('class_id'));
    }

    public function update(Request $request, $id)
    {
        $data = StudentActivity::find($id);
        $data->update($request->all());

        return redirect()->route('kafa-class.show', ['kafa_class' => $data->class_id])->with('status', 'Activity Updated Successfully');
    }

    public function destroy($id)
    {
        $data = StudentActivity::find($id);
        $data->delete();

        return redirect()->route('kafa-class.show', ['kafa_class' => $data->class_id])->with('status', 'Activity Deleted Successfully');
    }
}
