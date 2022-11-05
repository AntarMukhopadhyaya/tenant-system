<?php
$query = "SELECT * FROM properties ORDER BY property_uploaded_at";
include_once __DIR__ . "/includes/db.inc.php";
$result = mysqli_query($conn, $query);

include_once __DIR__ . "/partials/header.php";
include_once __DIR__ . "/partials/alerts.php";
?>
<div class="container my-2">
    <div class="row my-2">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="card my-2 mx-2" style="width: 18rem;">
            <img src="uploads/<?= htmlspecialchars($row['property_image']) ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['property_name']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($row['property_description']) ?></p>
                <a href="<?= htmlspecialchars("property.php?property=" . $row["property_id"]) ?>"
                    class="btn btn-primary">View
                    Property</a>
            </div>
        </div>
        <?php endwhile; ?>

    </div>
</div>

<?php include_once __DIR__ . "/partials/footer.php" ?>