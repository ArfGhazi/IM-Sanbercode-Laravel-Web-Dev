@extends('layout.master')

@section('title','Register')

@section('content')

<div class="card">
  <div class="card-body">

    <h4 class="card-title mb-4">Register</h4>

    <form action="/welcome" method="POST">
      @csrf

      <!-- First Name -->
      <div class="mb-3">
        <label class="form-label">First name:</label>
        <input type="text" name="first_name" class="form-control" required>
      </div>

      <!-- Last Name -->
      <div class="mb-3">
        <label class="form-label">Last name:</label>
        <input type="text" name="last_name" class="form-control" required>
      </div>

      <!-- Gender -->
      <div class="mb-3">
        <label class="form-label d-block">Gender:</label>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" value="Male">
          <label class="form-check-label">Male</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" value="Female">
          <label class="form-check-label">Female</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" value="Other">
          <label class="form-check-label">Other</label>
        </div>
      </div>

      <!-- Nationality -->
      <div class="mb-3">
        <label class="form-label">Nationality:</label>
        <select name="nationality" class="form-select">
          <option value="Indonesian">Indonesian</option>
          <option value="Singaporean">Singaporean</option>
          <option value="Malaysian">Malaysian</option>
        </select>
      </div>

      <!-- Language -->
      <div class="mb-3">
        <label class="form-label d-block">Language Spoken:</label>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="language[]" value="Bahasa Indonesia">
          <label class="form-check-label">Bahasa Indonesia</label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="language[]" value="English">
          <label class="form-check-label">English</label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="language[]" value="Other">
          <label class="form-check-label">Other</label>
        </div>
      </div>

      <!-- Bio -->
      <div class="mb-4">
        <label class="form-label">Bio:</label>
        <textarea name="bio" rows="4" class="form-control"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">
        Submit
      </button>

    </form>

  </div>
</div>

@endsection
