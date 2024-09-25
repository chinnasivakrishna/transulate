<?php
include "layout/header.php";
if (!isset($_SESSION["email"])) {
    header("Location: /login.php"); // Redirect to login if not logged in
    exit;
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-center flex-wrap" style="gap: 30px; padding: 20px;">
        <!-- Text to Speech Card (Blue Background) -->
        <div class="card bg-dark shadow-lg" style="width: 22rem; border-radius: 15px;">
            <img src="./images/images/sss.png" class="card-img-top" alt="Text to Speech" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
            <div class="card-body" style=" color: black;">
                <h5 class="card-title text-info"style=" font-weight:500; ">Text to Speech Converter</h5>
                <p class="card-text"style="color:white; font-weight:500;">Convert written text into spoken words.</p>
                <a href="tts.php" class="btn btn-outline-info">Go to Converter</a>
            </div>
        </div>

        <!-- Speech to Text Card (Red Background) -->
        <div class="card bg-success shadow-lg" style="width: 22rem; border-radius: 15px;">
            <img src="./images/images/ttt.png" class="card-img-top" alt="Speech to Text" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
            <div class="card-body" style=" color: black;">
                <h5 class="card-title"style="color:white; font-weight:500; ">Speech to Text Converter</h5>
                <p class="card-text" style="color:black; font-weight:500;">Convert spoken words into written text.</p>
                <a href="./stt.php" class="btn btn-outline-light">Go to Converter</a>
            </div>
        </div>
    </div>
</div>

<?php
include "layout/footer.php";
?>
