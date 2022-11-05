<?php
if (isset($_GET['property'])) {
    include_once __DIR__ . "/includes/db.inc.php";
    $property_id = mysqli_real_escape_string($conn, $_GET['property']);

    $query = "SELECT * FROM properties WHERE `property_id` = '$property_id'";


    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        header("location:index.php?error=property_not_found");
    }
} else {
    header("location:index.php");
}
include_once __DIR__ . "/partials/header.php" ?>
<div class="container my-2">
    <div class="row my-2">
        <div class="col">
            <img src="./uploads/image.jpg" class="img-fluid" alt="...">
        </div>
        <div class="col">
            <div class="container">
                <?php if ($row = mysqli_fetch_assoc($result)) : ?>
                <h2><u><?= $row['property_name'] ?></u></h2>
                <p><?= $row["property_description"] ?></p>
                <small class="text-muted"><?= $row["property_uploaded_at"] ?></small>
                <hr />
                <a class="btn btn-outline-primary btn-sm">Contact Owner</a>
                <a class="btn btn-outline-danger btn-sm">Report Property</a>
                <?php endif; ?>
            </div>
            <div class="container">
                <?php
                $query = "SELECT * FROM comments WHERE comment_property_id=$property_id";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {

                    echo '<ul class="list-group">';
                    while ($comment = mysqli_fetch_assoc($result)) {
                        echo ('
                                <li class="list-group-item">' . $comment['comment_content'] . '</li>
                               
                         
                            '
                        );
                    }
                    echo "</ul>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include_once __DIR__ . "/partials/footer.php" ?>