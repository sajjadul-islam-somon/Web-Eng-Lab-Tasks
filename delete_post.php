<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id'])) {
    $postId = intval($_POST['post_id']);


    $query = "DELETE FROM postdata WHERE id = $postId";
    $run = mysqli_query($con, $query);

    if ($run) {
        $_SESSION['message'] = "Post deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete post.";
    }
}

header("Location: blog_page.php");
exit;
?>
