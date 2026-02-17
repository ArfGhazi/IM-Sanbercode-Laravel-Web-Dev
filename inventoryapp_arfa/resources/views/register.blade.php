@extends('layouts.app')

@section('content')

<div class="card p-4">
<h3>Register Form</h3>

<form action="{{ route('form.welcome') }}" method="POST">
@csrf

<input class="form-control mb-2" type="text" name="first_name" placeholder="First Name">
<input class="form-control mb-2" type="text" name="last_name" placeholder="Last Name">

<label>Gender</label><br>
<input type="radio" name="gender" value="Male"> Male
<input type="radio" name="gender" value="Female"> Female
<br><br>

<select class="form-control mb-2" name="nationality">
<option>Indonesia</option>
<option>Malaysia</option>
<option>Singapore</option>
</select>

<label>Language</label><br>
<input type="checkbox" name="language[]" value="Indonesia"> Indonesia
<input type="checkbox" name="language[]" value="English"> English
<br><br>

<textarea class="form-control mb-2" name="bio"></textarea>

<button class="btn btn-primary">Submit</button>

</form>
</div>

@endsection
