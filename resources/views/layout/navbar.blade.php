<div class="navbar">
    <a class="logo" href="{{route('home')}}">eCommerce</a>
    <ul>
        @section('navbar')
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('about')}}">About</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>
        @show
    </ul>
</div>
