@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('login.perform') }}">
        @method('post')
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="text-center">
            <img class="mb-4" src="{!! asset('images/logo.png') !!}" alt="" width="200">
        </div>

        <h1 class="h3 mb-3 fw-normal">Login</h1>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
            <label for="floatingName">Email or Username</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>
    
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>
        
        <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Remember me
            </label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        <a href="{{ route('register.show') }}" class="w-100 mt-2 py-2 text-center btn btn-link" style="text-decoration:none;">Sign up</a>

        @include('layouts.partials.messages')
    </form>
    @include('auth.partials.copy')
@endsection