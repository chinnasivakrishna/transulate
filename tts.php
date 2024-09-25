<?php
include "layout/header.php";
if (!isset($_SESSION["email"])) {
    header("Location: /login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text-to-Speech Converter</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        body{
            font-family: Arial, sans-serif;
            font-weight:400;
        }
        .card {
            border: 1px solid #dee2e6;
            border-radius: 15px;
        }
        .btn {
            font-size: 14px; /* Decrease button size */
        }
        .form-label {
            font-family: Arial, sans-serif; /* Change font family */
            font-weight: bold; /* Change font weight */
        }
        #language {
            width: 100%; /* Full width for mobile view */
        }
        .or-text {
            margin: 1rem 0; /* Margin for "Or" text */
            font-weight: bold; /* Bold text */
        }
        .file-input {
            width: 100%; /* Full width for file input */
        }
        .or-icon {
            margin: 0 10px; /* Add margin around icon */
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h3 class="text-center font-weight-bold">Text-to-Speech Converter</h3>

            <div class="form-group">
                <label for="language" class="form-label">Select Language:</label>
                <select  style="width:50%;"id="language" class="form-control">
                    <option value="en-US">English</option>
                    <option value="hi-IN">Hindi</option>
                    <option value="en-GB">English (UK)</option>
                    <option value="en-AU">English (Australia)</option>
                    <option value="en-IN">English (India)</option>
                    <option value="en-IE">English (Ireland)</option>
                    <option value="en-ZA">English (South Africa)</option>
                    <option value="en-NZ">English (New Zealand)</option>
                    <option value="te-IN">Telugu</option>
                    <option value="kn-IN">Kannada</option>
                    <option value="ml-IN">Malayalam</option>
                </select>
            </div>

            <div class="form-group">
                <textarea id="text" class="form-control" rows="5" placeholder="Enter text here..."></textarea>
            </div>

            <div class="or-text text-center">
            
                <span>⬅️Or➡️</span>
            </div>

            <div class="form-group">
                <input type="file" id="fileInput" class="form-control-file file-input" accept=".txt" />
            </div>

            <div class="form-group">
                <button id="convertToSpeechBtn" class="btn btn-primary mx-1">Convert to Speech</button>
                <button id="clearBtn" class="btn btn-danger mx-1">Clear All</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    const languageSelect = document.getElementById('language');
    const textArea = document.getElementById('text');
    const convertToSpeechBtn = document.getElementById('convertToSpeechBtn');
    const fileInput = document.getElementById('fileInput');
    const clearBtn = document.getElementById('clearBtn');

    let voices = [];

    function populateVoiceList() {
        voices = window.speechSynthesis.getVoices();
    }

    populateVoiceList();
    window.speechSynthesis.onvoiceschanged = populateVoiceList;

    function textToSpeech(text, lang) {
        const speech = new SpeechSynthesisUtterance();
        speech.text = text;

        const selectedVoice = voices.find(voice => voice.lang === lang);
        speech.voice = selectedVoice || voices[0]; 

        speech.volume = 1;
        speech.rate = 1;
        speech.pitch = 1;

        window.speechSynthesis.speak(speech);
    }

    convertToSpeechBtn.addEventListener('click', () => {
        const language = languageSelect.value;
        const text = textArea.value;

        if (text) {
            textToSpeech(text, language);
        } else {
            Toastify({
                text: "Please enter text or choose a file to convert to speech",
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                stopOnFocus: true
            }).showToast();
        }
    });

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                textArea.value = e.target.result; 
            };
            reader.readAsText(file);
        }
    });

    clearBtn.addEventListener('click', () => {
        textArea.value = '';
        fileInput.value = '';
    });
</script>

</body>
</html>
<?php
include "layout/footer.php";
?>
