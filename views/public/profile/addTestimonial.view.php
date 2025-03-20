<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Testimonial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/EditProfile.css"> <!-- Reuse existing styles -->
</head>

<body>
    <?php include_once('./views/layout/public/header.php'); ?>

    <div class="edit-profile-container">
        <!-- Display errors if any -->
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="alert alert-danger text-center d-flex justify-content-center align-items-center">
                <ul class="list-unstyled">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error[0]; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Display success message if condition is met -->
        <?php if (isset($accepted) && $accepted === true): ?>
            <div class="alert alert-success text-center d-flex justify-content-center align-items-center">
                Testimonial submitted successfully! Redirecting...
            </div>
            <!-- Set a JavaScript variable to handle redirection -->
            <script>
                var accepted = true;
            </script>
        <?php endif; ?>

        <h2>Add Your Testimonial</h2>
        <form id="addTestimonialForm" action="/testimonials/add" method="post">
            <!-- Name Field (pre-filled from session) -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo $_SESSION['user']['name']; ?>" readonly>
            </div>

            <!-- Message Field -->
            <div class="form-group">
                <label for="message">Your Testimonial</label>
                <textarea id="message" name="message" rows="5" required></textarea>
                <div id="messageError" class="error"></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" <?php if (isset($accepted) && $accepted === true): ?> disabled <?php endif; ?> class="btn-save">Submit Testimonial</button>
        </form>
    </div>

    <?php include_once('./views/layout/public/footer.php'); ?>

    <script src="/public/js/navbar.js"></script>
    <script>
        // Redirect after 3 seconds if success is true

        if (typeof accepted !== 'undefined' && accepted === true) {
            setTimeout(function() {
                window.location.href = '/';
            }, 1000);
        }
    </script>
</body>

</html>