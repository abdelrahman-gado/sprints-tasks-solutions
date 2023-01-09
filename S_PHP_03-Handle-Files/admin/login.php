<?php

require_once __DIR__ . "/../logic/authentication.php";

if ($_POST) {
  $user = tryLogin($_POST['username'], $_POST['password']);
  if ($user) {
    setUserToSession($user);
    header('Location: index.php');
    die();
  } else {
    $error = "invalid username or password";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?= isset($error) ? "<span class='text-danger'>". $error ."</span>" : "" ?>
  <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
    <input type="text" name="username" class="form-control">
    <input name="password" class="form-control" type="password">
    <button class="btn btn-success">Login</button>
  </form>
</body>

</html>