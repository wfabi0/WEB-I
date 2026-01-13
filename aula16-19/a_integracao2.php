<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intro PHP</title>
</head>
<body>
    <h1>Teste PHP</h1>
    <?php
        $v = 60;
        if($v > 50) {
           echo '<p style="color: blue;">Maior</p>';
        } else {
           echo '<p style="color: red;">Menor ou igual</p>';
        }
    ?>
</body>
</html>