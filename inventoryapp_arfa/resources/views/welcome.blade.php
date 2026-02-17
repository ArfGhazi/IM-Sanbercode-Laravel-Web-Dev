@extends('layouts.app')

@section('content')

<div class="card p-4">

<h3>Welcome {{ $first_name }} {{ $last_name }}</h3>

<p>Gender : {{ $gender ?: '-' }}</p>
<p>Nationality : {{ $nationality ?: '-' }}</p>
<p>Language : {{ count($language) ? implode(', ', $language) : '-' }}</p>
<p>Bio : {{ $bio ?: '-' }}</p>

</div>

@endsection
