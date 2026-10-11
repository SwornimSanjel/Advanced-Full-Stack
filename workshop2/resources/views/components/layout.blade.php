@props([
"title" => "Student Course App"
])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>

<body>
    <x-navbar />

    <div style="width:80%; margin:auto;">
        {{ $slot }}
    </div>

    <div>
        &copy; Group 4 {{ date("Y") }}
    </div>
</body>

</html>