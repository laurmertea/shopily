<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <title><?= defaultTitle() ;?></title>
</head>
<body class="silver-bg">
    <?php if (hasMessage()) showHTMLMessage() ;?>
    <div class="content_container">
        <div class="columns clearfix">
            <div class="col-50">
                <div class="centered-text" id="hero">
                    <h1 id="hero-title" class="black-shadow">Shopily.</h1>
                    <h4>Your little <span class="orange-shadow">shopping list</span> app made for <span class="orange-shadow">a better life</span></h4>
                </div>
            </div>
            <div class="col-50" id="login-col">
                <div class="left white-bg" id="login-form">
                    <div class="centered-text" style="margin-top: 20px;">
                        <form action="login" method="post">
                            <input type="text" id="user_login" name="user_login" placeholder="Username / E-mail"><br />
                            <label class="error left hide-in-5" for="user_login"><?= ($errors['user_login']) ?? "";?></label>
                            <input type="password" id="password_login" name="password_login" placeholder="Password"><br/>
                            <label class="error left hide-in-5" for="password_login"><?= ($errors['password_login']) ?? "";?></label>
                            <input class="green-bg" id="login_btn" type="submit" value="Login">
                        </form>
                    </div>

                    <hr class="separator">

                    <div class="centered-text" style="margin-top: 20px;">
                        or <a href="#" onclick="toggleBy('login');" id="register-href">register</a> for an account!
                    </div>
                </div>
            </div>
            <div class="col-50 hidden" id="register-col">
                <div class="left white-bg" id="register-form">
                    <div class="centered-text" style="margin-top: 20px;">
                        <form action="register" method="post">
                            <input type="text" id="user_register" name="user_register" placeholder="Username"><br />
                            <label class="error left hide-in-5" for="user_register"><?= ($errors['user_register']) ?? "";?></label>
                            <input type="text" id="email" name="email" placeholder="E-mail"><br />
                            <label class="error left hide-in-5" for="email"><?= ($errors['email']) ?? "";?></label>
                            <input type="text" id="first_name" name="first_name" placeholder="First name"><br />
                            <label class="error left hide-in-5" for="first_name"><?= ($errors['first_name']) ?? "";?></label>
                            <input type="text" id="last_name" name="last_name" placeholder="Last name"><br />
                            <label class="error left hide-in-5" for="last_name"><?= ($errors['last_name']) ?? "";?></label>
                            <input type="password" id="password_register" name="password_register" placeholder="Password"><br/>
                            <label class="error left hide-in-5" for="password_register"><?= ($errors['password_register']) ?? "";?></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"><br/>
                            <label class="error left hide-in-5" for="password_confirmation"><?= ($errors['password_confirmation']) ?? "";?></label>
                            <input class="blue-bg" id="register_btn" type="submit" value="Register">
                        </form>
                    </div>

                    <hr class="separator">

                    <div class="centered-text" style="margin-top: 20px;">
                        or <a href="#" onclick="toggleBy('register');" id="login-href">login</a> into your account!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle login / register -->
    <script>
        var err = <?php echo json_encode($errors);?>;

        Array.prototype.last = function(){
            return this[this.length - 1];
        }

        var uri = ['login', 'register'];
        var result = uri.indexOf((window.location.href).split("/").last());
        if (result !== -1) {
            document.getElementById(`${uri[result]}-col`).classList.remove('hidden');
            document.getElementById(`${uri[Number(! Boolean(result))]}-col`).classList.add('hidden');
        }

        function toHide(id){
            return document.getElementById(`${id}-col`);
        }

        function toShow(id){
            return (id === 'register') ? document.getElementById('login-col') : document.getElementById('register-col');
        }

        function toggleBy(id){
            document.querySelectorAll('.error').forEach(e => e.textContent = "");
            toHide(id).classList.toggle('hidden');
            toShow(id).classList.toggle('hidden');
        } 
    </script>
</body>
</html>