<?php if (isset($_GET['success'])) : ?>
<div class="alert alert-success my-2">
    <?php if ($_GET['success'] == "post") : ?>
    <strong>Property Posted Successfully.</strong>
    <?php endif; ?>
    <?php if ($_GET['success'] == "register") : ?>
    <strong>User register successfully. Please login with the provided credentials.</strong>
    <?php endif; ?>
    <?php if ($_GET['success'] == "login") : ?>
    <strong>User login successfully on <?= date("h:i:sa") ?></strong>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php if (isset($_GET['error'])) : ?>
<div class="alert alert-danger my-2">
    <?php if ($_GET['error'] == "empty_fields") : ?>
    <strong>Please make sure all the required fields are properly filled and try again.</strong>
    <?php endif; ?>
    <?php if ($_GET['error'] == "unknown_error") : ?>
    <strong>Something went wrong please try again later.</strong>
    <?php endif; ?>
</div>
<?php endif; ?>