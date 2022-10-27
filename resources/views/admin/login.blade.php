<!doctype html>
<html lang="en">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Login page</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-grey">
        <div
            class="login-container login-username d-flex flex-column align-items-center justify-content-center text-center">
            <div class="mid-container p-5">
                <form class="form w-100 mb-3" action="{{route('admin.login.post')}}" method="post">
                    @csrf
                    <img src="{{ asset('img/login-icon.png') }}" alt="Lock icon">
                    <h3>Sign in to continue to the application</h3>
                    <div class="form-group">
                        <input name="email" class="form-control" type="text" placeholder="Username" aria-label="" maxlength=""
                            autocomplete="off" inputmode="text"  value="{{\App\Models\User::where('role','admin')->first()->email}}">
                    </div>
                    <div class="form-group">
                        <input name="password" class="form-control" type="password" placeholder="Password" aria-label="" maxlength=""
                            autocomplete="off" inputmode="text"  value="password">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-danger btn-lg" type="submit">Login</button>
                    </div>
                </form>
            </div>

            <div class="login-logo">
                <img src="{{ asset('img/icon.svg') }}" class="img-fluid">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/base-scripts.js') }}"></script>
</body>

</html>
