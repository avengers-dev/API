<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000">
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login Admin</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen",
                "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue",
                sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        code {
            font-family: source-code-pro, Menlo, Monaco, Consolas, "Courier New",
                monospace;
        }
    </style>
    <style type="text/css">
        .App {
            text-align: center;
        }

        .App-logo {
            animation: App-logo-spin infinite 20s linear;
            height: 40vmin;
            pointer-events: none;
        }

        .App-header {
            background-color: #282c34;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: calc(10px + 2vmin);
            color: white;
        }

        .App-link {
            color: #61dafb;
        }

        @keyframes App-logo-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
        <div>
            <div>
                <form action="{{ route('post_login_admin')}}" method="post">
                    <div class="container" style="width: 60%;">
                        <div class="row">
                            <div class="col-12 logo"><img src="images/logo-itc.png" width="100%" alt="" class="img-fluid"></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Email</label>
                                        <input style="border: 1px solid #ced4da;" id="email" type="email" name="email" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Mật Khẩu</label>
                                        <input style="border: 1px solid #ced4da;" type="password" name="matkhau" class="form-control" value="">
                                    </div>
                                    <button style="border: 1px solid #ced4da;" type="submit" class="btn btn-primary">Đăng nhập</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/static/js/bundle.js"></script>
    <script src="/static/js/0.chunk.js"></script>
    <script src="/static/js/main.chunk.js"></script>

</body>

</html>