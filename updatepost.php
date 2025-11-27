<?php
require_once 'blogdb.php';
$post = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
   if(isset($_POST['action']) && $_POST['action'] === 'edit_post'){
    $id = $_POST['id'];
    $fetch_query = "SELECT category_id,title,content FROM posts WHERE id = :id;";
    $stmt = $pdo->prepare( $fetch_query);
    $stmt->bindParam(":id",$id);
    $stmt->execute();
    $post = $stmt->fetch();

    if(!$post){
        echo "No posts found";
    }

   }else if(isset($_POST['action']) && $_POST['action'] === 'update_post'){
    $id = $_POST['id'];
    $cate_id = $_POST['category_id'];
    $title = $_POST['new_title'];
    $new_comment = $_POST['comment'];
    $update_query = "UPDATE posts SET category_id = :categ_id, title = :title,
                             content = :content WHERE id = :id;";
    $stmt = $pdo->prepare($update_query);
    $stmt->bindParam(":id",$id);
    $stmt->bindParam(":categ_id",$cate_id);
    $stmt->bindParam(":title",$title);
    $stmt->bindParam(":content",$new_comment);
    $stmt->execute();
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update your Post</title>
</head>
<body>
    <h2>Update your post</h2>
    <?php if(!empty($post)): ?>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
         <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">
        <input type="hidden" name="action" value="update_post">
        <br>
        <label for="cate_id">New Category ID</label>
        <input type="number" name="category_id">
        <label for="new_title">New Post Title</label>
        <input type="text" name="new_title">
        <label for="new_comment">New Comment</label>
        <textarea name="comment" ></textarea>
        <button type="submit">Update Post</button>
    </form>
    <?php endif; ?>
</body>
</html>