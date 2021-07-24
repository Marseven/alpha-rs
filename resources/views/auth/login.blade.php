@extends('layouts.login')

@section('content')

<div class="row justify-content-center h-100 align-items-center">
    <div class="col-md-6">
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="auth-form">
                        <div class="text-center mb-3">
                            <a href="{{ route('home') }}"><img src="{{asset('images/Alpha.png')}}" alt="Alpha" style="width: 20%; height:auto;"></a>
                        </div>
                        <h4 class="text-center mb-4">Espace Client</h4>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="mb-1"><strong>Email</strong></label>
                                <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                            </div>
                            <div class="form-group">
                                <label class="mb-1"><strong>Mot de passe</strong></label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                <div class="form-group">
                                    <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">Se Connecter</button>
                            </div>
                        </form>
                        <div class="new-account mt-3">
                            <p>Pas de compte ? <a class="text-primary" href="{{ route('register') }}">Créer un compte</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
