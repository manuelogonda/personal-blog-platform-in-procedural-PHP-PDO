<?php
require_once 'blogdb.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $name = $_POST['name'];
   $insert_query = "INSERT INTO categories (name) VALUES(:name);";
   $stmt = $pdo->prepare($insert_query);
   $stmt->bindParam(":name",$name);
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
    <title>Create Categories in a Blog</title>
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
      <label for="categoryname">Category Name</label>
      <input type="text" name="name" >
      <button type="submit">Add Category</button>
    </form>
</body>
</html>