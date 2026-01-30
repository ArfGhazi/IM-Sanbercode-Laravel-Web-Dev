<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ape Class</title>
</head>
<body>

<?php
require_once "Animal.php";

class Ape extends Animal {
    public $legs = 2;

    public function yell() {
        echo "Auooo";
    }
}
?>

</body>
</html>
