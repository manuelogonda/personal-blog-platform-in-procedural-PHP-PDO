<?php
require_once 'blogdb.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $userid = $_POST['userid'];
  $categoryid = $_POST['categoryid'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  
  $mytitle = strtoupper($title);
  //input validation and sanitization
$santuserid = htmlspecialchars(filter_var($userid,FILTER_SANITIZE_NUMBER_INT));
$santcategoryid = htmlspecialchars(filter_var($categoryid,FILTER_SANITIZE_NUMBER_INT));
$santtitle = htmlspecialchars(filter_var($mytitle,FILTER_SANITIZE_SPECIAL_CHARS));
$santcontent = htmlspecialchars(filter_var($content,FILTER_SANITIZE_SPECIAL_CHARS));

$insert_query = "INSERT INTO posts (user_id,category_id,title,content)
                  VALUES(:user_id,:category_id,:title,:content);";
   
$stmt = $pdo->prepare($insert_query);
$stmt->bindParam(":user_id",$santuserid);
$stmt->bindParam(":category_id",$santcategoryid);
$stmt->bindParam(":title",$santtitle);
$stmt->bindParam(":content",$santcontent);
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
    <title>Create a post in a Blog</title>
</head>
<body>
    <a href="displayposts.php"><button type="button">See Posts</button></a>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <label for="userid">User ID</label>
        <input type="number" name="userid" >
        <label for="categoryid">Category ID</label>
        <input type="number" name="categoryid" >
        <label for="title">Post Title</label>
        <input type="text" name="title" >
        <label for="content">What is the post all about?</label>
        <textarea name="content">
        </textarea>
        <button type="submit">Add Post</button>
    </form>
</body>
</html>
