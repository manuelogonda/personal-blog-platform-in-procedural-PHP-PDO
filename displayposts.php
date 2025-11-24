<?php
require_once 'blogdb.php';
$posts = [];
$fetch_query = "SELECT * FROM posts;";
$stmt = $pdo->prepare($fetch_query);
$stmt->execute();
$posts = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All posts made by far</title>
</head>
<body>
    <?php if(empty($posts)): ?>
    <p>Posts Empty!</p>
    <?php else: ?>
        <h2>Here Are Posts Made</h2>
    <table>
        <thead>
                <tr>
                    <th>Post ID</th>
                    <th>User ID</th>
                    <th>Category ID</th>
                    <th>Post Title</th>
                    <th>Content</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
        </thead>
        <tbody>
        <?php foreach($posts as $post): ?>
            <tr>
                <td><?= htmlspecialchars($post['id']) ?></td>
                <td><?= htmlspecialchars($post['user_id']) ?></td>
                <td><?= htmlspecialchars($post['category_id']) ?></td>
                <td><?= htmlspecialchars($post['title']) ?></td>
                <td><?= htmlspecialchars($post['content']) ?></td>
                <td><?= htmlspecialchars($post['created_at']) ?></td>
                <td>
                    <form action="deletepost.php" method="post">
                        <input type="hidden" name="action" value="delete_post">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">
                        <button type="submit">Delete Post</button>
                    </form>

                    <form action="updatepost.php" method="post">
                        <input type="hidden" name="action" value="edit_post">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">
                        <button type="submit">Edit Post</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>