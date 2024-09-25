<?php
include "layout/header.php";
?>

<div style="background-color:#005f73; font-family: 'Arial', sans-serif;">
    <div class="container text-white py-5">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <h1 class="mb-5 display-3" style="font-family: 'Roboto', sans-serif; font-weight: bold; letter-spacing: 1px;">
                    Explore the Future with TTS & STT Technology
                </h1>
                <p style="font-size: 18px; line-height: 1.7;">
                    Discover the power of converting text to speech (TTS) and speech to text (STT) effortlessly. Whether you're looking for accessibility features or cutting-edge technology for efficient communication, we have you covered. Experience seamless interaction through our advanced solutions.
                </p>
            </div>
            <div class="col-md-6 text-center">
                <img 
                    src="./images/images/profile.png" 
                    alt="hero"
                    class="img-fluid w-100" 
                    style="
                        max-width: 350px;
                        border-radius: 50%; 
                        border: 1px solid gray; 
                        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
                        transition: transform 0.3s ease-in-out;
                    "
                    onmouseover="this.style.transform='scale(1.1)';" 
                    onmouseout="this.style.transform='scale(1)';"
                />
            </div>
        </div>
    </div>
</div>

<?php
include "layout/footer.php";
?>
