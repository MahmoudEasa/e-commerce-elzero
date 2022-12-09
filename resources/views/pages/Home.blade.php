@extends('layout.master')

@section('title', 'Home')
@section('contant')
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="..." />
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0">Home Page</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">{{__('messages.welcome')}}</p>
        </div>
    </header>
    {{-- <div>
        <h1 class="">Home Page</h1>
        <h1 class="">{{__('messages.welcome')}}</h1>
    </div> --}}
@endsection

@section('sidebar')
    {{-- <div>
        <h1 class="">@parent</h1>
    </div> --}}
@endsection

