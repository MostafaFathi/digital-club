@extends('website.layouts.app')

@section('content')
    <style>
        .input-group-text{
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
    </style>

    <section class="login d-flex align-items-center py-3" style="margin-top: 87px!important;">

        <div class="container">

            <div class="row">

                <div class="offset-md-3 col-md-6">
                    <div class="form-sgin m-auto" style="background-color: white; background-color: white;padding: 20px;border-radius: 25px;">

                        <div class="intro mb-3 text-center">

                            <h2 class="color-white mb-4">Login</h2>
                        </div>

                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend d-flex m-0">
                                    <span class="input-group-text"><i class="fa fa-user "></i></span>
                                </div>
                                <input id="email" type="email" name="email"
                                       class="form-control  @error('email') is-invalid @enderror"
                                       placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>


                            <div class="input-group mb-3">
                                <div class="input-group-prepend d-flex m-0">
                                    <span class="input-group-text"><i class="fa fa-lock "></i></span>
                                </div>
                                <input type="Password" placeholder="Password" id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">
            {{--                    <a class="showpass" href="#" onclick="ShowPass()"><i class="fa fa-eye"></i></a>--}}

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label " for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block w-100"
                                    style="     color: rgb(255 255 255);margin-bottom: 10px;border: 0px;">
                                Sign in
                            </button>


                        </form>

                    </div>
                        </div>

            </div>

        </div>



    </section>

@endsection
