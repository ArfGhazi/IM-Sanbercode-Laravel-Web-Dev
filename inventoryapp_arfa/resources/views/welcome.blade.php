@extends('layout.master')

@section('title','Welcome')

@section('content')

<div class="card">
  <div class="card-body">

    <h3>Welcome {{ $first_name }} {{ $last_name }}</h3>

    <p><strong>Gender:</strong> {{ $gender }}</p>
    <p><strong>Nationality:</strong> {{ $nationality }}</p>
    <p><strong>Language:</strong> {{ implode(', ', $language ?? []) }}</p>
    <p><strong>Bio:</strong> {{ $bio }}</p>

  </div>
</div>

@endsection
