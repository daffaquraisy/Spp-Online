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

            <b>Nama Petugas:</b> <br>
            {{$user->nama}}

            <br>
            <br>

            <b>Level:</b> <br>
            {{$user->level}}
        </div>
    </div>
</div>

@endsection
