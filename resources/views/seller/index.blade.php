@extends('seller.layouts.app')
@section('content')
Hello {{auth('seller')->user()->name}}
@endsection
