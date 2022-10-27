<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pin Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pincode-input@0.4.2/dist/pincode-input.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @laravelPWA
</head>

<body class="antialiased">
    <div id="onload" class="loader-active">
        <div id="stage" class="loader-spinner"></div>
    </div>
    <main>

        <div class="pin-wrapper">
            <div class="timeLog">
                <h2 id="todaysDate"> </h2>
            </div>
            <form method="post" action="{{ route('punch-in') }}">
                @csrf
                <input type='hidden' name='pincode' id='pincode' />
                <div class="pincode-input-container"></div>
            </form>
        </div>
        <div class="login-logo">
            <img src="{{ asset('img/full_logo.svg') }}" class="img-fluid">
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/pincode-input@0.4.2/dist/pincode-input.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(document).ready(function() {

            new PincodeInput(".pincode-input-container", {
                count: 4,
                secure: false,
                previewDuration: 200,
                numeric: true,
                onInput: (value) => {
                    document.forms[0].pincode.value = value;
                    if (value.length == 4) {
                        document.forms[0].submit()
                    }
                },
            });

            function doDate() {
                var str = "";
                var now = new Date();

                str = now.toDateString() + " " + now.toLocaleTimeString();

                var pinTime = moment(str).format("hh:mm:ss A");
                document.getElementById("todaysDate").innerHTML = pinTime;
            }

            setInterval(doDate, 1000);

            doDate();
        });

        @if ($errors->any())
            alert('Invalid Pin')
        @endif
    </script>
</body>

</html>
