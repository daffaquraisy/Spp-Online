@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card bg-white border">
                {{-- <div class="card-header bg-transparent border-0">{{__('Login') }}</div> --}}
            <div class="card-body">

                @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
                @endif


                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                  
                    @csrf
                    <div class="form-group">
                      <label class="control-label">Nama</label>
                      <input id="username" type="text"
                  class="form-control form-control-user{{ $errors->has('name') ? ' is-invalid' : '' }}" name="username"
                  value="{{ old('username') }}"  required autofocus>
                  @if ($errors->has('username'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('username') }}</strong>
                  </span>
                  @endif
                  </div>

                    <div class="form-group row">

                        <div class="col-md-12">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-left pl-0">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                required>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn-block btn btn-primary">
                                {{ __('Login') }}
                            </button>
                            <br>
                            <a class="btn btn-link pl-0" href="{{route('register') }}">
                                {{ __('Create New Acconut?') }}
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
