@extends('website.layouts.app')

@section('content')
    <router-view></router-view>
    <div>
        <section class="login mt-header pt-4 w-75 mx-auto">
            <div class="container">
                <h2>Welcome</h2>
                <h1>Log in with your DDC account</h1>
                <form action="{{route('member.login')}}" method="post">
                   @csrf
                    <div class="form-account mt-4 w-75 m-auto">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="d-md-flex my-3 pb-3 border-bottom">
                            <button type="submit" class="btn btn-primary me-3">Sing In</button>
{{--                            <a href="#" class="btn btn btn-outline-secondary me-3">Forgot password</a>--}}
                            <a href="/create-account" class="btn btn btn-outline-secondary">Create account</a>
                        </div>
                        <div class="mb-4">
                            <a href="#" class="btn-contact">Contact DDC</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>


    </div>
@endsection
