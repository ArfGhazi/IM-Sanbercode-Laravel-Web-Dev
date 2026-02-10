<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>

<h1>Edit Category</h1>

<form action="{{ route('category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name</label><br>
    <input type="text" name="name" value="{{ $category->name }}"><br><br>

    <label>Description</label><br>
    <textarea name="description">{{ $category->description }}</textarea><br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="{{ route('category.index') }}">Back</a>

</body>
</html>
