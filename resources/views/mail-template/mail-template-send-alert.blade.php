<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alert Service</title>
    <style type="text/css">
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 0;
            border: 1px solid #eee;
        }

        h1 {
            color: white;
            text-align: center;
            background-color: rgb(80, 187, 110);
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-top: 1em;
        }

        h3, p {
            text-align: center;

        }

    </style>
</head>
<body>
<div class="container">
    <h1>Alert</h1>
    <h2>Service {{ $result }}</h2>
    <h3>Your service <a href="{{ $result }}">{{ $name }}</a>!</h3>
    <p>If you need help, call: 04123613461</p>
</div>
</body>
</html>