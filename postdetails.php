<?php
require_once 'blogdb.php';
$post_details = [];
$join_query = "
SELECT 
    p.id AS post_id,
    p.title AS post_title,
    p.content AS post_content,
    p.created_at AS time_posted,
    u.username,
    u.email AS user_email,
    c.name AS category_name,
    Co.content AS comments
FROM posts p
INNER JOIN categories c
ON c.id = p.category_id
INNER JOIN users u 
ON u.id = p.user_id
INNER JOIN comments Co 
ON Co.post_id = p.id;";

$stmt = $pdo->prepare($join_query);
$stmt->execute();
$post_details = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
</head>
<body>
    <?php if(empty($post_details)): ?>
        <p>No post details</p>
     <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>post_id</th>
                    <th>post_title</th>
                    <th>post_content</th>
                    <th>time_posted</th>
                    <th>username</th>
                    <th>user_email</th>
                    <th>category_name</th>
                    <th>comments</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($post_details as $post_detail): ?>
                <tr>
                    <td><?= htmlspecialchars($post_detail['post_id']) ?></td>
                    <td><?= htmlspecialchars($post_detail['post_title']) ?></td>
                    <td><?= htmlspecialchars($post_detail['post_content']) ?></td>
                    <td><?= htmlspecialchars($post_detail['time_posted']) ?></td>
                    <td><?= htmlspecialchars($post_detail['username']) ?></td>
                    <td><?= htmlspecialchars($post_detail['user_email']) ?></td>
                    <td><?= htmlspecialchars($post_detail['category_name']) ?></td>
                    <td><?= htmlspecialchars($post_detail['comments']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
</body>
</html>