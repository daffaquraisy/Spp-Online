@extends('layouts.app')

@section('title') Login @endsection

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
                  <h1 class="text-gray-900 mb-4">Login</h1>
                  @if(session('error'))
                  <div class="alert alert-danger">
                      {{session('error')}}
                  </div>
                  @endif
                </div>
                <form class="user" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf

                  <div class="form-group">
                    <input id="username" type="text"
                    class="form-control round form-control-user{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"
                    value="{{ old('username') }}" placeholder="Username" required autofocus>
                    @if ($errors->has('username'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <input id="password" type="password"
                    class="form-control form-control-user{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password"
                    required>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">

                  </div>

                <button type="submit" class="ml-2 btn btn-dark">
                        {{ __('Login') }}
                    </button>

                    <hr>

                    <a href="{{ route('register')}}" class="btn btn-google btn-user btn-block" style="color:1f283e;">
                      <i class="fas fa-user fa-fw" style="color:#1f283e;"></i> Create new Account !
                    </a>

                            

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

@endsection
