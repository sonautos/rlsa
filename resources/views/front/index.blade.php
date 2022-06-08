@extends('front.layout')

@section('style')
    <style>
        .dropdown {
        position: relative;
        display: inline-block;
        }

        .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 12px 16px;
        z-index: 1;
        }

        .dropdown:hover .dropdown-content {
        display: block;
        }
    </style>
@endsection

@section('hero')
    {{-- <div class="s-hero__bg">
        <div class="gradient-overlay"></div>
    </div> --}}

    <div class="row s-hero__content">
        <div class="column">

            <h1>RLSA</h1>
            <div class="s-hero__content-about">

                <p style="font-family: 'Baloo 2', cursive">
                    <b style="font-family: 'Baloo 2', cursive; color: #393B36">R</b>emarketing & 
                    <b style="font-family: 'Baloo 2', cursive; color: #393B36">L</b>ogistics 
                    <b style="font-family: 'Baloo 2', cursive; color: #393B36">S</b>ervices<br>
                    <b style="font-family: 'Baloo 2', cursive; color: #393B36f">A</b>utomotive.
                </p>

                <footer>
                    <div class="s-hero__content-social">
                        <a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                        <a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                        <a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                        <a href="#0"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                    </div>
                </footer>
            </div>

        </div>
    </div>

    {{-- <div class="s-hero__video">
        <a class="s-hero__video-link" href="https://player.vimeo.com/video/242192856" data-lity="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 12l-18 12v-24z"/></svg>
            <span class="s-hero__video-text">{{trans('front.play-video')}}</span>
        </a>
    </div> --}}

    <div class="s-hero__scroll">
        <a href="#about" class="s-hero__scroll-link smoothscroll">
            Scroll Down
        </a>
    </div>
@endsection

@section('about')
    
@endsection

@section('service')
    
@endsection

@section('clients')
    
@endsection

@section('contact')
    <div class="row narrower s-contact__top h-text-center">
        <div class="column">
            <h3 class="h6">Get In Touch</h3>
            <h1 class="display-1">
            Have an idea or an epic project in mind? Talk to
            us. Let us work together and make something great.
            Shoot us a message at
            </h1>
        </div>
    </div> <!-- s-footer__top -->

    <div class="row h-text-center">
        <div class="column">
            <p class="s-contact__email">
                <a href="mailto:#0">hello@flare.com</a>
            </p>
        </div>
    </div>
@endsection