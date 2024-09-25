<?php
// Include the header
include "layout/header.php";
// Check if user is authenticated by checking if email is set in the session
if (!isset($_SESSION["email"])) {
    header("Location: /login.php"); // Redirect to login if not logged in
    exit;
}
?>

<div class="container" style="max-width: 600px; margin: auto; padding: 25px;">
    <div class="row">
        <div class="col-lg-12 mx-auto border shadow p-4" style="padding: 20px;border-radius:15px;">
            <h2 class="text-center mb-4" style="font-family: 'Arial', sans-serif; color: black; font-weight: 600; font-size: 24px;">Profile</h2>
            <hr/>
            <div class="row mb-3">
                <div class="col-4 col-sm-4" style="font-weight: bold;">First Name</div>
                <div class="col-8 col-sm-8"><?=$_SESSION["first_name"] ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4" style="font-weight: bold;">Last Name</div>
                <div class="col-8 col-sm-8"><?=$_SESSION["last_name"] ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4" style="font-weight: bold;">Email</div>
                <div class="col-8 col-sm-8"><?=$_SESSION["email"] ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4" style="font-weight: bold;">Phone</div>
                <div class="col-8 col-sm-8"><?=$_SESSION["phone"] ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4" style="font-weight: bold;">Address</div>
                <div class="col-8 col-sm-8"><?=$_SESSION["address"] ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4" style="font-weight: bold;">Register At</div>
                <div class="col-8 col-sm-8"><?=$_SESSION["created_at"] ?></div>
            </div>
        </div>
    </div>
</div>

<?php
// Include the footer
include "layout/footer.php";
?>
