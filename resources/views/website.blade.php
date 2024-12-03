<!DOCTYPE html>
<html>

<head>
    <title>{{ $app_setting['name'] }}</title>
    <link rel="shortcut icon" href="{{ $app_setting['favicon'] }}" type="image/x-icon">
    @vite('resources/js/app.js')
</head>

<body>
    <div id="app"></div>
</body>

</html>
