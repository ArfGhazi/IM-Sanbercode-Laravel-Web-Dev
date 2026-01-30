<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OOP Animal</title>
</head>
<body>

<?php
require_once "Animal.php";
require_once "Ape.php";
require_once "Frog.php";

echo "<h2>Release 0</h2>";

$sheep = new Animal("shaun");
echo "Name : " . $sheep->name . "<br>";
echo "Legs : " . $sheep->legs . "<br>";
echo "Cold Blooded : " . $sheep->cold_blooded . "<br>";

echo "<hr>";

echo "<h2>Release 1</h2>";

$sungokong = new Ape("kera sakti");
echo "Ape yell : ";
$sungokong->yell();

echo "<br><br>";

$kodok = new Frog("buduk");
echo "Frog jump : ";
$kodok->jump();
?>

</body>
</html>
