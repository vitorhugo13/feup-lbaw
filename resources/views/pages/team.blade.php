@extends('layouts.main')
{{-- TODO: the layout to be used must have the header and footer --}}
@section('content')

@push('styles')
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/team.css') }}" rel="stylesheet">
@endpush


<div class="team-page text-center">
    <h1> LAMA TEAM </h1>

    <div class="row my-lg-5">
        <div class="col col-12 col-lg-6 mb-4">
            <article class="d-flex flex-column flex-md-row align-items-center">
                <img src="{{ asset('image/team_photos/bernas.jpeg') }}" class="img rounded-circle mt-2" alt="Bernardo's photo">
                <div class="text-center text-md-left mt-2 ml-md-2">
                    <h2>Bernardo Santos</h2>
                    <p>
                        <i class="fas fa-envelope"></i>
                        up201706534@fe.up.pt
                        <i class="fas fa-envelope d-md-none"></i>
                    </p>
                    <p>
                        <i class="fas fa-birthday-cake"></i>
                        20 years
                        <i class="fas fa-birthday-cake d-md-none"></i>
                    </p>
                    <p>
                        <i class="fas fa-thumbtack"></i>
                        Viseu
                        <i class="fas fa-thumbtack d-md-none"></i>
                    </p>
                    <div class="description d-flex flex-row justify-content-start">
                        <i class="fas fa-info-circle"></i>
                        <p>Love programming and everything related to computers.</p>
                        <i class="fas fa-info-circle d-md-none"></i>
                    </div>
                </div>
            </article>
        </div>
        <div class="col col-12 col-lg-6 mb-4">
            <article class="d-flex flex-column flex-md-row flex-md-row-reverse align-items-center">
                <img src="{{ asset('image/team_photos/cajo.jpeg') }}" class="img rounded-circle mt-2" alt="Cajo's photo">
                <div class="text-center text-md-right mt-2 mr-md-2">
                    <h2>Carlos Jorge</h2>
                    <p>
                        <i class="fas fa-envelope d-md-none"></i>
                        up201706735@fe.up.pt
                        <i class="fas fa-envelope"></i>
                    </p>
                    <p>
                        <i class="fas fa-birthday-cake d-md-none"></i>
                        21 years
                        <i class="fas fa-birthday-cake"></i>
                    </p>
                    <p>
                        <i class="fas fa-thumbtack d-md-none"></i>
                        Viseu
                        <i class="fas fa-thumbtack"></i>
                    </p>
                    <div class="description d-flex flex-row justify-content-end">
                        <i class="fas fa-info-circle d-md-none"></i>
                        <p>Video games and programming are my passion.</p>
                        <i class="fas fa-info-circle"></i>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <div class="row my-lg-5">
        <div class="col col-12 col-lg-6 mb-4">
            <article class="d-flex flex-column flex-md-row align-items-center">
                <img src="{{ asset('image/team_photos/tito.jpeg') }}" class="img rounded-circle mt-2" alt="Tito's photo">
                <div class="text-center text-md-left mt-2 ml-md-2">
                    <h2>Tito Griné</h2>
                    <p>
                        <i class="fas fa-envelope"></i>
                        up201706732@fe.up.pt
                        <i class="fas fa-envelope d-md-none"></i>
                    </p>
                    <p>
                        <i class="fas fa-birthday-cake"></i>
                        21 years
                        <i class="fas fa-birthday-cake d-md-none"></i>
                    </p>
                    <p>
                        <i class="fas fa-thumbtack"></i>
                        Viseu
                        <i class="fas fa-thumbtack d-md-none"></i>
                    </p>
                    <div class="description d-flex flex-row justify-content-start">
                        <i class="fas fa-info-circle"></i>
                        <p>Fascinated by design and in love with economics.</p>
                        <i class="fas fa-info-circle d-md-none"></i>
                    </div>
                </div>
            </article>
        </div>
        <div class="col col-12 col-lg-6 mb-4">
            <article class="d-flex flex-column flex-md-row flex-md-row-reverse align-items-center">
                <img src="{{ asset('image/team_photos/vitorhugo.jpeg') }}" class="img rounded-circle mt-2" alt="Vitor's photo">
                <div class="text-center text-md-right mt-2 mr-md-2">
                    <h2>Vítor Gonçalves</h2>
                    <p>
                        <i class="fas fa-envelope d-md-none"></i>
                        up201703917@fe.up.pt
                        <i class="fas fa-envelope"></i>
                    </p>
                    <p>
                        <i class="fas fa-birthday-cake d-md-none"></i>
                        20 years
                        <i class="fas fa-birthday-cake"></i>
                    </p>
                    <p>
                        <i class="fas fa-thumbtack d-md-none"></i>
                        Fafe
                        <i class="fas fa-thumbtack"></i>
                    </p>
                    <div class="description d-flex flex-row justify-content-end">
                        <i class="fas fa-info-circle d-md-none"></i>
                        <p>Love sports. Family first. Delighted by the power of computing.</p>
                        <i class="fas fa-info-circle"></i>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>