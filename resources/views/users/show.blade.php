@extends('layouts.global')
@section('title') Detail user @endsection
@section('content')

<div class="col-md-8">
    <div class="card border-left-primary">
        <div class="card-body">

            <b>Username:</b><br>
            {{$user->username}}

            <br>
            <br>

            <b>Email:</b><br>
            {{$user->email}}

            <br>
            <br>

            <b>Nama Petugas:</b> <br>
            {{$user->name}}

            <br>
            <br>

            <b>Level:</b> <br>
            @foreach (json_decode($user->level) as $l)
            &middot; {{$l}} <br>
            @endforeach        
        </div>
    </div>
</div>

@endsection
