<!DOCTYPE html>
<html>

<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PG79VGT');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>rlsa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />

    {{-- datatable --}}
    <link href="https://code.jquery.com/jquery-3.5.1.js"/>
    <link href="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"/>
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/searchpanes/1.2.1/css/searchPanes.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"/>
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" />

    {{-- <link href="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/searchpanes/1.2.1/js/dataTables.searchPanes.min.js" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" rel="stylesheet" /> --}}
    {{-- https://code.jquery.com/jquery-3.5.1.js--}}

    {{-- Dropzone --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    {{-- Toastr --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />

    @yield('styles')
</head>

<body class="sidebar-mini layout-fixed sidebar-collapse" style="height: auto;">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PG79VGT"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li>
                    <select class="searchable-field form-control">

                    </select>
                </li>
            </ul>

            <!-- Right navbar links -->
            @if(count(config('panel.available_languages', [])) > 1)
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach(config('panel.available_languages') as $langLocale => $langName)
                                <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                            @endforeach
                        </div>
                    </li>
                </ul>
            @endif
            <ul class="navbar-nav">
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                      {{-- <img src="dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image"> --}}
                      <span class="hidden-xs">{{ Auth::user()->firstname }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                      <!-- User image -->
                      <li class="user-header bg-primary">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                        <p>
                            {{ Auth::user()->firstname }} {{ Auth::user()->name }}
                          <small>{{ Auth::user()->created_at }}</small>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer row">
                        <div class="pull-left mx-auto text-center">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <p style="text-transform: uppercase">{{ trans('global.profil') }}</p>
                            </a>
                        </div>
                        <div class="pull-right mx-auto text-center">
                            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                    <p style="text-transform: uppercase">{{ trans('global.logout') }}</p>
                                </p>
                            </a>
                        </div>
                      </li>
                    </ul>
                  </li>
            </ul>
            {{-- @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li> --}}

        </nav>

        @include('partials.menu')
        <div class="content-wrapper" style="min-height: 917px;">
            <!-- Main content -->
            <section class="content" style="padding-top: 20px">
                {{-- @if(session('message'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                @endif --}}
                @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </section>
            <!-- /.content -->
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Remarketing & logistics services automotive</b> 1.0.0
            </div>
            <strong> &copy;</strong> {{ trans('global.allRightsReserved') }}
        </footer>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>


    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/1.2.1/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
    <script>
        @if(Session::has('message'))
        toastr.options =
        {
            "timeOut": 3000,
            "closeButton" : true,
            "progressBar" : false
        }
                toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "timeOut": 3000,
            "closeButton" : true,
            "progressBar" : false
        }
                toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "timeOut": 3000,
            "closeButton" : true,
            "progressBar" : false
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "timeOut": 3000,
            "closeButton" : true,
            "progressBar" : false
        }
                toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    {{-- End Toastr --}}
    <script>
        $(function() {
    let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
    let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
    let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
    let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
    let printButtonTrans = '{{ trans('global.datatables.print') }}'
    let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
    let selectAllButtonTrans = '{{ trans('global.select_all') }}'
    let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'
    let dropdownexport = '{{ trans('global.export') }}'

    let languages = {
        'fr': 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json',
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
            'de': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/German.json',
            'es': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
            'it': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Italian.json'
    };

    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
        url: languages['{{ app()->getLocale() }}']
        },
        columnDefs: [
        {
            orderable: false,
            className: 'dt-body-center', //add select-checkbox
            targets: 0,
            render: function (data, type, full, meta){
                        return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                    }
        },
        {
            orderable: false,
            searchable: false,
            targets: -1
        }],
        select: {
        style:    'multi+shift',
        selector: 'td:first-child'
        },
        order: [],
        scrollX: true,
        pageLength: 100,
        dom: 'lBfrtip<"actions">',
        buttons: [
            {
                extend: 'collection',
                className: 'btn btn-secondary dropdown-toggle rounded shadow-lg',
                text: dropdownexport,
                buttons: [
                    {
                        extend: 'copy',
                        className: 'btn-light col text-center mx-auto m-1 p-2',
                        text: copyButtonTrans,
                        exportOptions: {
                        columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-success col text-center mx-auto m-1 p-2',
                        text: csvButtonTrans,
                        exportOptions: {
                        columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-success col text-center mx-auto m-1 p-2',
                        text: excelButtonTrans,
                        exportOptions: {
                        columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-danger col text-center mx-auto m-1 p-2',
                        text: pdfButtonTrans,
                        exportOptions: {
                        columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-default col text-center mx-auto m-1 p-2',
                        text: printButtonTrans,
                        exportOptions: {
                        columns: ':visible'
                        }
                    },
                ]
            },
            // {
            //     extend: 'selectAll',
            //     className: 'btn-primary mx-2 rounded shadow-lg',
            //     text: selectAllButtonTrans,
            //     exportOptions: {
            //     columns: ':visible'
            //     },
            //     action: function(e, dt) {
            //     e.preventDefault()
            //     dt.rows().deselect();
            //     dt.rows({ search: 'applied' }).select();
            //     }
            // },
            // {
            //     extend: 'selectNone',
            //     className: 'btn-primary mx-2 rounded shadow-lg',
            //     text: selectNoneButtonTrans,
            //     exportOptions: {
            //     columns: ':visible'
            //     }
            // },
            {
                extend: 'colvis',
                className: 'btn-default mx-2 rounded shadow-lg',
                text: colvisButtonTrans,
                exportOptions: {
                columns: ':visible'
                }
            }
        ]

    });

    $.fn.dataTable.ext.classes.sPageButton = '';

});

    </script>
    <script>
        $(document).ready(function() {
    $('.searchable-field').select2({
        minimumInputLength: 3,
        ajax: {
            url: '{{ route("admin.globalSearch") }}',
            dataType: 'json',
            type: 'GET',
            delay: 200,
            data: function (term) {
                return {
                    search: term
                };
            },
            results: function (data) {
                return {
                    data
                };
            }
        },
        escapeMarkup: function (markup) { return markup; },
        templateResult: formatItem,
        templateSelection: formatItemSelection,
        placeholder : '{{ trans('global.search') }}...',
        language: {
            inputTooShort: function(args) {
                var remainingChars = args.minimum - args.input.length;
                var translation = '{{ trans('global.search_input_too_short') }}';

                return translation.replace(':count', remainingChars);
            },
            errorLoading: function() {
                return '{{ trans('global.results_could_not_be_loaded') }}';
            },
            searching: function() {
                return '{{ trans('global.searching') }}';
            },
            noResults: function() {
                return '{{ trans('global.no_results') }}';
            },
        }

    });
    function formatItem (item) {
        if (item.loading) {
            return '{{ trans('global.searching') }}...';
        }
        var markup = "<div class='searchable-link' href='" + item.url + "'>";
        markup += "<div class='searchable-title'>" + item.model + "</div>";
        $.each(item.fields, function(key, field) {
            markup += "<div class='searchable-fields'>" + item.fields_formated[field] + " : " + item[field] + "</div>";
        });
        markup += "</div>";

        return markup;
    }

    function formatItemSelection (item) {
        if (!item.model) {
            return '{{ trans('global.search') }}...';
        }
        return item.model;
    }
    $(document).delegate('.searchable-link', 'click', function() {
        var url = $(this).attr('href');
        window.location = url;
    });
});

    </script>
    <script>
        /*!
     * AdminLTE v3.0.0-alpha.2 (https://adminlte.io)
     * Copyright 2014-2018 Abdullah Almsaeed <abdullah@almsaeedstudio.com>
     * Licensed under MIT (https://github.com/almasaeed2010/AdminLTE/blob/master/LICENSE)
     */
    !function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(exports):"function"==typeof define&&define.amd?define(["exports"],t):t(e.adminlte={})}(this,function(e){"use strict";var i,t,o,n,r,a,s,c,f,l,u,d,h,p,_,g,y,m,v,C,D,E,A,O,w,b,L,S,j,T,I,Q,R,P,x,B,M,k,H,N,Y,U,V,G,W,X,z,F,q,J,K,Z,$,ee,te,ne="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},ie=function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")},oe=(i=jQuery,t="ControlSidebar",o="lte.control.sidebar",n=i.fn[t],r=".control-sidebar",a='[data-widget="control-sidebar"]',s=".main-header",c="control-sidebar-open",f="control-sidebar-slide-open",l={slide:!0},u=function(){function n(e,t){ie(this,n),this._element=e,this._config=this._getConfig(t)}return n.prototype.show=function(){this._config.slide?i("body").removeClass(f):i("body").removeClass(c)},n.prototype.collapse=function(){this._config.slide?i("body").addClass(f):i("body").addClass(c)},n.prototype.toggle=function(){this._setMargin(),i("body").hasClass(c)||i("body").hasClass(f)?this.show():this.collapse()},n.prototype._getConfig=function(e){return i.extend({},l,e)},n.prototype._setMargin=function(){i(r).css({top:i(s).outerHeight()})},n._jQueryInterface=function(t){return this.each(function(){var e=i(this).data(o);if(e||(e=new n(this,i(this).data()),i(this).data(o,e)),"undefined"===e[t])throw new Error(t+" is not a function");e[t]()})},n}(),i(document).on("click",a,function(e){e.preventDefault(),u._jQueryInterface.call(i(this),"toggle")}),i.fn[t]=u._jQueryInterface,i.fn[t].Constructor=u,i.fn[t].noConflict=function(){return i.fn[t]=n,u._jQueryInterface},u),re=(d=jQuery,h="Layout",p="lte.layout",_=d.fn[h],g=".main-sidebar",y=".main-header",m=".content-wrapper",v=".main-footer",C="hold-transition",D=function(){function n(e){ie(this,n),this._element=e,this._init()}return n.prototype.fixLayoutHeight=function(){var e={window:d(window).height(),header:d(y).outerHeight(),footer:d(v).outerHeight(),sidebar:d(g).height()},t=this._max(e);d(m).css("min-height",e.window-e.header-e.footer),d(g).css("min-height",e.window-e.header)},n.prototype._init=function(){var e=this;d("body").removeClass(C),this.fixLayoutHeight(),d(g).on("collapsed.lte.treeview expanded.lte.treeview collapsed.lte.pushmenu expanded.lte.pushmenu",function(){e.fixLayoutHeight()}),d(window).resize(function(){e.fixLayoutHeight()}),d("body, html").css("height","auto")},n.prototype._max=function(t){var n=0;return Object.keys(t).forEach(function(e){t[e]>n&&(n=t[e])}),n},n._jQueryInterface=function(t){return this.each(function(){var e=d(this).data(p);e||(e=new n(this),d(this).data(p,e)),t&&e[t]()})},n}(),d(window).on("load",function(){D._jQueryInterface.call(d("body"))}),d.fn[h]=D._jQueryInterface,d.fn[h].Constructor=D,d.fn[h].noConflict=function(){return d.fn[h]=_,D._jQueryInterface},D),ae=(E=jQuery,A="PushMenu",w="."+(O="lte.pushmenu"),b=E.fn[A],L={COLLAPSED:"collapsed"+w,SHOWN:"shown"+w},S={screenCollapseSize:768},j={TOGGLE_BUTTON:'[data-widget="pushmenu"]',SIDEBAR_MINI:".sidebar-mini",SIDEBAR_COLLAPSED:".sidebar-collapse",BODY:"body",OVERLAY:"#sidebar-overlay",WRAPPER:".wrapper"},T="sidebar-collapse",I="sidebar-open",Q=function(){function n(e,t){ie(this,n),this._element=e,this._options=E.extend({},S,t),E(j.OVERLAY).length||this._addOverlay()}return n.prototype.show=function(){E(j.BODY).addClass(I).removeClass(T);var e=E.Event(L.SHOWN);E(this._element).trigger(e)},n.prototype.collapse=function(){E(j.BODY).removeClass(I).addClass(T);var e=E.Event(L.COLLAPSED);E(this._element).trigger(e)},n.prototype.toggle=function(){(E(window).width()>=this._options.screenCollapseSize?!E(j.BODY).hasClass(T):E(j.BODY).hasClass(I))?this.collapse():this.show()},n.prototype._addOverlay=function(){var e=this,t=E("<div />",{id:"sidebar-overlay"});t.on("click",function(){e.collapse()}),E(j.WRAPPER).append(t)},n._jQueryInterface=function(t){return this.each(function(){var e=E(this).data(O);e||(e=new n(this),E(this).data(O,e)),t&&e[t]()})},n}(),E(document).on("click",j.TOGGLE_BUTTON,function(e){e.preventDefault();var t=e.currentTarget;"pushmenu"!==E(t).data("widget")&&(t=E(t).closest(j.TOGGLE_BUTTON)),Q._jQueryInterface.call(E(t),"toggle")}),E.fn[A]=Q._jQueryInterface,E.fn[A].Constructor=Q,E.fn[A].noConflict=function(){return E.fn[A]=b,Q._jQueryInterface},Q),se=(R=jQuery,P="Treeview",B="."+(x="lte.treeview"),M=R.fn[P],k={SELECTED:"selected"+B,EXPANDED:"expanded"+B,COLLAPSED:"collapsed"+B,LOAD_DATA_API:"load"+B},H=".nav-item",N=".nav-treeview",Y=".menu-open",V="menu-open",G={trigger:(U='[data-widget="treeview"]')+" "+".nav-link",animationSpeed:300,accordion:!0},W=function(){function i(e,t){ie(this,i),this._config=t,this._element=e}return i.prototype.init=function(){this._setupListeners()},i.prototype.expand=function(e,t){var n=this,i=R.Event(k.EXPANDED);if(this._config.accordion){var o=t.siblings(Y).first(),r=o.find(N).first();this.collapse(r,o)}e.slideDown(this._config.animationSpeed,function(){t.addClass(V),R(n._element).trigger(i)})},i.prototype.collapse=function(e,t){var n=this,i=R.Event(k.COLLAPSED);e.slideUp(this._config.animationSpeed,function(){t.removeClass(V),R(n._element).trigger(i),e.find(Y+" > "+N).slideUp(),e.find(Y).removeClass(V)})},i.prototype.toggle=function(e){var t=R(e.currentTarget),n=t.next();if(n.is(N)){e.preventDefault();var i=t.parents(H).first();i.hasClass(V)?this.collapse(R(n),i):this.expand(R(n),i)}},i.prototype._setupListeners=function(){var t=this;R(document).on("click",this._config.trigger,function(e){t.toggle(e)})},i._jQueryInterface=function(n){return this.each(function(){var e=R(this).data(x),t=R.extend({},G,R(this).data());e||(e=new i(R(this),t),R(this).data(x,e)),"init"===n&&e[n]()})},i}(),R(window).on(k.LOAD_DATA_API,function(){R(U).each(function(){W._jQueryInterface.call(R(this),"init")})}),R.fn[P]=W._jQueryInterface,R.fn[P].Constructor=W,R.fn[P].noConflict=function(){return R.fn[P]=M,W._jQueryInterface},W),ce=(X=jQuery,z="Widget",q="."+(F="lte.widget"),J=X.fn[z],K={EXPANDED:"expanded"+q,COLLAPSED:"collapsed"+q,REMOVED:"removed"+q},$="collapsed-card",ee={animationSpeed:"normal",collapseTrigger:(Z={DATA_REMOVE:'[data-widget="remove"]',DATA_COLLAPSE:'[data-widget="collapse"]',CARD:".card",CARD_HEADER:".card-header",CARD_BODY:".card-body",CARD_FOOTER:".card-footer",COLLAPSED:".collapsed-card"}).DATA_COLLAPSE,removeTrigger:Z.DATA_REMOVE},te=function(){function n(e,t){ie(this,n),this._element=e,this._parent=e.parents(Z.CARD).first(),this._settings=X.extend({},ee,t)}return n.prototype.collapse=function(){var e=this;this._parent.children(Z.CARD_BODY+", "+Z.CARD_FOOTER).slideUp(this._settings.animationSpeed,function(){e._parent.addClass($)});var t=X.Event(K.COLLAPSED);this._element.trigger(t,this._parent)},n.prototype.expand=function(){var e=this;this._parent.children(Z.CARD_BODY+", "+Z.CARD_FOOTER).slideDown(this._settings.animationSpeed,function(){e._parent.removeClass($)});var t=X.Event(K.EXPANDED);this._element.trigger(t,this._parent)},n.prototype.remove=function(){this._parent.slideUp();var e=X.Event(K.REMOVED);this._element.trigger(e,this._parent)},n.prototype.toggle=function(){this._parent.hasClass($)?this.expand():this.collapse()},n.prototype._init=function(e){var t=this;this._parent=e,X(this).find(this._settings.collapseTrigger).click(function(){t.toggle()}),X(this).find(this._settings.removeTrigger).click(function(){t.remove()})},n._jQueryInterface=function(t){return this.each(function(){var e=X(this).data(F);e||(e=new n(X(this),e),X(this).data(F,"string"==typeof t?e:t)),"string"==typeof t&&t.match(/remove|toggle/)?e[t]():"object"===("undefined"==typeof t?"undefined":ne(t))&&e._init(X(this))})},n}(),X(document).on("click",Z.DATA_COLLAPSE,function(e){e&&e.preventDefault(),te._jQueryInterface.call(X(this),"toggle")}),X(document).on("click",Z.DATA_REMOVE,function(e){e&&e.preventDefault(),te._jQueryInterface.call(X(this),"remove")}),X.fn[z]=te._jQueryInterface,X.fn[z].Constructor=te,X.fn[z].noConflict=function(){return X.fn[z]=J,te._jQueryInterface},te);e.ControlSidebar=oe,e.Layout=re,e.PushMenu=ae,e.Treeview=se,e.Widget=ce,Object.defineProperty(e,"__esModule",{value:!0})});
    //# sourceMappingURL=adminlte.min.js.map
    </script>

    <script src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&amp;libraries=places&amp;callback=initAutocomplete" type="text/javascript"></script>

    <script>
    // Lie le champs adresse en champs autocomplete afin que l'API puisse afficher les propositions d'adresses
    function initializeAutocomplete(id) {
        var element = document.getElementById(id);
        if (element) {
        var autocomplete = new google.maps.places.Autocomplete(element, { types: ['geocode'] });
        google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
        }
    }

    // Injecte les données dans les champs du formulaire lorsqu'une adresse est sélectionnée
    function onPlaceChanged() {
        var place = this.getPlace();

        for (var i in place.address_components) {
        var component = place.address_components[i];
        for (var j in component.types) {
            var type_element = document.getElementById(component.types[j]);
            if (type_element) {
            type_element.value = component.long_name;
            }
        }
        for (var country in component.types) {
            var type_element = document.getElementById(component.types[country]);
            if (type_element) {
            type_element.value = component.long_name;
            }
        }
        }

        var longitude = document.getElementById("longitude");
        var latitude = document.getElementById("latitude");
        longitude.value = place.geometry.location.lng();
        latitude.value = place.geometry.location.lat();

        var url = document.getElementById('url');
        url.value = place.url;
    }

    // Initialisation du champs autocomplete
    google.maps.event.addDomListener(window, 'load', function() {
        initializeAutocomplete('user_input_autocomplete_address');
    });

    </script>

    @yield('scripts')
</body>

</html>
