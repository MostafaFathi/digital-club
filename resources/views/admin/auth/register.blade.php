@extends('layouts.app')

@section('content')
    <div class="register m-top80 cart">
        <div class="container">
            <h1 class="mb-4"><img src="website/images/register.svg"> {{ __('Register') }}</h1>
            <div class="col-md-8 offset-md-2">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">{{ __('Name') }}</label>
                        <div class="col-md-8">
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>

                        <div class="col-md-8">
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="mobile" class="col-sm-3 col-form-label">{{ __('Mobile') }}</label>

                        <div class="col-md-8">
                            <input id="mobile" type="number"
                                   class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                   value="{{ old('mobile') }}" required autocomplete="mobile">

                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">{{ __('Password') }}</label>

                        <div class="col-md-8">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-sm-3 col-form-label">{{ __('Confirm Password') }}</label>

                        <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                    </div>

                    <div class="form-group d-table m-auto">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
