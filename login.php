<?php
include_once __DIR__ . "/partials/header.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['form_submit'])) {
        include_once __DIR__ . "/includes/db.inc.php";
        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
        if (!empty($user_name) && !empty($user_password)) {
            $query = "SELECT * FROM `users` WHERE `user_name` = '$user_name'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                if ($user = mysqli_fetch_assoc($result)) {
                    if (password_verify($user_password, $user['user_password'])) {
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['user_name'] = $user['user_name'];
                        header("location:index.php?success=login");
                        exit();
                    } else {
                        header("location:login.php?error=wrong_credentials");
                        exit();
                    }
                }
            } else {
                header("location:login.php?error=user_not_found");
                exit();
            }
        } else {
            header("location:login.php?error=empty_fields");
            exit();
        }
    } else {
        header("location:login.php");
    }
}


include_once __DIR__ . "/partials/alerts.php";
?>
<div class="container my-2">
    <div class="card my-2">
        <div class="card-header">
            <h5 class="heading">User Login</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">


                <div class="form-group my-2">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="user_name" required>
                </div>
                <div class="form-group my-2">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="user_password" required>
                </div>

                <button type="submit" class="btn btn-outline-primary" name="form_submit">Login</button>






            </form>
        </div>
    </div>
</div>
<?php include_once __DIR__ . "/partials/footer.php" ?>