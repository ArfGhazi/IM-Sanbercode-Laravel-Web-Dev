<!DOCTYPE html>
<html>
<head>
    <title>Category Detail</title>
</head>
<body>

<h1>Category Detail</h1>

<h2>{{ $category->name }}</h2>
<p>{{ $category->description }}</p>

<br>
<a href="{{ route('category.index') }}">Back</a>

</body>
</html>
