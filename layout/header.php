<?php 
session_start();
$authenticated = false;
if (isset($_SESSION["email"])) {
  $authenticated = true;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TTS&STT</title>
    <link rel="icon" href="./images/images/title.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
      /* Inline CSS for custom styling */
      .navbar-brand img {
        border-radius: 50%; /* Make image round */
        margin-right: 10px; /* Space between image and text */
      }
      .btn-register {
    background-color: #4a90e2; /* Blue color */
    border-color: #4a90e2;
    color: white;
    font-family: 'Arial', sans-serif;
    font-weight: 600;
}

.btn-register:hover {
    background-color: #357ab8; /* Darker blue */
    border-color: #357ab8;
}

.btn-login {
    background-color: #f39c12; /* Orange color */
    border-color: #f39c12;
    color: white;
    font-family: 'Arial', sans-serif;
    font-weight: 600;
}

.btn-login:hover {
    background-color: #e67e22; /* Darker orange */
    border-color: #e67e22;
}

      /* Mobile Navbar background color and button alignment */
      @media (max-width: 768px) {
  .navbar-collapse {
    background-color: white;
    position: absolute;
    width: 100%;
    top: 56px; /* Ensure dropdown shows above index.php */
    z-index: 1000;
  }

  .navbar-nav {
    flex-direction: row; /* Stack items vertically */
    align-items: flex-start; /* Align to the left */
    padding: 10px; /* Add some padding for neatness */
  }

  .navbar-nav .nav-item {
    width: 40%; /* Make each item take full width */
    text-align: left; /* Align text to the left */
    padding-left: 15px; /* Indent for better appearance */
  }

  .navbar-nav .btn {
    width: calc(100% - 30px); /* Ensure buttons take full width with padding */
    text-align: center; /* Center the button text */
  }
  
  .btn-register, .btn-login {
    display: block; /* Ensure buttons take full width on mobile */
    margin: 10px 0; /* Add space between buttons */
  }
}

    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom shadow-sm">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="/index.php"style="font-family: 'Arial', sans-serif; font-weight: 600;color:#005f73;">
        <img src="./images/images/reddy.webp" width="30" height="30" class="d-inline-block align-top" alt="">
        TTS to STT Convertor
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <?php if($authenticated) { ?>
        <ul class="navbar-nav d-flex align-items-center list-unstyled">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Admin
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/profile.php">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
        <?php } else { ?>
        <ul class="navbar-nav d-flex align-items-center list-unstyled">
          <li class="nav-item">
            <a href="/register.php" class="btn btn-register me-2">
              <i class="bi bi-person-plus-fill"></i> Register
            </a>
          </li>
          <li class="nav-item">
            <a href="/login.php" class="btn btn-login">
              <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
          </li>
        </ul>
        <?php } ?>
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoZ6iZ9DOq9z9baXaDlF0u7MlVxQjF7JDD1AnPhQN9JQ9oM" crossorigin="anonymous"></script>
  </body>
</html>
