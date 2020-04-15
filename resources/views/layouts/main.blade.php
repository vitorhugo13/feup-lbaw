@extends('layouts.headerless')

@section('content')

<header>
    <nav class="navbar">
    <a class="navbar-brand" href="{{url(/home)}}"><img src="../assets/logo_text.svg" width="50" alt="LAMA logo" /></a>
        <form class="expandable-search" action="{{url(/search)}}">
            <input type="search" placeholder="Search" aria-label="Search" />
        </form>
        <div class="d-flex align-items-center">
            <div class="dropdown d-flex align-items-center">
                <span class="badge badge-pill badge-light mr-2">3</span>
                <i class="fas fa-bell" data-toggle="dropdown"></i>
                <div class="dropdown-menu dropdown-menu-right notification-menu">
                    
                </div>
            </div>
            <div class="dropdown" style="margin-left: 1em">
                <img class="rounded-circle dropdown-toggle" data-toggle="dropdown" src="../assets/default_profile.png" height="30">
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="">Profile</a>
                    <a class="dropdown-item" href="">Feed</a>
                    <a class="dropdown-item" href="">Reports</a>
                    <a class="dropdown-item" href=""><i class="fas fa-ban"></i> 49:30:06</a>
                    <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url(/logout)}}">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
</header>
<form action="{{url(/search)}}" id="collapsed-search" class="d-flex flex-row justify-content-center">
    <input type="search" placeholder="Search" aria-label="Search" />
</form>

<div id="content">
    @yield('main-content')
</div>

<footer id="footer">
    <div id="footer-content" class="d-flex justify-content-between">
        <ul>
            <li>Contacts:</li>
            <li>lama@gmail.com</li>
            <li>+420 01 01 01 01</li>
            <li>Areosa, Porto</li>
        </ul>
        <ul>
            <li>About:</li>
        <li><a href="{{url(/team-page)}}">Team</a></li>
            <li><a href="{{url(/regulations-page)}}">Regulations</a></li>
        </ul>
    </div>
</footer>

@endsection

