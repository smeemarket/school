@extends('layouts.teacherDesign')

@section('content')
    <h1>Notificaions</h1>

    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

@endsection