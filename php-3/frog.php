<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Frog Class</title>
</head>
<body>

<?php
require_once "Animal.php";

class Frog extends Animal {
    public function jump() {
        echo "hop hop";
    }
}
?>

</body>
</html>
