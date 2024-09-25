<?php
include "layout/header.php";
if (isset($_SESSION["email"])) {
    header("location: /index.php"); // Corrected redirection to index if already logged in
    exit;
}

$first_name = $last_name = $email = $phone = $address = "";
$first_name_error = $last_name_error = $email_error = $phone_error = "";
$address_error = $password_error = $confirm_password_error = "";
$error = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic Validation
    if (empty($first_name)) {
        $first_name_error = "First name is required";
        $error = true;
    }
    if (empty($last_name)) {
        $last_name_error = "Last name is required";
        $error = true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Email format is not valid";
        $error = true;
    }

    // Database interaction to check existing email
    include "tools/db.php";
    $dbConnection = getDatabaseConnection();

    if (!$dbConnection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $statement = $dbConnection->prepare("SELECT id FROM users WHERE email=?");
    $statement->bind_param("s", $email);
    $statement->execute();
    $statement->store_result();
    if ($statement->num_rows > 0) {
        $email_error = "Email already exists";
        $error = true;
    }
    $statement->close();

    // Phone validation
    if (!preg_match("/^(\+?\d{1,3})?[- ]?\d{7,12}$/", $phone)) {
        $phone_error = "Phone format is not valid";
        $error = true;
    }

    // Password validation
    if (strlen($password) < 6) {
        $password_error = "Password must have at least 6 characters";
        $error = true;
    }
    if ($confirm_password != $password) {
        $confirm_password_error = "Password and Confirm Password do not match";
        $error = true;
    }

    // If no errors, proceed to store data
    if (!$error) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $statement = $dbConnection->prepare(
            "INSERT INTO users(first_name, last_name, email, phone, address, password, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $statement->bind_param('sssssss', $first_name, $last_name, $email, $phone, $address, $password, $created_at);

        if ($statement->execute()) {
            // Get inserted ID
            $insert_id = $dbConnection->insert_id;
            $statement->close();

            // Clear session and redirect to login page after successful registration
            session_unset();
            session_destroy();

            header("location: /login.php");
            exit;
        } else {
            echo "Error: " . $dbConnection->error;
        }
    }
}
?>

<!-- HTML for Registration Form -->
<div class="container" style="max-width: 800px; margin: auto; padding: 30px;">
    <div class="row">
        <div class="col-lg-12 mx-auto border shadow p-4" style="font-family: 'Arial', sans-serif; color: #333;">
            <h2 class="text-center mb-4" style="font-family: 'Arial', sans-serif;color:black;font-weight:600">Register</h2>
            <hr />
            <form method="post">
                <!-- First Name -->
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">First Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="first_name" value="<?= $first_name ?>" style="font-family: 'Arial', sans-serif;"/>
                        <span class="text-danger" style="color: #d9534f;"><?= $first_name_error ?></span>
                    </div>
                </div>

                <!-- Last Name -->
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Last Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="last_name" value="<?= $last_name ?>" style="font-family: 'Arial', sans-serif;"/>
                        <span class="text-danger" style="color: #d9534f;"><?= $last_name_error ?></span>
                    </div>
                </div>

                <!-- Email -->
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Email*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="email" value="<?= $email ?>" style="font-family: 'Arial', sans-serif;"/>
                        <span class="text-danger" style="color: #d9534f;"><?= $email_error ?></span>
                    </div>
                </div>

                <!-- Phone -->
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Phone*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phone" value="<?= $phone ?>" style="font-family: 'Arial', sans-serif;"/>
                        <span class="text-danger" style="color: #d9534f;"><?= $phone_error ?></span>
                    </div>
                </div>

                <!-- Address -->
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Address</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="address" value="<?= $address ?>" style="font-family: 'Arial', sans-serif;"/>
                        <span class="text-danger" style="color: #d9534f;"><?= $address_error ?></span>
                    </div>
                </div>

                <!-- Password -->
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="password" type="password" style="font-family: 'Arial', sans-serif;"/>
                        <span class="text-danger" style="color: #d9534f;"><?= $password_error ?></span>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Confirm Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="confirm_password" type="password" style="font-family: 'Arial', sans-serif;"/>
                        <span class="text-danger" style="color: #d9534f;"><?= $confirm_password_error ?></span>
                    </div>
                </div>

                <!-- Register & Cancel Buttons -->
                <div class="row mb-3" style="display: flex; justify-content: space-between;">
                    <div class="col d-grid">
                        <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; padding: 10px;">Register</button>
                    </div>
                    <div class="col d-grid">
                        <a href="/index.php" class="btn btn-outline-primary" style="color: #007bff; border-color: #007bff; padding: 10px;">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include "layout/footer.php";
?>
