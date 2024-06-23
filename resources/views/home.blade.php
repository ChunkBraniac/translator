<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translator Project</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('styles.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <div class="form-group">
                        <label for="inputText">Enter Text</label>
                        <textarea class="form-control" id="inputText" rows="6" placeholder="Type your text here..." name="inputText"
                            @required(true)></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="outputText">Translated Text</label>
                        <textarea class="form-control" id="outputText" rows="6" placeholder="Translation will appear here..."
                            name="outputText" @readonly(true)>{{ isset($translated_text) ? $translated_text : '' }}</textarea>

                        @if (!isset($translated_text))
                            <button type="button" class="btn mt-2 copy-btn" @disabled(true)
                                onclick="copyToClipboard()"><i class="fa-solid fa-clipboard" style="font-size: 20px;"></i></button>
                        @else
                            <button type="button" class="btn mt-2 copy-btn"
                                onclick="copyToClipboard()"><i class="fa-solid fa-clipboard" style="font-size: 20px;"></i></button>
                        @endif
                    </div>
                </div>
            </div>


            <div class="row my-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sourceLanguage">Source Language</label>
                        <select class="form-control" id="sourceLanguage" name="sourceLanguage" @required(true)>
                            <option value="en">English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <!-- Add more languages as needed -->
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="targetLanguage">Target Language</label>
                        <select class="form-control" id="targetLanguage" name="targetLanguage" @required(true)>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>

    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("outputText");
            copyText.select();
            document.execCommand("copy");
            alert("Copied to clipboard: " + copyText.value);
        }
    </script>
</body>

</html>
