<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $un = $_POST['uname'];
    $blog = $_POST['userBlog'];
    $query = "INSERT INTO postdata (username, blogPost) VALUES ('$un', '$blog')";
    mysqli_query($con, $query);
}

// Search handling
$posts = [];
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $token = mysqli_real_escape_string($con, trim($_GET['search']));
    $query = "SELECT * FROM postdata WHERE username LIKE '%$token%' OR blogPost LIKE '%$token%' ORDER BY id DESC";
} else {
    $query = "SELECT * FROM postdata ORDER BY id DESC";
}
$run = mysqli_query($con, $query);

if (mysqli_num_rows($run) > 0) {
    while ($row = mysqli_fetch_assoc($run)) {
        $posts[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-Blog</title>
    <link rel="stylesheet" href="blog_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

    <header>
        <nav class="blog-navbar">
            <div class="blog-navbar-left">
                <span class="blog-logo">Web-Logo</span>
            </div>
            <div class="blog-navbar-center">
                <span class="blogs-area">web-blog</span>
            </div>
            <div class="blog-user-status">
                <div><?php echo isset($_SESSION['current_username']) ? htmlspecialchars($_SESSION['current_username']) : 'Guest User'; ?></div>
                <i class="fa fa-user-circle"></i>
            </div>
        </nav>
    </header>

    <main>
        <div class="blog-container">
            <div class="left">
                <h3>Frequent Links</h3>
                <ul>
                    <li><a href="https://github.com/sajjadul-islam-somon">GitHub</a></li>
                    <li><a href="https://www.linkedin.com/in/sajjadul-islam-somon/">LinkedIn</a></li>
                    <li><a href="https://www.youtube.com/@sajjadul_islam_shuvo">YouTube</a></li>
                </ul>
            </div>

            <div class="middle">
                <h3>Submit Post</h3>
                <form action="" method="post" class="blog-form">
                    <input type="text" id="uname" name="uname" placeholder="Enter your username" required><br>
                    <textarea id="userBlog" name="userBlog" placeholder="Write your post..." required></textarea><br>
                    <button type="submit">Submit</button>
                </form>

                <br>
                <hr>
                <h3>Recent Posts</h3>
                <form method="GET" action="" class="search-row">
                    <input type="text" id="searchBar" name="search" placeholder="Search posts...">
                    <button type="submit">Search</button>
                </form>

                <?php if (isset($_SESSION['message'])): ?>
                    <div style="color: green; margin-bottom: 10px;"><?php echo $_SESSION['message'];
                                                                    unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>

                <?php foreach ($posts as $post) { ?>
                    <div class="submitted-post">
                        <h4><?php echo htmlspecialchars($post['username']); ?></h4>
                        <p><?php echo nl2br(htmlspecialchars($post['blogPost'])); ?></p>

                        <div class="post-actions">
                            <form action="update_post.php" method="POST">
                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                <button type="submit" class="btn-update">Update</button>
                            </form>

                            <form action="delete_post.php" method="POST">
                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>


            </div>

            <div class="right">
                <h3>Information</h3>
                <p>Contact Info: somon15-5749@diu.edu.bd</p>
                <p>Phone: +880130130XXXX</p>
            </div>
        </div>
    </main>

</body>

</html>