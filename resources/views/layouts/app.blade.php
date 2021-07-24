<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">

    <title>Lika Admin - V0.1</title>

    <!-- additional styles for plugins -->
        <!-- weather icons -->
        <link rel="stylesheet" href="{{ asset('bower_components/weather-icons/css/weather-icons.min.css') }}" media="all">
        <!-- metrics graphics (charts) -->
        <link rel="stylesheet" href="{{ asset('bower_components/metrics-graphics/dist/metricsgraphics.css') }}">
        <!-- chartist -->
        <link rel="stylesheet" href="{{ asset('bower_components/chartist/dist/chartist.min.css') }}">

    <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="{{ asset('icons/flags/flags.min.css') }}" media="all">

   <!-- altair admin -->
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="{{ asset('css/themes/themes_combined.min.css') }}" media="all">

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
        <script type="text/javascript" src="{{ asset('bower_components/matchMedia/matchMedia.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/matchMedia/matchMedia.addListener.js') }}"></script>
        <link rel="stylesheet" href="assets/css/ie.css" media="all">
    <![endif]-->

</head>
<body class=" sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">

                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>

                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
                </a>

                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="main_search_btn" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE8B6;</i></a></li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image"><img class="md-user-image" src="{{asset('img/avatars/avatar_11_tn.png')}}" alt=""/></a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="{{ route('profile.show') }}">Mon Profil</a></li>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li><button class="md-btn md-btn-wave waves-effect waves-button" type="submit">Déconnexion</button></li>
                                    </form>

                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form uk-autocomplete" data-uk-autocomplete="{source:'data/search_data.json'}">
                <input type="text" class="header_main_search_input" />
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
            </form>
        </div>
    </header><!-- main header end -->
    <!-- main sidebar -->
    <aside id="sidebar_main">

        <div class="sidebar_main_header">
            <div class="sidebar_logo">
                <a href="{{route('dashboard')}}" class="sSidebar_hide sidebar_logo_large">
                    <!--img class="logo_regular" src="assets/img/logo_main.png" alt="" height="15" width="71"/>
                    <img class="logo_light" src="assets/img/logo_main_white.png" alt="" height="15" width="71"/-->
                    Lika
                </a>
                <a href="{{route('dashboard')}}" class="sSidebar_show sidebar_logo_small">
                    <!--img class="logo_regular" src="assets/img/logo_main_small.png" alt="" height="32" width="32"/>
                    <img class="logo_light" src="assets/img/logo_main_small_light.png" alt="" height="32" width="32"/-->
                    Lika
                </a>
            </div>
        </div>

        <div class="menu_section">
            <ul>
                <li class="current_section" title="Dashboard">
                    <a href="{{route('dashboard')}}">
                        <span class="menu_icon"></span>
                        <span class="menu_title">Tableau de Bord</span>
                    </a>

                </li>

                <li title="companies">
                    <a href="#">
                        <span class="menu_icon"></span>
                        <span class="menu_title">Companies</span>
                    </a>
                    <ul>
                        <li><a href="{{route('list-company')}}">Liste</a></li>
                        <li><a href="{{route('company')}}">Ajouter</a></li>
                    </ul>
                </li>

                <li title="magasins">
                    <a href="#">
                        <span class="menu_icon"></span>
                        <span class="menu_title">Magasins</span>
                    </a>
                    <ul>
                        <li><a href="{{route('list-magasin')}}">Liste</a></li>
                        <li><a href="{{route('magasin')}}">Ajouter</a></li>
                    </ul>
                </li>

                <li title="promotions">
                    <a href="#">
                        <span class="menu_icon"></span>
                        <span class="menu_title">Promotions</span>
                    </a>
                    <ul>
                        <li><a href="{{route('promotions')}}">Liste</a></li>
                        <li><a href="{{route('promotion')}}">Ajouter</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside><!-- main sidebar end -->

    <div id="page_content">
        <div id="page_content_inner">

            @yield('content')

        </div>
    </div>

    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    <script src="{{ asset('js/common.min.js') }}"></script>
    <!-- uikit functions -->
    <script src="{{ asset('js/uikit_custom.min.js') }}"></script>
    <!-- altair common functions/helpers -->
    <script src="{{ asset('js/altair_admin_common.min.js') }}"></script>

    <!-- page specific plugins -->
        <!-- d3 -->
        <script src="{{ asset('bower_components/d3/d3.min.js') }}"></script>
        <!-- metrics graphics (charts) -->
        <script src="{{ asset('bower_components/metrics-graphics/dist/metricsgraphics.min.js') }}"></script>
        <!-- chartist (charts) -->
        <script src="{{ asset('bower_components/chartist/dist/chartist.min.js') }}"></script>
        <!-- maplace (google maps) -->
        <script src="http://maps.google.com/maps/api/js"></script>
        <script src="{{ asset('bower_components/maplace-js/dist/maplace.min.js') }}"></script>
        <!-- peity (small charts) -->
        <script src="{{ asset('bower_components/peity/jquery.peity.min.js') }}"></script>
        <!-- easy-pie-chart (circular statistics) -->
        <script src="{{ asset('bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
        <!-- countUp -->
        <script src="{{ asset('bower_components/countUp.js/dist/countUp.min.js') }}"></script>
        <!-- handlebars.js -->
        <script src="{{ asset('bower_components/handlebars/handlebars.min.js') }}"></script>
        <script src="{{ asset('custom/handlebars_helpers.min.js') }}"></script>
        <!-- CLNDR -->
        <script src="{{ asset('bower_components/clndr/clndr.min.js') }}"></script>

        <!--  dashbord functions -->
        <script src="{{ asset('js/pages/dashboard.min.js') }}"></script>


        <!-- datatables -->
        <script src="{{ asset('bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <!-- datatables buttons-->
        <script src="{{ asset('bower_components/datatables-buttons/js/dataTables.buttons.js') }}"></script>
        <script src="{{ asset('custom/datatables/buttons.uikit.js') }}assets/js/"></script>
        <script src="{{ asset('bower_components/jszip/dist/jszip.min.js') }}"></script>
        <script src="{{ asset('bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ asset('bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ asset('bower_components/datatables-buttons/js/buttons.colVis.js') }}"></script>
        <script src="{{ asset('bower_components/datatables-buttons/js/buttons.html5.js') }}"></script>
        <script src="{{ asset('bower_components/datatables-buttons/js/buttons.print.js') }}"></script>

        <!-- datatables custom integration -->
        <script src="{{ asset('custom/datatables/datatables.uikit.min.js') }}"></script>

        <!--  datatables functions -->
        <script src="{{ asset('js/pages/plugins_datatables.min.js') }}"></script>

        <!--  forms advanced functions -->
        <script src="{{ asset('js/pages/forms_advanced.min.js') }}"></script>

        <!--  wysiwyg editors functions -->
        <script src="{{ asset('js/pages/forms_wysiwyg.min.js') }}"></script>

        <!-- ckeditor -->
        <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('bower_components/ckeditor/adapters/jquery.js') }}"></script>


    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "bower_components/dense/src/dense.js", function() {
                    // enable hires images
                    altair_helpers.retina_images();
                });
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
        });
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>
</body>
</html>
