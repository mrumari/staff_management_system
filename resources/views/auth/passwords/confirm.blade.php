@extends('layouts.reset_password_app')

@section('content')
    <div class="content-body">
    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                    <div class="card-header border-0 text-center">
                        <img src="{{asset('super-admin-theme/app-assets/images/portrait/small/avatar-s-1.png')}}" alt="unlock-user" class="rounded-circle img-fluid center-block">
                        <h5 class="card-title mt-1">John Doe</h5>
                    </div>

                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2">
                        <span>Confirm Password</span>
                        <span>Please confirm your password before continuing</span>
                    </p>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('password.confirm') }}" novalidate>
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left">
{{--                                    <input type="password" class="form-control round" id="password" placeholder="Enter Password" required>--}}
                                    <input id="password" type="password" class="form-control round @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                </fieldset>
                                @if (Route::has('password.request'))
                                <div class="form-group row">
                                    <div class="col-12 float-sm-left text-center text-sm-right">
                                        <a href="{{route('password.request')}}" class="card-link">
                                            <i class="ft-unlock"></i> Forgot Password?</a>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group text-center">
                                    <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Confirm Password to Unlock</button>
                                </div>
                                <div class="col-12 float-sm-left text-center text-sm-center mt-2">Or
                                <a href="{{route('logout')}}" class="card-link"> Logout</a> from this system
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Confirm Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    {{ __('Please confirm your password before continuing.') }}--}}

{{--                    <form method="POST" action="{{ route('password.confirm') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Confirm Password') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
