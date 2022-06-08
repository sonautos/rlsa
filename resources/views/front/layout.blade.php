<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('front/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/vendor.css') }}">

    <!-- script
    ================================================== -->
    <script src="{{asset('front/js/modernizr.js')}}"></script>
    <script defer src="{{asset('front/js/fontawesome/all.min.js')}}"></script>

    {{-- Baloo2 --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500&display=swap" rel="stylesheet">

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('front/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('front/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('front/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('front/site.webmanifest') }}">
    @yield('style')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MDSRX7V0NQ"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-MDSRX7V0NQ');
    </script>
</head>

<body id="top">

    <!-- preloader
    ================================================== -->
    {{-- <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> --}}


    <!-- header
    ================================================== -->
    <header class="s-header">

        <div class="s-header__logo">
            <a href="{{ route('login')}}">
                <img src="{{asset('front/images/rlsa.gif')}}" alt="Homepage">
            </a>
        </div>

        <div class="s-header__content" style="padding-left: 10px">
    
            <nav class="s-header__nav-wrap">
                <ul class="s-header__nav">
                    <li><a class="smoothscroll" href="#hero" title="Intro">Home</a></li>
                    {{-- <li><a class="smoothscroll" href="#about" title="About">About</a></li>
                    <li><a class="smoothscroll" href="#services" title="Services">Services</a></li>
                    <li><a class="smoothscroll" href="#portfolio" title="Works">Works</a></li> --}}
                    @if(count(config('panel.available_languages', [])) > 1)
                    <li>
                        <div class="dropdown">
                            <span>{{ strtoupper(app()->getLocale()) }}</span>
                            <div class="dropdown-content">
                                @foreach(config('panel.available_languages') as $langLocale => $langName)
                                    <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
            </nav> <!-- end s-header__nav-wrap -->

            <a href="mailto:julien@rlsa.es" class="btn btn--primary btn--small" style="border-radius: 15px">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z"/></svg>
                {{ trans('front.send-email')}}
            </a>

        </div> <!-- end header-content -->

        <a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>

    </header> <!-- end s-header -->


    <!-- hero
    ================================================== -->
    <section id="hero" class="s-hero target-section">
        @yield('hero')
    </section> <!-- end s-hero -->


    <!-- about
    ================================================== -->
    {{-- <section id="about" class="s-about">
        @yield('about')
    </section>  --}}
    <!-- end s-about -->

    {{--
    <!-- services
    ================================================== -->
    <section id="services" class="s-services">
        @yield('service')
    </section> 
    <!-- end s-services -->

    <section id="portfolio" class="s-portfolio">
        @yield('portfolio')
    </section> 
    <!-- end s-portfolio -->


    <!-- clients
    ================================================== -->
    <div id="clients" class="section s-clients">
        @yield('clients')
    </div> 
    <!-- end s-clients -->


    <!-- contact
    ================================================== -->
    <section class="s-contact">
        @yield('contact')
    </section>  
    <!-- end s-contact --> --}}


    <!-- footer
    ================================================== -->
    <footer class="s-footer">
        <div class="row row-y-top">

            <div class="column large-8 medium-12">
                <div class="row">
                    <div class="column large-7 tab-12 s-footer__block">
                        <h4 class="h6">{{ trans('front.where-find-us')}}</h4>
        
                        <p>
                        Passeig del Castanyer, 41 <br>
                        08329 - Teià <br>
                        Barcelona - ESPAÑA <br>
                        <a href="tel:197-543-2345">+34 695 500 315</a>
                        </p>
                    </div>
        
                    <div class="column large-5 tab-12 s-footer__block">
                        <h4 class="h6">{{trans('front.follow-us')}}</h4 class="h6">
        
                        <ul class="s-footer__list">
                            <li><a href="https://www.linkedin.com/in/julien-nataf-0944481a/">LinkedIn</a></li>
                            {{-- <li><a href="#0">Twitter</a></li>
                            <li><a href="#0">Instagram</a></li>
                            <li><a href="#0">Dribbble</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="column large-4 medium-12 s-footer__block--end">
                <a href="mailto:julien@rlsa.es" class="btn h-full-width">Let's Talk</a>

                <div class="ss-copyright">
                    <span>Copyright RLSA {{to_year(now())}}</span> 
                    <span>Design by <a href="#">RemarketlInk</a></span>
                </div>
            </div>

            <div class="ss-go-top">
                <a class="smoothscroll" title="Back to Top" href="#top">
                    top
                </a>
            </div> <!-- end ss-go-top -->

        </div>
    </footer>
    

    <!-- photoswipe background
    ================================================== -->
    <div aria-hidden="true" class="pswp" role="dialog" tabindex="-1">

        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">

            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button> <button class="pswp__button pswp__button--share" title=
                    "Share"></button> <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom" title=
                    "Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button> <button class="pswp__button pswp__button--arrow--right" title=
                "Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>

        </div>

    </div> <!-- end photoSwipe background -->


    <!-- JavaScript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('front/js/plugins.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>