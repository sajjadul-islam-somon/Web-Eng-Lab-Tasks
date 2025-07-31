<?php
session_start();
include 'connect.php';

$error_message = '';
$username_value = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $un = $_POST['username'];
    $pass = $_POST['password'];

    $query = "SELECT username FROM signupdata WHERE username='$un' AND password='$pass'";
    $run = mysqli_query($con, $query);

    if (mysqli_num_rows($run) > 0) {
        $_SESSION['current_username'] = $un;
        header("Location: blog_page.php");
        exit;
    } else {
        $error_message = "❌ Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="formcard">
        <div class="formfield">
            <form action="" method="POST" class="login-form" autocomplete="off">
                <h3>LOGIN</h3>

                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter username" required />

                <br />

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required />

                <?php if (!empty($error_message)) { ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php } ?>

                <br /><br />
                <button type="submit">Login</button>
            </form>

        </div>
    </section>
</body>

</html>