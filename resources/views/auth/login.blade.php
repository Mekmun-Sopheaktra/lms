<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <!-- Meta-Link -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="">
    <meta name="mlapplication-tap-highlight" content="no">

    <!-- Title -->
    <title>@yield('title')</title>
    <!-- FaveIcon-Link -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Bootstrap-Min-Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Font-Awesome--Min-Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <!--Bootstrap-Icon-Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">
    <!--Style--Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!--Responsive--Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>

<body>
    <div class="d-flex vh-100">
        <div class="col-md-3 mx-auto my-auto">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="main-card card h-100 d-flex flex-column">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logo-new.png') }}" alt="" width="200">
                    </div>
                    <form action="{{ route('admin.authenticate') }}" method="POST">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-2">
                            <label class="form-label">Email address</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>

                        <!-- Submit button -->
                        <div class="text-center"></div>
                        <button type="submit" id="loginBtn" class="btn btn-dipBlue bgBlue mb-3 w-100">Login</button>
                    </form>
                    @if (config('app.env') == 'local')
                    <div class="border p-3">
                        <button onclick="email.value = 'admin@readylms.com'; password.value = 'secret@123'"
                            class="btn btn-sm btn-primary bgBlue small float-end">Copy</button>
                        <strong>Email:</strong> admin@readylms.com <br>
                        <strong>Password:</strong> secret@123
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
