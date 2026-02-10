<!DOCTYPE html>
<html>
<head>
    <title>Category List</title>
</head>
<body>

<h1>Category List</h1>

<a href="{{ route('category.create') }}">+ Add Category</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<hr>

@forelse($categories as $category)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <h3>{{ $category->name }}</h3>
        <p>{{ $category->description }}</p>

        <a href="{{ route('category.show', $category->id) }}">Detail</a> |
        <a href="{{ route('category.edit', $category->id) }}">Edit</a>

        <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@empty
    <p>No categories found.</p>
@endforelse

</body>
</html>
