<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

    <h1>Halaman Register</h1>

    <form action="/welcome" method="POST">
        @csrf

        <label>Nama Depan :</label><br>
        <input type="text" name="first_name"><br><br>

        <label>Nama Belakang :</label><br>
        <input type="text" name="last_name"><br><br>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
