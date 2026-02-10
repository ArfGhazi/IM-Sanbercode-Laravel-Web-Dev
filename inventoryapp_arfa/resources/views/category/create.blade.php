<!DOCTYPE html>
<html>
<head>
    <title>Create Category</title>
</head>
<body>

<h1>Create Category</h1>

<form action="{{ route('category.store') }}" method="POST">
    @csrf

    <label>Name</label><br>
    <input type="text" name="name"><br><br>

    <label>Description</label><br>
    <textarea name="description"></textarea><br><br>

    <button type="submit">Save</button>
</form>

<br>
<a href="{{ route('category.index') }}">Back</a>

</body>
</html>
