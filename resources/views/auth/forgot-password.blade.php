@extends('auth.master')

@section('content')
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">

                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <a href="{{ route('dashboard') }}" class="auth-logo">
                                <img src="{{ asset('assets/images/logo-dark.png') }}" height="30" class="logo-dark mx-auto"
                                    alt="">
                                <img src="{{ asset('assets/images/logo-light.png') }}" height="30"
                                    class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>

                    <h4 class="text-muted text-center font-size-18"><b> {{ __('Reset Password') }}</b></h4>

                    <div class="p-3">
                        <form class="form-horizontal mt-3" method="POST" action="{{ route('password.email') }}">

                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ __('Enter Your E-mail and instructions will be sent to you!') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                    <input class="form-control" type="email" required="" placeholder="Email"
                                        name="email" :value="old('email')">
                                </div>
                            </div>

                            <div class="form-group pb-2 text-center row mt-3">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">
                                        {{ __('Send Email') }}</button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="form-group mb-0 row mt-2">
                            <div class="col-sm-5 mt-3">
                                <a href="{{ route('login') }}" class="text-muted"><i
                                        class="mdi mdi-account-circle"></i> {{ __('Login') }} </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div>
@endsection
