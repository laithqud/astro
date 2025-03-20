<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Apply your site's styles */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #000924;
            /* Dark blue background */
            color: #ffffff;
            /* White text */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* SweetAlert2 custom styles to match your site */
        .swal2-popup {
            background-color: #0d162f;
            /* Dark background for the pop-up */

            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #ffffff;
            /* White text */
        }

        .swal2-title {
            font-size: 24px;
            color: #ffffff;
            /* White title */
        }

        .swal2-content {
            font-size: 14px;
            color: #CCCCCC;
            /* Light gray for content */
        }

        .swal2-confirm {
            background: linear-gradient(to right, #1e90ff, #6a5acd);
            /* Gradient button */
            color: #ffffff;
            /* White text */
            border: none;
            border-radius: 50px;
            font-size: 16px;
            outline: none !important;
            padding: 12px 24px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .swal2-confirm:focus {
            outline: none !important;
            border: none !important;
        }

        .swal2-confirm:hover {
            background: linear-gradient(to left, #1e90ff, #6a5acd) !important;
            /* Reverse gradient on hover */
        }

        .swal2-timer-progress-bar {
            background: linear-gradient(to right, #1e90ff, #6a5acd);
            /* Purple progress bar */
        }

        .swal2-success .swal2-success-ring {
            border-color: #1e90ff !important;
            /* Purple ring */
        }

        .swal2-success [class^='swal2-success-line'] {
            background-color: #1e90ff !important;
            /* Purple checkmark */
        }
    </style>
    <link rel="stylesheet" href="/public/css/style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show SweetAlert2 pop-up
            Swal.fire({
                title: 'Success!',
                text: '<?php echo $_SESSION['success_message']; ?>',
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 3000, // Auto-close after 3 seconds
                timerProgressBar: true,
                willClose: () => {
                    // Redirect to login page after the pop-up closes
                    window.location.href = '/auth/login';
                }
            });
        });
    </script>
</head>

<body>
    <!-- No content needed in the body as the pop-up handles everything -->
</body>

</html>