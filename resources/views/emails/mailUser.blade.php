@extends('layout.master')

@section('title', 'Notify Email')

@section('contant')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{$title}}
            </div>

            <p>{{$content}}</p>
        </div>
    </div>
@endsection
