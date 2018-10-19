<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()){
            return redirect('home');
        }
        $students= Student::latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()){
            return redirect('home');
        }
        $classrooms = Classroom::orderBy('class_name')->get();
        return view('students.create', compact('classrooms'));
        // return $classrooms;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()){
            return redirect('home');
        }
        Student::create([
            'nim' => $request->get('nim'),
            'student_name' => $request->get('student_name'),
            'classroom_id' => $request->get('classroom_id')
        ]);
        return redirect('/students');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        if(!Auth::user()){
            return redirect('home');
        }
        return view('students.view', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        if(!Auth::user()){
            return redirect('home');
        }
        $classrooms = Classroom::orderBy('class_name')->get();
        return view('students.edit', compact('student','classrooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        if(!Auth::user()){
            return redirect('home');
        }
        $student->update($request->all());
        return redirect('/students')->with('success', 
            'You have updated students successfully ! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if(!Auth::user()){
            return redirect('home');
        }
        $student->delete();
        return redirect('/students')->with('success', 
            'You have success delete student ! ');
    }

    public function getPdf()
    {
        if(!Auth::user()){
            return redirect('home');
        }
        $pdf=PDF::loadView('document');
        return $pdf->download('management_class.pdf');
    }
}
