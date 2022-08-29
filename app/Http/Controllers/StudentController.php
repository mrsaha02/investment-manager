<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    protected $result;
    protected $student;
    protected $subjects;

    public function add ()
    {
        return view('admin.student.add');
    }
    public function newStudent (Request $request)
    {

//        foreach ($request->subjects as $subject)
//        {
//            $this->result .= $subject.', ';
//        }
//        return $this->result = implode(', ' $request->subjects);

//        return $request;

        Student::newStudent($request);
        return redirect()->back()->with('message', 'Student Data saved successfully');
    }
    public function dashboard()
    {
        return view('admin.home.dashboard',[
            'students'=>Student::all(),
        ]);
    }

    public function edit ($id)
    {
        // dd($this);

        $this->student=Student::find($id);
        $this->subjects = explode(', ', $this->student->subjects);
        return view('admin.student.edit', [
            'student' => $this->student,
            'subjects' => $this->subjects,
        ]);
    }

    public function update (Request $request, $id)
    {
        Student::updateStudent ($request, $id);

        // dd($id);
        return redirect('/dashboard')->with('message','Data updated sucessfully.');
    }

    public function delete($id)
    {
        $this->student = Student::find($id);
        if (file_exists($this->student->image))
        {
            unlink($this->student->image);
        }
        $this->student->delete();
        return redirect()->back()->with('message','Student Info Deleted Successfully!');
    }

    // public function delete($id)
    // {
    //     $data = Student::find($id);
    //     if (file_exists($data->image))
    //     {
    //         unlink($data->image);
    //     }
    //     $data->delete();
    //     return redirect()->back()->with('message','Student Info Deleted Successfully!');
    // }

    //     public function delete($id)
    // {
    //     $this->alif = Student::find($id);
    //     if (file_exists($this->alif->image))
    //     {
    //         unlink($this->alif->image);
    //     }
    //     $this->alif->delete();
    //     return redirect()->back()->with('message','Student Info Deleted Successfully!');
    // }
}
