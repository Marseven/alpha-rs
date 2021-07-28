@extends('layouts.default')

@section('content')

<!--=========================
Breadcrum Part HTML Start
=======================-->
<section id="breadcrun" class="breadcrun-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="bread-inner">
                    <h1 class="heading-font">RECHERCHE</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{route('home')}}">
                                <p>Accueil</p>
                            </a>
                        </li>
                        <li><i class="fas fa-angle-right"></i></li>
                        <li>
                            <p>Recherche</p>
                        </li>
                    </ul>
                    <div class="clr"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====================
    Breadcrum Part HTML End
======================-->

<!-- =============================
    Start: About Us
============================= -->
<section id="team" class="team section">
    <div class="container">
        <div class="row">

            <div class="col-12 ">
                <div class="heading b-text text-center">
                    <h5>Résultats</h5>
                    <h2>Recherches</h2>
                </div>
            </div>

        </div>

         <!-- =============================
            Start: Search
        ============================= -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-inline" method="POST" action="{{route('search')}}">
                        @csrf
                        <div class="col-sm-1">
                        </div>
                        <div class="form-group col-sm-8">
                            <input type="text" style="width: 100%" name="q" class="form-control form-control-lg" id="sick" placeholder="Cancer, ...">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Recherche</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- =============================
            End: Search
        ============================= -->

        <br><br>

        <div class="row">
            @foreach ($towns as $town)
                <div class="col-md-4 col-md-6">
                    <div class="team-inner">
                        <div class="team-img text-center">
                            <img src="{{$town->picture}}" class="img-fluid" alt="team">
                        </div>
                        <div class="team-txt text-center">
                            <h4>{{$town->label}}</h4>
                            <p class="team-border">{{$town->country->label}}</p>
                            <div><a class="btn btn-4 btn-ser" href="{{route('quote')}}">Devis</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if (empty($towns))
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    Aucun Résultat !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
        </div>
        <br><br>
    </div>
</section>

<!-- =============================
    End: About Us
============================= -->

@endsection
