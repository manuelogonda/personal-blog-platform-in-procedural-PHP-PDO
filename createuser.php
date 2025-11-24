<?php
require_once 'blogdb.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  //cost factor

  $options = [
   'cost' => 12
  ];

  //password hashing
  $hashedpwd = password_hash($password,PASSWORD_BCRYPT,$options);

  //sanitize inputs
  $sanitizedemail = filter_var($email,FILTER_SANITIZE_EMAIL);

  $insert_query = "INSERT INTO users (username,password,email) 
                      VALUES(:username,:pwd,:email);";
    $stmt = $pdo->prepare($insert_query);
    $stmt->bindParam(":username",$username);
    $stmt->bindParam(":pwd",$hashedpwd);
    $stmt->bindParam(":email",$sanitizedemail);
    $stmt->execute();

    $stmt = null;
    $pdo = null;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account in a Blog</title>
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <label for="username">Enter username</label>
        <input type="text" name="username" minlength="3" maxlength="10" required/>
        <label for="email">Enter E-mail</label>
        <input type="email" name="email" required/>
        <label for="password">Enter Password</label>
        <input type="password" name="password" minlength="4" maxlength="8" required/>
        <button type="submit">Register</button>
    </form>
</body>
</html>