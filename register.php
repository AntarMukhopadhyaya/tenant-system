<?php
$title = "Register User";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_submit'])) {
        include_once __DIR__ . "/includes/db.inc.php";
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
        $user_confirm_password = mysqli_real_escape_string($conn, $_POST['user_confirm_password']);
        if (!empty($name) && !empty($email) && !empty($user_name) && !empty($user_password) && !empty($user_confirm_password)) {
            $query = "SELECT * FROM `users` WHERE `user_name`='$user_name'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
                $query = "INSERT INTO `users` ( `name`, `email`, `user_name`, `user_password`) VALUES ( '$name', '$email', '$user_name', '$hash_password');";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    header("location:login.php?success=register");
                    exit();
                } else {
                    header("location:register.php?error=unknown");
                    exit();
                }
            } else {
                header("location:register.php?error=user_exists");
                exit();
            }
        }
        if ($password == $confirm_password) {

            header("location:register.php?error=confirm_password");
            exit();
        }
        mysqli_close($conn);
    } else {
        header("location:register.php");
        exit();
    }
}


include_once __DIR__ . "/partials/header.php" ?>
<div class="container my-2">
    <div class="card my-2">
        <div class="card-header">
            <h5 class="heading">User Registration</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <div class="form-group my-2">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group my-2">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group my-2">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="user_name" required>
                </div>
                <div class="form-group my-2">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="user_password" required>
                </div>
                <div class="form-group my-2">
                    <label class="form-label">Confirm Password</label>
                    <input type="passsword" class="form-control" name="user_confirm_password" required>
                </div>
                <button type="submit" class="btn btn-outline-primary" name="form_submit">Register</button>






            </form>
        </div>
    </div>
</div>
<?php include_once __DIR__ . "/partials/footer.php" ?>