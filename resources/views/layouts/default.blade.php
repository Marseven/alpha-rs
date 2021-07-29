<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Alpha</title>
    <meta name="description" content="Assistance de santé, Évacuation sanitaire, Gabon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!---Favicon Icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/LogoRSA.png')}}">

    <!---Font Icon-->
    <link href="{{ asset('css/all.min.css')}}" rel="stylesheet">
    <link href="{{ asset('font/flaticon.css')}}" rel="stylesheet">
    <!-- / -->

    <!-- Plugin CSS -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/slick.css')}}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/odometer.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/pogoslider.css')}}">
    <link href="{{ asset('css/menu.css')}}" rel="stylesheet">

    <!-- Theme Style -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css')}}" rel="stylesheet">

    @stack('styles')

</head>

<body>
    <!-- Back to top Start -->
    <div id="back-top-btn">
        <i class="fa fa-chevron-up"></i>
    </div>
    <!-- Back to top End -->

    <!-- =============================
        Start: Preloader
    ============================= -->
    <div id="preloader">
        <div class='loader-ring'>
            <div class='loader-ring-light'></div>
            <div class='loader-ring-track'></div>
        </div>
    </div>

    <!-- =============================
        End: Preloader
    ============================= -->

    <!-- Header -->
    <section id="header" class="header_area">
        <!-- Header nav AREA CSS -->
        <!--Header Top-->

        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-1 pr0 logo-pad">
                        <div class="logo">
                            <a class="navbar-brand" href="{{ route('home')}}"><img src="{{ asset('images/LogoRSA.png')}}" class="img-fluid" alt="logo"></a>
                        </div>
                    </div>

                    <div class="col-lg-1 offset-lg-1 col-md-1 col-1 pr0">
                        <div class="menu-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-3 pl0">
                        <div class="subheader-text">
                            <p>Adresse</p>
                            <h5>
                                Libreville, GA
                            </h5>
                        </div>

                    </div>
                    <div class="col-lg-1 col-md-1 col-1 pr0">
                        <div class="menu-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-3 pl0 pr0">
                        <div class="subheader-text">
                            <p>Téléphone</p>
                            <h5>
                                (+241) 077 613 799
                            </h5>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-1 pr0">
                        <div class="menu-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-2 pl0">
                        <div class="subheader-text">
                            <p>E-mail</p>
                            <h5>
                                m.cherone@reliefservices.space
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- NAV AREA CSS -->
        <nav id="nav-part" class="navbar header-nav other-nav custom_nav sticky-top navbar-expand-md hidden-main">
            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{route('home')}}"><span data-hover="Home">Accueil</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('home')}}#aboutus"><span data-hover="About">À Propos</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('home')}}#service"><span data-hover="Services">Nos Services</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('home')}}#testimonial"><span data-hover="Services">Témoignages</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('quote')}}"><span data-hover="Services">Devis</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('home')}}#contactus"><span data-hover="Contact">Contact</span></a></li>
                    </ul>
                </div>
                @if (Auth::user())
                    @php
                        $user = Auth::user();
                    @endphp
                    <div><a class="btn btn-4 btn-br" href="{{ route('profil')}}" title="Espace Client">Mon Compte</a></div>
                @else
                <div><a class="btn btn-4 btn-br" href="{{ route('login')}}" title="Espace Client">Espace Client</a></div>
                @endif

            </div>
        </nav>
        <nav id='cssmenu' class="hidden mobile">
            <div class="logo">
                <a href="index-2.html" class="logo">
                    <img src="images/logo.png" class="img-responsive" alt="">
                </a>
            </div>
            <div id="head-mobile"></div>
            <div class="button"><i class="more-less fa fa-align-right"></i></div>
            <ul>
                <li><a href="{{route('home')}}#banner">Accueil</a></li>
                <li><a href="{{route('home')}}#aboutus">À Propos</a></li>
                <li><a href="{{route('home')}}#service">Nos Services</a></li>
                <li><a href="{{route('home')}}#testimonial">Témoignages</a></li>
                <li><a href="{{route('quote')}}">Devis</a></li>
                <li class="nav-item"><a href="{{route('home')}}#contactus">Contact</a></li>

                @if (Auth::user())
                    @php
                        $user = Auth::user();
                    @endphp
                    <li class="login"><a href="{{ route('profil')}}" class="btn btn-4 btn-br">Mon Compte</a></li>
                @else
                    <li class="login"><a href="{{ route('login')}}" class="btn btn-4 btn-br">Espace Client</a></li>
                @endif

            </ul>

        </nav>
    </section>
    <!-- Header End -->

    @yield('content')

    <!--====================
    Contact Part HTML Start
    ======================-->
    <section id="contact" class="contact">
        <div class="container">
            <div class="content-text">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="cont-logo" style="text-align: center">
                            <a href="#aboutus"><img src="images/ReliefServiceswhite.png" alt="footer logo" style="width: 60%; height:auto;"></a>
                        </div>
                        <div class="cont-txt">
                            <p class="cont-gap">
                                Relief Services est une entreprise spécialisée dans l’assistance médicale et l’accompagnement de toute personne désirant se faire soigner à l’étranger dans le cadre d'une évacuation sanitaire ou pour un bilan de santé.
                            </p>
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4  col-md-6 col-sm-12">
                        <div class="cont-center">
                            <h3>Liens utiles</h3>
                        </div>

                        <div class="c-text-menu1">
                            <ul>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Notre Team</a></li>
                                <li><a href="blog_details.html">Politique de confidentialité</a></li>
                                <li><a href="blog_details.html">CGU</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="cont-center">
                            <h3>Contactez-Nous</h3>
                        </div>
                        <div class="c-text-location">
                            <div class="row">
                                <div class="col-lg-3  col-md-3">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-map-marker-alt"></i></a></li>
                                        <li><a href="#"><i class="fas fa-phone"></i></a></li>
                                        <li><a href="#"><i class="fas fa-globe-americas"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-9  col-md-9">
                                    <div class="address">

                                        <p>Libreville <br> Port-Gentil</p>

                                        <p>+241 077 613 799<br>
                                            +241 066 207 525</p>

                                        <p>m.cherone@reliefservices.space</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <p>Copyright © 2021. Tous Droits Réservés à Relief Service. Réaliser par <a href="https://mebodorichard.tech">@aristidemebodo</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>


    <!--===========================
        Contact Part HTML End
    ============================-->


    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.0.min.js')}}"></script>

    <!-- Plugins -->
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <script src="{{ asset('js/slick.min.js')}}"></script>
    <!--====== odometer js ======-->
    <script src="{{ asset('js/odometer.min.js')}}"></script>
    <script src="{{ asset('js/jquery.appear.min.js')}}"></script>

    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/wow.min.js')}}"></script>
    <script src="{{ asset('js/waypoints.js')}}"></script>
    <script src="{{ asset('js/menu-opener.js')}}"></script>
    <script src="{{ asset('js/pogoslider.js')}}"></script>
    <script src="{{ asset('js/SmoothScroll.js')}}"></script>
    <!-- custom -->

    <script src="{{ asset('js/custom.js')}}"></script>
    <script src="{{ asset('js/menu.js')}}"></script>

    @stack('scripts')

</body>

</html>
