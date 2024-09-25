<?php
include "layout/header.php";
if (!isset($_SESSION["email"])) {
    header("Location: /login.php");
    exit;
}
?>
<div class="container mt-5" style=" font-family: Arial, sans-serif; font-weight:400;">
    <div class="d-flex justify-content-center">
        <div class="card shadow" style="width: 100%; max-width: 500px; border-radius: 15px;">
            <div class="card-body">
                <!-- Updated Heading with custom font and weight -->
                <h3 class="text-center mb-4" style="font-family: 'Arial', sans-serif; font-weight: 700;">Speech to Text Generator</h3>

                <!-- Language Selection Dropdown with custom styles -->
                <div class="mb-3">
                    <label for="languageSelect" style="font-size: 14px; font-family: 'Arial', sans-serif;">Select Language</label><br>
                    <select id="languageSelect" class="form-select" style="width: 100%; max-width: 300px; font-family: 'Arial', sans-serif; font-size: 14px;">
                        <option value="en-US">English</option>
                        <option value="te-IN">Telugu</option>
                        <option value="hi-IN">Hindi</option>
                        <option value="ta-IN">Tamil</option>
                        <option value="es-ES">Spanish</option>
                        <option value="mr-IN">Marathi</option>
                        <option value="kn-IN">Kannada</option>
                        <option value="zh-CN">Chinese</option>
                        <option value="ko-KR">Korean</option>
                    </select>
                </div>

                <!-- Start and Stop Recording Buttons -->
                <div class="mb-3">
                    <button id="startBtn" class="btn btn-primary">Start Recording</button>
                    <button id="stopBtn" class="btn btn-danger" disabled>Stop Recording</button>
                </div>

                <!-- Text Area -->
                <div class="mb-3">
                    <textarea id="textArea" class="form-control" rows="5" placeholder="Transcribed text will appear here..."></textarea>
                </div>

                <!-- Clear and Download Buttons -->
                <div class="mb-3">
                    <button id="clearBtn" class="btn btn-secondary">Clear Text</button>
                    <button id="downloadBtn" class="btn btn-success">Download Text</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toastify CSS & JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    const startBtn = document.getElementById('startBtn');
    const stopBtn = document.getElementById('stopBtn');
    const clearBtn = document.getElementById('clearBtn');
    const downloadBtn = document.getElementById('downloadBtn');
    const textArea = document.getElementById('textArea');
    const languageSelect = document.getElementById('languageSelect');

    let recognition;
    function initSpeechRecognition() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();
        recognition.lang = languageSelect.value;
        recognition.interimResults = false;

        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript;
            textArea.value += transcript + '\n';
        };
        recognition.onerror = (event) => {
            alert('Error occurred in speech recognition: ' + event.error);
        };
    }

    startBtn.addEventListener('click', () => {
        initSpeechRecognition();
        recognition.start();
        startBtn.disabled = true;
        stopBtn.disabled = false;
    });

    stopBtn.addEventListener('click', () => {
        recognition.stop();
        startBtn.disabled = false;
        stopBtn.disabled = true;
    });

    clearBtn.addEventListener('click', () => {
        textArea.value = '';
    });

    downloadBtn.addEventListener('click', () => {
        const text = textArea.value.trim();

        if (text === '') {
            Toastify({
                text: "No data to download",
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                stopOnFocus: true
            }).showToast();
        } else {
            const blob = new Blob([text], { type: 'text/plain' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'transcription.txt';
            link.click();
        }
    });

    languageSelect.addEventListener('change', () => {
        if (recognition) {
            recognition.lang = languageSelect.value;
        }
    });
</script>

<?php
include "layout/footer.php";
?>
