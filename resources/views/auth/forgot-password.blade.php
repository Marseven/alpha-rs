@extends('layouts.login')

@section('content')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-6">
            <div class="authincation-content">
                <div class="row no-gutters">
                    <div class="col-xl-12">
                        <div class="auth-form">
                            <div class="text-center mb-3">
                                <a href="index-2.html"><img src="images/logo-full.png" alt=""></a>
                            </div>
                            <h4 class="text-center mb-4">Mot de passe oublié </h4>
                            @include('layouts.flash-admin')
                            <br>
                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label><strong>Email</strong></label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="hello@example.com">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
                                </div>
                            </form>
                            <div class="new-account mt-3">
                                <p>Déjà enregistrer ? <a class="text-primary" href="{{ route('login') }}">Connexion</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
