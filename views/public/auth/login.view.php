<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/login.css">

</head>

<body>
    <div class="login-container">
        <div class="form-container">
            <form action="/auth/login" method="post" id="signInForm">
                <h1>Sign In</h1>
                <div class="input-group">
                    <input type="email" name="email" id="email" placeholder="Email" />
                    <?php if (isset($emailError)): ?>
                        <div id="emailError" class="error"><?php echo $emailError; ?></div>
                    <?php else: ?>
                        <div id="emailError" class="error"></div>
                    <?php endif; ?>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password" />
                    <?php if (isset($passwordError)): ?>
                        <div id="passwordError" class="error"><?php echo $passwordError; ?></div>
                    <?php else: ?>
                        <div id="passwordError" class="error"></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="login-button">Log In</button>
            </form>
            <!-- <div class="login-footer">
                <p>Don't have an account? <a href="javascript:void(0)" id="signUp2">Sign Up</a></p>
            </div> -->
        </div>

        <div class="overlay-container">
            <img src="/public/images/logo.png" width="150" alt="logo">
            <h1>Hello, Friend!</h1>
            <p>Enter your personal details and start your journey with us.</p>
            <div class="links">
                <button class="login-button" onclick="window.location.href='/auth/register'" id="signUp">Register</button>
                <a onclick="window.location.href='/'" id="signUp">Visit Site</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/public/js/auth.js"></script>
</body>

</html>