<?php
include "layout/header.php";

if (isset($_SESSION["email"])) {
    header("Location: /dash.php"); // Redirect to dash.php if already logged in
    exit;
}
$email = "";
$error = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email) || empty($password)) {
        $error = "Email and Password are required";
    } else {
        include "tools/db.php";
        $dbConnection = getDatabaseConnection();
        $statement = $dbConnection->prepare("SELECT id, first_name, last_name, phone, address, password, created_at FROM users WHERE email=?");
        $statement->bind_param("s", $email);
        $statement->execute();
        $statement->bind_result($id, $first_name, $last_name, $phone, $address, $stored_password, $created_at);
        if ($statement->fetch()) {
            if (password_verify($password, $stored_password)) {
                $_SESSION["id"] = $id;
                $_SESSION["first_name"] = $first_name;
                $_SESSION["last_name"] = $last_name;
                $_SESSION["email"] = $email;
                $_SESSION["phone"] = $phone;
                $_SESSION["address"] = $address;
                $_SESSION["created_at"] = $created_at;
                header("Location: /dash.php");
                exit;
            }
        }
        $statement->close();
        $error = "Email or Password invalid";
    }
}
?>
<div class="container py-5" style="max-width: 400px; margin: auto;">
    <div class="border shadow p-4">
        <h2 class="text-center mb-4" style="font-family: 'Arial', sans-serif;color:black;font-weight:600">Login</h2>
        <hr/>
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="color: #d9534f;">
                <strong><?= $error ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label" style="font-family: 'Arial', sans-serif; color: #333;">Email</label>
                <input class="form-control" name="email" value="<?= $email ?>" style="font-family: 'Arial', sans-serif;"/>
            </div>
            <div class="mb-3">
                <label class="form-label" style="font-family: 'Arial', sans-serif; color: #333;">Password</label>
                <input class="form-control" name="password" type="password" style="font-family: 'Arial', sans-serif;"/>
            </div>
            <div class="row mb-3">
                <div class="col d-grid">
                    <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;">Log in</button>
                </div>
                <div class="col d-grid">
                    <a href="/index.php" class="btn btn-outline-primary" style="color: #007bff; border-color: #007bff;">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include "layout/footer.php";
?>
