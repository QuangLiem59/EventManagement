<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Apiato</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 18px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 150px;
            color: #00bdf4;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .button {
            border: 1px solid #00bdf4;
            width: 60px;
            height: 30px;
            border-radius: 5px;
            color: #00bdf4;
            background-color: white;
            line-height: 30px;
            font-size: 14px;
            text-decoration: none;
            font-weight: bold;
        }

        .button:hover {
            color: white;
            background-color: #00bdf4;
            cursor: pointer;
        }

        hr.rounded {
            border-top: 1px solid #00bdf4;
            border-radius: 50px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        @guest
            <a href="{{ route('login') }}" class="top-right button">Login</a>
        @endguest

        @auth('web')
            <form id="form" action="{{  route('post_logout') }}" method="POST">@csrf</form>
            <a class="top-right button" href="javascript:void(0)" onclick="document.getElementById('form').submit()">Logout</a>
        @endauth
        
        <div class="title m-b-md">{{ config('app.name') }}</div>

        <hr class="rounded m-b-md">

        <div class="links">
            <a href="{{ route('private_docs') }}">API Documentation</a>
        </div>
    </div>
</div>
</body>
</html>
