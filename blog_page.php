<?php
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $un = $_POST['uname'];
        $blog = $_POST['userBlog'];

        $query = "INSERT INTO postData (username, blogPost) VALUES ('$un', '$blog')";
        $run = mysqli_query($con, $query);
    }

    $query = "SELECT * FROM postData ORDER BY id DESC";
    $run = mysqli_query($con, $query);

    $posts = [];
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
    <link rel="stylesheet" href="styles.css">
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
            <div class="blog-navbar-right">
                <span class="blog-user-status">Guest User</span>
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
                <form action="" method="post">
                    <input type="text" id="uname" name="uname" placeholder="Enter your username" required><br>
                    <textarea id="userBlog" name="userBlog" placeholder="Write your post..." required></textarea><br>
                    <button type="submit">Submit</button>
                </form>

                <h3>Recent Posts</h3>
                <div id="submittedData">
                    <?php if (empty($posts)): ?>
                        <p>No posts available!</p>
                    <?php else: ?>
                        <?php foreach ($posts as $post): ?>
                            <div class="submitted-post">
                                <h4><?php echo htmlspecialchars($post['username']); ?></h4>
                                <p><?php echo nl2br(htmlspecialchars($post['blogPost'])); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
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