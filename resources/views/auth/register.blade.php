@extends('layouts.app')

@section('title') Register @endsection

@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-lg-6">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">

            <div class="col-lg">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="text-gray-900 mb-4">Register</h1>
                  @if(session('error'))
                  <div class="alert alert-danger">
                      {{session('error')}}
                  </div>
                  @endif
                </div>
                <form class="user" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                    @csrf

                    <div class="form-group">
                        <input id="name" type="text"
                        class="form-control rounded-pill form-control-user{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                        value="{{ old('name') }}" placeholder="Nama lengkap" required autofocus>
                        @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                      </div>

                      <div class="form-group">
                        <input id="email" type="text"
                        class="form-control form-control-user{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        value="{{ old('email') }}" placeholder="Email" required autofocus>
                        @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                      </div>

                  <div class="form-group">
                    <input id="username" type="text"
                    class="form-control form-control-user{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"
                    value="{{ old('username') }}" placeholder="Username" required autofocus>
                    @if ($errors->has('username'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="password" placeholder="Password">

                      @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>
                    <div class="col-sm-6">
                      <input class="form-control form-control-user" id="password-confirm" type="password" placeholder="Repeat Password" name="password_confirmation" required autocomplete="new-password">
                    </div>
                  </div>

                  <div class="form-group">

                  </div>

                <button type="submit" class="btn-block btn btn-dark">
                    {{ __('Register') }}
                </button>
                            

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

@endsection
