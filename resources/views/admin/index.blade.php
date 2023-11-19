@extends('admin.layouts.app')
@section('content')
Hello {{auth('admin')->user()->name}}
@endsection
