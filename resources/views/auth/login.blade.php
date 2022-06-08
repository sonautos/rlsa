@extends('layouts.firstpage')

@section('styles')
<style>
    html, body {
        background-color: #393B36;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .bg-page{
    background-color: #EAEAEA;
    }

    .btn-about {
        display: inline-block;
        padding: 10px 30px;
        background: var(--primary-color);
        color: #fff;
        border-radius: 5px;
        border: solid #fff 1px;
        margin-top: 25px;
        opacity: 0.7;
    }

    .btn-about:hover {
        transform: scale(0.98);
    }

    #about {
        padding: 40px;
        text-align: center;
    }

    #about p {
        font-size: 1.2rem;
        max-width: 600px;
        margin: auto;
    }

    #about h2 {
        margin: 30px 0;
        color: var(--primary-color);
    }

    .social a {
        margin: 0 5px;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 64px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
    .i-text{
        color: #D12F3F;
    }

    <!-- accordéon -->
    ing: 0;
    }
    body {
        background: #ccc;
        font-family: arial, verdana, tahoma;
    }

    /*Time to apply widths for accordian to work
    Width of image = 640px
    total images = 5
    so width of hovered image = 640px
    width of un-hovered image = 40px - you can set this to anything
    so total container width = 640 + 40*4 = 800px;
    default width = 800/5 = 160px;
    */

    .accordian {
        width: 805px; height: 320px;
        overflow: hidden;

        /*Time for some styling*/
        margin: 100px auto;
        box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.35);
        -webkit-box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.35);
        -moz-box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.35);
    }

    /*A small hack to prevent flickering on some browsers*/
    .accordian ul {
        width: 2000px;
        /*This will give ample space to the last item to move
        instead of falling down/flickering during hovers.*/
    }

    .accordian li {
        position: relative;
        display: block;
        width: 160px;
        float: left;

        border-left: 1px solid #888;

        box-shadow: 0 0 25px 10px rgba(0, 0, 0, 0.5);
        -webkit-box-shadow: 0 0 25px 10px rgba(0, 0, 0, 0.5);
        -moz-box-shadow: 0 0 25px 10px rgba(0, 0, 0, 0.5);

        /*Transitions to give animation effect*/
        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        /*If you hover on the images now you should be able to
        see the basic accordian*/
    }

    /*Reduce with of un-hovered elements*/
    .accordian ul:hover li {width: 40px;}
    /*Lets apply hover effects now*/
    /*The LI hover style should override the UL hover style*/
    .accordian ul li:hover {width: 640px;}


    .accordian li img {
        display: block;
    }

    /*Image title styles*/
    .image_title {
        background: rgba(0, 0, 0, 0.5);
        position: absolute;
        left: 0; bottom: 0;
    width: 640px;

    }
    .image_title a {
        display: block;
        color: #fff;
        text-decoration: none;
        padding: 20px;
        font-size: 16px;
    }
</style>
@endsection

@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <img href="{{ route('admin.home') }}" src="{{asset('img/logo.png')}}" alt="" width="200px"/>
            {{-- <a href="{{ route('admin.home') }}">
                {{ trans('panel.site_title') }}
            </a> --}}
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                {{ trans('global.login') }}
            </p>

            @if(session()->has('message'))
                <p class="alert alert-info">
                    {{ session()->get('message') }}
                </p>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">

                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ trans('global.login_password') }}">

                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>


                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">{{ trans('global.remember_me') }}</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-outline-dark btn-block btn-flat rounded">
                            {{ trans('global.login') }}
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            @if(Route::has('password.request'))
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">
                        {{ trans('global.forgot_password') }}
                    </a>
                </p>
            @endif
            {{-- <p class="mb-1">
                <a class="text-center" href="{{ route('register') }}">
                    {{ trans('global.register') }}
                </a>
            </p> --}}
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection