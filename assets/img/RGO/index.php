<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/styles.css">
        
        <title>RGO</title>
    </head>
    <body>
        <div class="container">
        <img src="assets/img/Alangilan-CIT.jpg" alt="login image" class="login__img">
            <div class="login__content" style="display: flex; justify-content: center; align-items: center;">
                <form action="" class="login__form" >
                <div style="display: flex; justify-content: center; align-items: center;">
                    <img src="assets/img/rgo1.png" alt="Logo" style="width: 150px; height: 150px; scale: 150%;">
                    </div>                   
                    <div>
                        <div class="login__inputs">
                            <div>
                                <label for="" class="login__label">Email</label>
                                <input type="email" placeholder="Enter your email address" required class="login__input">
                            </div>
    
                            <div>
                                <label for="" class="login__label">Password</label>
    
                                <div class="login__box">
                                    <input type="password" placeholder="Enter your password" required class="login__input" id="input-pass">
                                    <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="login__check">
                            <input type="checkbox" class="login__check-input">
                            <label for="" class="login__check-label">Remember me</label>
                        </div>
                    </div>

                    <div>
                        <div class="login__buttons">
                            <button class="login__button">Log In</button>
                       </div>

                        <a href="#" class="login__forgot">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>


        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>
    </body>
</html>