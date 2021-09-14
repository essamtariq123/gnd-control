@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    <a class="btn btn-link" href="/password/reset" style="text-decoration: none;">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Initialize Firebase
        var firebaseConfig = {
            apiKey: 'AIzaSyBHBEfYi6r4f82D_7BIyTlIBe59TTqiMsg',
            authDomain: 'gnd-control-backend.firebaseapp.com',
            projectId: 'gnd-control-backend',
            storageBucket: 'gnd-control-backend.appspot.com',
            messagingSenderId: '18319398742',
            appId: '1:18319398742:web:4b811836d522ca7d6428f7'
        }
        firebase.initializeApp(config)
        var facebookProvider = new firebase.auth.FacebookAuthProvider()
        var googleProvider = new firebase.auth.GoogleAuthProvider()
        var facebookCallbackLink = '/login/facebook/callback'
        var googleCallbackLink = '/login/google/callback'

        async function socialSignin(provider) {
            var socialProvider = null
            if (provider == 'facebook') {
                socialProvider = facebookProvider
                document.getElementById('social-login-form').action = facebookCallbackLink
            } else if (provider == 'google') {
                socialProvider = googleProvider
                document.getElementById('social-login-form').action = googleCallbackLink
            } else {
                return
            }
            firebase.auth().signInWithPopup(socialProvider).then(function (result) {
                result.user.getIdToken().then(function (result) {
                    document.getElementById('social-login-tokenId').value = result
                    document.getElementById('social-login-form').submit()
                })
            }).catch(function (error) {
                // do error handling
                console.log(error)
            })
        }
    </script>
@endsection
