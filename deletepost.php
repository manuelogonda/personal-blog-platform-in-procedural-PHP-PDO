<?php
require_once 'blogdb.php';
$posts = [];

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_post'){
 $id = $_POST['id'];

 $delete_query = "DELETE FROM posts WHERE id =:id;";
 $stmt = $pdo->prepare($delete_query);
 $stmt->bindParam(":id",$id);
 $stmt->execute();
 $posts = $stmt->fetch();
  echo "<br>";
 echo "Post number $id has been deleted successfully";
}
?>