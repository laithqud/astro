<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="form-container">
            <form action="/auth/register" method="post" id="signUpForm">
                <h1>Create Account</h1>
                <div class="input-group">
                    <input type="text" id="name" name="name" placeholder="Name" value="<?php echo isset($values['name']) ? $values['name'] : ''; ?>" />
                    <div id="nameError" class="error"><?php echo isset($errors['name']) ? $errors['name'][0] : ''; ?></div>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email" value="<?php echo isset($values['email']) ? $values['email'] : ''; ?>" />
                    <div id="emailError" class="error"><?php echo isset($emailError) ? $emailError : ''; ?></div>
                    <div id="emailError" class="error"><?php echo isset($errors['email']) ? $errors['email'][0] : ''; ?></div>

                </div>
                <div class="input-group">
                    <input type="number" id="mobile" name="mobile" placeholder="Mobile Number" value="<?php echo isset($values['mobile']) ? $values['mobile'] : ''; ?>" />
                    <div id="mobileError" class="error"><?php echo isset($mobileError) ? $mobileError : ''; ?></div>
                    <div id="mobileError" class="error"><?php echo isset($errors['mobile']) ? $errors['mobile'][0] : ''; ?></div>
                </div>
                <div class="input-group">
                    <input type="date" min="1900-01-01" max="2015-12-31" id="dob" name="dob" placeholder="Date of Birth" value="<?php echo isset($values['dob']) ? $values['dob'] : ''; ?>" />
                    <div id="dobError" class="error"><?php echo isset($errors['dob']) ? $errors['dob'][0] : ''; ?></div>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" value="<?php echo isset($values['password']) ? $values['password'] : ''; ?>" />
                    <div id="passwordError" class="error"><?php echo isset($errors['password']) ? $errors['password'][0] : ''; ?></div>
                </div>
                <div class="input-group">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php echo isset($values['confirm_password']) ? $values['confirm_password'] : ''; ?>" />
                    <div id="confirm_passwordError" class="error"><?php echo isset($errors['confirm_password']) ? $errors['confirm_password'][0] : ''; ?></div>
                </div>
                <button type="submit" class="login-button">Register</button>
            </form>
            <!-- <div class="login-footer">
                <p>Already have an account? <a href="javascript:void(0)" id="signIn2">Sign In</a></p>
            </div> -->
        </div>

        <div class="overlay-container">
            <img src="/public/images/logo.png" width="150" alt="logo">
            <h1>Welcome Back!</h1>
            <p>To keep connected with us, please login with your personal info.</p>
            <div class="links">
                <button class="login-button" onclick="window.location.href='/auth/login'" id="signIn">Log In</button>
                <a onclick="window.location.href='/'" id="signUp">Visit Site</a>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="/public/js/auth.js"></script>
</body>

</html>