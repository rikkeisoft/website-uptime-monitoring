<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alert Service</title>
    <style type="text/css">
        * {
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 0;
        }

        h1 {
            background-color: rgb(80, 187, 110);
            margin: 0 auto;
            width: 100%;
            height: 4em;
            padding-top: 5%;
            color: #ffffff;
            font-family: Arial;
            font-size: 34px;
            line-height: 38px;
            text-align: center;
            font-weight: bold;
            border: 1px solid inherit;
        }

        h2 {
            text-align: center;
            margin-top: 1em;
        }

        h3, p, a {
            text-align: center;
            text-decoration: none;
            color: #222;
        }

        footer {
            background-color: #2F3133;
            width: 100%;
            height: 6em;
            clear: both;
            color: #FFFFFF;
            text-align: center;
            padding-top: 5em;
        }

    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Website Monitoring Alert</h1>
    </header>
    <article>
        <h2>Service is {{ $result }}</h2>
        <h3>Your service: {{ $name }} (<a href="{{ $url }}">{{ $url }}</a>)</h3>
        <p>If you need help, call: 04123613461</p>
    </article>
    <footer>
        (c) 2017 - Rikkeisoft
    </footer>
</div>
</body>
</html>