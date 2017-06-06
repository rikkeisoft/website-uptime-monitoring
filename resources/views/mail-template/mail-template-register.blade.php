<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <style type="text/css">
            .btn-lg, .btn-group-lg>.btn {
                padding: 10px 16px;
                font-size: 18px;
                line-height: 1.33;
                border-radius: 6px;
            }

            .btn-primary {
                color: #fff;
                background-color: #428bca;
                border-color: #357ebd;
            }
        </style>
    </head>
    <body>
        <h2>Hi {{$name}}</h2>
        <h1>Welcome to Website Uptime Monitor system, please activate your account by clicking the below url:</h1>
        <p><a  class="btn btn-primary btn-lg" href="{{ url('/activate?access_token='.$access_token) }}">Active now</a></p>
    </body>
</html>


