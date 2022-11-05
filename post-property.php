<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_submit'])) {

        $property_name = $_POST['property_name'];
        $property_description = $_POST["property_description"];
        $property_address = $_POST["property_address"];
        $property_country = $_POST['property_country'];
        $property_image = $_FILES["property_image"]["name"];
        $property_image_size = $_FILES["property_image"]["size"];
        $property_image_tmp_name = $_FILES['property_image']["tmp_name"];
        $property_image_type = $_FILES["property_image"]["type"];
        $property_image_ext = strtolower(end(explode(".", $_FILES["property_image"]["name"])));
        $extensions = array("jpeg", "jpg", "png");

        if (!empty($property_name) && !empty($property_description) && !empty($property_address) && !empty($property_country) && !empty($property_image)) {
            if (in_array($property_image_ext, $extensions) === false) {
                header("post-property.php?error=file_extension_not_allowed");
            }
            if ($property_image_size > 2097152) {
                header("location:post-property.php?error=file_size");
            }
            if (move_uploaded_file($property_image_tmp_name, "uploads/" . $property_image)) {
                include_once __DIR__ . "/includes/db.inc.php";
                $property_name = mysqli_real_escape_string($conn, $property_name);
                $property_description = mysqli_real_escape_string($conn, $property_description);
                $property_country  = mysqli_real_escape_string($conn, $property_country);
                $property_address = mysqli_real_escape_string($conn, $property_address);
                $property_image = mysqli_real_escape_string($conn, $property_image);

                $query = "INSERT INTO `properties` (`property_name`, `property_description`, `property_address`, `property_country`, `property_image`, `property_uploaded_by`) VALUES ( '$property_name', '$property_description', '$property_address', '$property_country', '$property_image', '1' );";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    header("location:index.php?success=post");
                } else {
                    header("location:post-property.php?error=unknown");
                }
            } else {
                header("location:post-property.php?error=file_upload");
            }
        } else {
            echo ("$property_name, $property_description, $property_address, $property_country,$property_image");
            // header("location:post-property.php?error=empty_field");
        }
    }
}
include_once __DIR__ . "/partials/header.php" ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="heading">Post Property</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="post-property.php" enctype="multipart/form-data">
                <div class="form-grou my-2p">
                    <label class="form-label">Property Name</label>
                    <input class="form-control" required placeholder="Property Name" type="text" name="property_name">
                </div>
                <div class="form-group my-2">
                    <label class="form-label">Property Description</label>
                    <textarea class="form-control" required placeholder="Property Description" type="text"
                        name="property_description"></textarea>
                </div>
                <div class="form-group my-2">
                    <label class="form-label">Property Address</label>
                    <textarea class="form-control" required placeholder="Property Addresss" type="text"
                        name="property_address"></textarea>
                </div>
                <div class="form-group my-2">
                    <label class="form-label">Property Country</label>
                    <?php include_once __DIR__ . "/partials/select-country.php" ?>

                </div>
                <div class="form-group my-2">
                    <label class="form-label">Property Image</label>
                    <input class="form-control" name="property_image" required type="file" placeholder="Property Image">
                </div>
                <button class="btn btn-outline-primary" type="submit" name="form_submit">Submit Form</button>

            </form>
        </div>
    </div>
</div>


<?php include_once __DIR__ . "/partials/footer.php" ?>