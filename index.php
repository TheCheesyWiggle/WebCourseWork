
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="./global.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
  </head>
    <body>
    <?php
    if (empty($_SESSION['username'])){
        echo "<p>You are not using a registered session?<p>";
        echo "<a href='registration.php'>Register now</a>";
    }else{
        echo "<h1>Welcome to Pairs</h1>";
        echo "<a href='pairs.php'>Click here to play!</a>";
    }
    ?>
    </body>
</html>