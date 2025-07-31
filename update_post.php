<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id']) && !isset($_POST['updated_post'])) {
    $postId = intval($_POST['post_id']);
    $query = "SELECT * FROM postdata WHERE id = $postId";
    $run = mysqli_query($con, $query);

    if (mysqli_num_rows($run) > 0) {
        $post = mysqli_fetch_assoc($run);
    } else {
        echo "Post not found.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updated_post'])) {
    $postId = intval($_POST['post_id']);
    $updatedUsername = mysqli_real_escape_string($con, $_POST['updated_username']);
    $updatedPost = mysqli_real_escape_string($con, $_POST['updated_post']);

    $query = "UPDATE postdata SET username = '$updatedUsername', blogPost = '$updatedPost' WHERE id = $postId";
    $run = mysqli_query($con, $query);

    if ($run) {
        $_SESSION['message'] = "Post updated successfully.";
    } else {
        $_SESSION['message'] = "Failed to update post.";
    }

    header("Location: blog_page.php");
    exit;
}
?>

<?php if (isset($post)): ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Update Post</title>
        <style>
            body {
                font-family: montserrat, sans-serif;
                background-color: #f4f4f4;
                color: #333;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: flex-start;
                min-height: 100vh;
            }

            .update-container {
                background: white;
                max-width: 600px;
                width: 100%;
                margin: 50px 15px;
                padding: 20px 30px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgb(0 0 0 / 0.1);
            }

            h3 {
                margin-bottom: 20px;
                color: #007bff;
            }

            label {
                display: block;
                margin-top: 15px;
                margin-bottom: 6px;
                font-weight: 600;
            }

            input[type="text"],
            textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid rgb(192, 192, 192);
                border-radius: 5px;
                font-size: 14px;
                font-family: inherit;
                resize: vertical;
            }

            button {
                margin-top: 20px;
                background-color: rgba(0, 123, 255);
                color: white;
                border: none;
                border-radius: 5px;
                padding: 12px 20px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.2s ease;
            }

            button:hover {
                background-color: rgb(0, 94, 194);
            }

            a {
                display: inline-block;
                margin-top: 15px;
                color: #007bff;
                text-decoration: none;
                font-size: 14px;
            }

            a:hover {
                text-decoration: underline;
            }
        </style>

    </head>

    <body>
        <div style="max-width: 600px; margin: 50px auto;">
            <h3>Update Post</h3>
            <form action="update_post.php" method="POST" class="blog-form">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">

                <label for="updated_username">Username:</label>
                <input type="text" name="updated_username" id="updated_username" value="<?php echo htmlspecialchars($post['username']); ?>" required>

                <label for="updated_post">Blog Post:</label>
                <textarea name="updated_post" id="updated_post" rows="6" required><?php echo htmlspecialchars($post['blogPost']); ?></textarea>

                <button type="submit">Save Changes</button>
            </form>
            <br>
            <a href="blog_page.php">Back to Blog</a>
        </div>
    </body>

    </html>
<?php endif; ?>