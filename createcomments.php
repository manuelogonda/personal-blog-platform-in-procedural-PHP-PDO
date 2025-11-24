<?php
require_once 'blogdb.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];
$comment = $_POST['comment'];

$insert_query = "INSERT INTO comments (user_id,post_id,content) 
                   VALUES(:user_id,:post_id,:comment);";
    $stmt = $pdo->prepare($insert_query);
    $stmt->bindParam(":user_id",$user_id);
    $stmt->bindParam(":post_id",$post_id);
    $stmt->bindParam(":comment",$comment);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post comments</title>
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <label for="userid">User ID</label>
        <input type="number" name="user_id">
        <label for="postid">Post ID</label>
        <input type="number" name="post_id">
        <label for="comment">Comment</label>
        <textarea name="comment"></textarea>
        <button type="submit">Add a comment</button>
    </form>
</body>
</html>