
function validate() {
    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const mobileInput = document.getElementById("mobile");
    const dobInput = document.getElementById("dob");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm_password");

    const nameError = document.getElementById("nameError");
    const emailError = document.getElementById("emailError");
    const mobileError = document.getElementById("mobileError");
    const dobError = document.getElementById("dobError");
    const passwordError = document.getElementById("passwordError");
    const confirmPasswordError = document.getElementById("confirm_passwordError");

    let isValid = true;

    // Clear previous error messages and styles
    nameError.textContent = "";
    nameInput.style.border = "";
    emailError.textContent = "";
    emailInput.style.border = "";
    mobileError.textContent = "";
    mobileInput.style.border = "";
    dobError.textContent = "";
    dobInput.style.border = "";
    passwordError.textContent = "";
    passwordInput.style.border = "";
    confirmPasswordError.textContent = "";
    confirmPasswordInput.style.border = "";

    // Validate Name
    if (nameInput.value.trim() === "") {
        nameError.textContent = "Name is required.";
        nameInput.style.border = "2px solid red";
        isValid = false;
    } else if (!/^[A-Za-z\s]+$/.test(nameInput.value)) {
        nameError.textContent = "Name should contain letters only.";
        nameInput.style.border = "2px solid red";
        isValid = false;
    } else if (nameInput.value.length < 3) {
        nameError.textContent = "Name should be at least 3 characters.";
        nameInput.style.border = "2px solid red";
        isValid = false;
    }


    // Validate Email
    if (emailInput.value.trim() === "") {
        emailError.textContent = "Email is required.";
        emailInput.style.border = "2px solid red";
        isValid = false;
    } else if (!/\S+@\S+\.\S+/.test(emailInput.value)) {
        emailError.textContent = "Email is not valid.";
        emailInput.style.border = "2px solid red";
        isValid = false;
    }

    // Validate Mobile Number
    if (mobileInput.value.trim() === "") {
        mobileError.textContent = "Mobile number is required.";
        mobileInput.style.border = "2px solid red";
        isValid = false;
    } else if (!/^\d{10}$/.test(mobileInput.value)) {
        mobileError.textContent = "Mobile number should be 10 digits.";
        mobileInput.style.border = "2px solid red";
        isValid = false;
    }

    // Validate Date of Birth
    if (dobInput.value.trim() === "") {
        dobError.textContent = "Date of Birth is required.";
        dobInput.style.border = "2px solid red";
        isValid = false;
    }

    // Validate Password
    if (passwordInput.value.trim() === "") {
        passwordError.textContent = "Password is required.";
        passwordInput.style.border = "2px solid red";
        isValid = false;
    } else if (passwordInput.value.length < 8) {
        passwordError.textContent = "Password should be at least 8 characters.";
        passwordInput.style.border = "2px solid red";
        isValid = false;
    }

    // Validate Confirm Password
    if (confirmPasswordInput.value.trim() === "") {
        confirmPasswordError.textContent = "Confirm Password is required.";
        confirmPasswordInput.style.border = "2px solid red";
        isValid = false;
    } else if (confirmPasswordInput.value !== passwordInput.value) {
        confirmPasswordError.textContent = "Passwords do not match.";
        confirmPasswordInput.style.border = "2px solid red";
        isValid = false;
    }

    return isValid; 
}

const inputs = document.querySelectorAll('input');

inputs.forEach(input => {
  input.addEventListener('input', () => {
    const errorElement = document.getElementById(`${input.id}Error`);
    errorElement.textContent = '';
    input.style.border = '';
  });
});

document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById('signUpForm');

    if (registerForm) {
        registerForm.addEventListener('submit', function (event) {
            event.preventDefault();
            if (validate()) {
                this.submit();
            }
        });
    }
});


function validateLogin() {
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");

    let isValid = true;

    // Clear previous error messages and styles
    emailError.textContent = "";
    emailInput.style.border = "";
    passwordError.textContent = "";
    passwordInput.style.border = "";

    // Validate Email
    if (emailInput.value.trim() === "") {
        emailError.textContent = "Email is required.";
        emailInput.style.border = "2px solid red";
        isValid = false;
    } else if (!/\S+@\S+\.\S+/.test(emailInput.value)) {
        emailError.textContent = "Email is not valid.";
        emailInput.style.border = "2px solid red";
        isValid = false;
    }

    // Validate Password
    if (passwordInput.value.trim() === "") {
        passwordError.textContent = "Password is required.";
        passwordInput.style.border = "2px solid red";
        isValid = false;
    }

    return isValid;
}

// Add event listeners to clear errors on input
const loginInputs = document.querySelectorAll('#signInForm input');
loginInputs.forEach(input => {
    input.addEventListener('input', () => {
        const errorElement = document.getElementById(`${input.id}Error`);
        errorElement.textContent = '';
        input.style.border = '';
    });
});

// Add form submission handler
document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById('signInForm');

    if (loginForm) {
        loginForm.addEventListener('submit', function (event) {
            event.preventDefault();
            if (validateLogin()) {
                this.submit();
            }
        });
    }
});

