@extends('layouts.login')

@section('content')

<div class="row justify-content-center h-100 align-items-center">
    <div class="col-md-6">
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="auth-form">
                        <div class="text-center mb-3">
                            <a href="{{route('home')}}"><img src="{{asset('images/Alpha.png')}}" alt="Alpha" style="width: 20%; height:auto;"></a>
                        </div>
                        <h4 class="text-center mb-4">Créer votre compte</h4>
                        <form action="{{route('register')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="mb-1"><strong>Votre Nom Complet</strong></label>
                                <input type="text" name="name" class="form-control" placeholder="username">
                            </div>
                            <div class="form-group">
                                <label class="mb-1"><strong>Email</strong></label>
                                <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                            </div>
                            <div class="form-group">
                                <label class="mb-1"><strong>Téléphone</strong></label>
                                <input type="text" name="phone" class="form-control" placeholder="074010203">
                            </div>
                            <div class="form-group">
                                <label class="mb-1"><strong>Mot de passe</strong></label>
                                <input type="password" name="password" class="form-control" value="Password">
                            </div>

                            <div class="form-group">
                                <label class="mb-1"><strong>Confirmer Mot de Passe</strong></label>
                                <input type="password" name="password_confirmation" class="form-control" value="Password">
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-block">S'enregistrer</button>
                            </div>
                        </form>
                        <div class="new-account mt-3">
                            <p>Déjà enregistrer ? <a class="text-primary" href="{{route('login')}}">Connexion</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
