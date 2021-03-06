@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Update Student</h1>
        <a href="{{route('students.index')}}" class="btn btn-primary pull-right">Back</a>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST" action="{{ route('students.update', $student->id) }}">
                    @csrf
                    <div class="form-group {{$errors->has('nim') ? 'has-error:': ''}}">
                        <label for="nim">NIM  : </label>
                        <input type="text" class="form-control" name="nim" value="{{$student->nim}}">
                        <span class="help-block"> 
                            @if($errors->has('nim'))
                                {{$errors->first('nim')}}
                            @endif
                        </span>
                    </div> 
                    <div class="form-group {{$errors->has('student_name') ? 'has-error:': ''}}">
                        <label for="student_name">Student Name : </label>
                        <input type="text" class="form-control" name="student_name" 
                            value="{{$student->student_name}}">
                        <span class="help-block"> 
                            @if($errors->has('student_name'))
                                {{$errors->first('student_name')}}
                            @endif
                        </span>
                    </div> 
                    <div class="col-md-8">
                        <label for="student_name">Class Name : </label>
                        <select name="classroom_id" class="form-control" required>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">{{ $classroom->class_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('classroom_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('classroom_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Update</a>
                    @csrf
                    @method('PATCH')
                </form>
            </div>
        </div>
    </div>
@endsection
