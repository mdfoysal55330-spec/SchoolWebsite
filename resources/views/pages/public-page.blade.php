
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $page->title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div style="max-width: 1100px; margin: 40px auto; padding: 20px;">

        <h1>{{ $page->title }}</h1>

        <div style="margin-top: 30px; line-height: 1.8;">
            {!! $page->content !!}
        </div>

    </div>

</body>
</html>
