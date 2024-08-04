<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('form/css/style.css') }}" />
    <meta name="robots" content="noindex, follow" />
</head>

<body>
    <div class="wrapper"
        style="background-image: url('https://images.unsplash.com/photo-1520583044630-61405854dfb4?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
        <div class="inner">
            <div class="image-holder">
                <img src="https://images.unsplash.com/photo-1602810320073-1230c46d89d4?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Image not found" />
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h3>Login Form</h3>

                <div class="form-wrapper">
                    <input id="email" type="text" name="email" :value="old('email')" required autofocus
                        placeholder="Email Address" class="form-control" />
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="form-wrapper">
                    <input id="password" type="password" name="password" placeholder="Password" class="form-control"
                        required />
                    <i class="fa-solid fa-eye"></i>
                </div>
                <span style="color: red; font-size:14px">
                    @foreach ($errors->get('email') as $message)
                        {{ $message }}<br>
                    @endforeach
                </span>

                <button>
                    Login
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                <div class="redirect-form">
                    <span>Don't have account</span>
                    <a href="{{ route('register') }}">
                        {{ __('Signup now') }}
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "UA-23581568-13");
    </script>
</body>

</html>
