<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        if(!Auth::user()){
            return redirect('home');
        }
        $students = Student::orderBy('student_name')->get();
        $pdf=PDF::loadView('document', compact('students'))->setPaper('a4');
        return $pdf->download('management_class.pdf');
    }
}
