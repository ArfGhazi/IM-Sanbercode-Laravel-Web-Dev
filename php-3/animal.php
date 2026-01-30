<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Animal Class</title>
</head>
<body>

<?php
class Animal {
    public $name;
    public $legs = 4;
    public $cold_blooded = "no";

    public function __construct($name) {
        $this->name = $name;
    }
}
?>

</body>
</html>
