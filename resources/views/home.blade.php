<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translator Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .loader {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 50%;
            left: 50%;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 80px;
            height: 80px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .copy-btn {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="my-5 text-center">
            <h1>Language Translator</h1>
        </header>

        <form action="{{ route('translate') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="inputText" class="form-label">Enter Text</label>
                        <textarea class="form-control" id="inputText" rows="6" placeholder="Type your text here..." name="inputText" required></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="outputText" class="form-label">Translated Text</label>
                        <textarea class="form-control" id="outputText" rows="6" placeholder="Translation will appear here..." name="outputText" readonly>{{ isset($translated_text) ? $translated_text : '' }}</textarea>

                        @if (!isset($translated_text))
                            <button type="button" class="btn border-0 mt-2 copy-btn" disabled data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tooltip on top" onclick="copyToClipboard()"><i class="fa-solid fa-clipboard" style="font-size: 20px;"></i></button>
                        @else
                            <button type="button" class="btn mt-2 copy-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Copy text to clipboard" onclick="copyToClipboard()"><i class="fa-solid fa-clipboard" style="font-size: 20px;"></i></button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sourceLanguage" class="form-label">Source Language</label>
                        <select class="form-select" id="sourceLanguage" name="sourceLanguage" required>
                            <option value="en">English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <!-- Add more languages as needed -->
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="targetLanguage" class="form-label">Target Language</label>
                        <select class="form-select" id="targetLanguage" name="targetLanguage" required>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <option value="en">English</option>
                            <!-- Add more languages as needed -->
                        </select>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary" id="translateButton">Translate</button>
            </div>
        </form>

        <div class="loader" id="loader"></div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>

    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("outputText");
            copyText.select();
            document.execCommand("copy");

            var tooltip = new bootstrap.Tooltip(document.querySelector('.copy-btn'), {
                title: 'Copied to clipboard: ' + copyText.value,
                trigger: 'manual'
            });
            tooltip.show();

            setTimeout(function () {
                tooltip.hide();
            }, 2000);
        }

        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>

</html>
