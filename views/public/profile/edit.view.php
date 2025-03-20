<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/editProfile.css">
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
    <?php include_once('./views/layout/public/header.php'); ?>

    <div class="edit-profile-container">
        <h2>Edit Profile</h2>
        <form id="editProfileForm" action="/profile/<?php echo $id; ?>/edit" method="post">
            <input type="hidden" name="_method" value="PUT">
            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo $profile['name']; ?>" required>
                <div id="nameError" class="error"><?php echo isset($errors['name']) ? $errors['name'][0] : ''; ?></div>
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $profile['email']; ?>" required>
                <div id="emailError" class="error"><?php echo isset($emailError) ? $emailError : ''; ?></div>
                <div id="emailError" class="error"><?php echo isset($errors['email']) ? $errors['email'][0] : ''; ?></div>
            </div>

            <!-- Mobile Number Field -->
            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel" id="mobile" name="mobile" value="<?php echo $profile['mobile']; ?>" required>
                <div id="mobileError" class="error"><?php echo isset($mobileError) ? $mobileError : ''; ?></div>
                <div id="mobileError" class="error"><?php echo isset($errors['mobile']) ? $errors['mobile'][0] : ''; ?></div>
            </div>

            <!-- Date of Birth Field -->
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="<?php echo $profile['date_of_birth']; ?>" required>
                <div id="dobError" class="error"><?php echo isset($errors['dob']) ? $errors['dob'][0] : ''; ?></div>
            </div>

            <!-- Save Button -->
            <button type="submit" class="btn-save">Save Changes</button>
        </form>
    </div>

    <script>
        // JavaScript for form validation
        document.getElementById('editProfileForm').addEventListener('submit', function(event) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const mobile = document.getElementById('mobile').value.trim();
            const dob = document.getElementById('dob').value.trim();

            // Clear previous error messages
            document.getElementById('nameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('mobileError').textContent = '';
            document.getElementById('dobError').textContent = '';

            let isValid = true;

            // Validate Name
            if (name === '') {
                document.getElementById('nameError').textContent = 'Name is required.';
                isValid = false;
            }

            // Validate Email
            if (email === '') {
                document.getElementById('emailError').textContent = 'Email is required.';
                isValid = false;
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                document.getElementById('emailError').textContent = 'Email is not valid.';
                isValid = false;
            }

            // Validate Mobile Number
            if (mobile === '') {
                document.getElementById('mobileError').textContent = 'Mobile number is required.';
                isValid = false;
            } else if (!/^\d{10}$/.test(mobile)) {
                document.getElementById('mobileError').textContent = 'Mobile number should be 10 digits.';
                isValid = false;
            }

            // Validate Date of Birth
            if (dob === '') {
                document.getElementById('dobError').textContent = 'Date of Birth is required.';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    </script>

    <?php include_once('./views/layout/public/footer.php'); ?>
    <script src="/public/js/navbar.js"></script>
</body>

</html>