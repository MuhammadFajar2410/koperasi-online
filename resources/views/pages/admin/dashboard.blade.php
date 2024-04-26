@extends('layouts.master')
@section('page_title', 'My Dashboard')

@section('content')
    <h2>Welcome.  {{ ucwords(Auth::user()->role->name ?? '') }}<br> This is your Dashboard {{ $user->profile->name }}
    </h2>
@endsection
