@extends('layout.master')

@section('title', 'About')
@section('body')
    <div>
        <h1 class="">About</h1>
        <h1 class="">{!!$name!!}</h1>
    </div>
@endsection

@section('sidebar')
    <div>
        <h1 class="">@parent</h1>
        <h1 class="">Sidbar From About</h1>
    </div>
@endsection

@section('navbar')
    @parent
    <li><a href="{{route('category', '3')}}">Category</a></li>
@endsection
