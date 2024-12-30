<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/register.css">
    <script src="scripts/jquery-3.7.1.min.js"></script>
    <title>Register</title>
</head>
<body>
    <div class="register-container">
        <form id="registerForm" method="post">
            <h1>Create an account</h1>

            <div class="input-box">
                <input type="text" placeholder="Username" id="username" name="username" class="username">
                <i class='bx bxs-user'></i>
                <span id="usernameError" class="error-message"></span>
            </div>

            <div class="input-box">
                <input type="email" placeholder="Email" id="email" name="email" class="email">
                <i class='bx bxs-envelope'></i>
                <span id="emailError" class="error-message"></span>
            </div>

            <div class="input-box">
                <input type="text" placeholder="Phone Number" id="phoneno" name="phoneno" class="phoneno">
                <i class='bx bxs-phone'></i>
                <span id="phoneError" class="error-message"></span>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" id="password" name="password" class="password">
                <i class='bx bxs-lock-alt'></i>
                <span id="passwordError" class="error-message"></span>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Confirm Password" id="conformpassword" name="conformpassword" class="conformpassword">
                <i class='bx bxs-lock-alt'></i>
                <span id="passwordmatch" class="error-message"></span>
            </div>

            <button type="submit" class="btn" disabled>Register</button>

            <div class="login-link">
                <p>
                    Already have an account?
                    <a href="./index.php">Login</a>
                </p>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            function validateForm() {
                var isValid = true;

                // Check if all fields are empty
                var username = $('#username').val();
                var email = $('#email').val();
                var phoneno = $('#phoneno').val();
                var password = $('#password').val();
                var confirmPassword = $('#conformpassword').val();

                // If all fields are empty, disable the button
                if (!username && !email && !phoneno && !password && !confirmPassword) {
                    isValid = false;
                }

                // Enable or disable the submit button based on the overall validity
                $('.btn').prop('disabled', !isValid);
            }

            // Attach keyup event handlers to input fields
            $('#username, #email, #phoneno, #password, #conformpassword').keyup(function () {
                validateForm(); // Validate the form on keyup
            });

            $('#username').keyup(function () {
                var username = $('#username').val();
                if (username.length < 8 || username.length > 25) {
                    $('#usernameError').text("Username must be more than 8 characters and less than 25 characters.").css('color', 'red');
                } else {
                    $('#usernameError').text("");
                }
            });

            $('#email').keyup(function () {
                var email = $('#email').val();
                var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if (email === "") {
                    $('#emailError').text("Email is required.").css('color', 'red');
                } else if (!emailPattern.test(email)) {
                    $('#emailError').text("Enter a valid email.").css('color', 'red');
                } else {
                    $('#emailError').text("");
                }
            });

            $('#phoneno').keyup(function () {
                var phoneno = $('#phoneno').val();
                var phonePattern = /^[0-9]{10}$/;
                if (phoneno === "") {
                    $('#phoneError').text("Phone number is required.").css('color', 'red');
                } else if (!phonePattern.test(phoneno)) {
                    $('#phoneError').text("Enter a valid 10 digit phone number.").css('color', 'red');
                } else {
                    $('#phoneError').text("");
                }
            });

            $('#password').keyup(function () {
                var password = $('#password').val();
                var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{9,}$/;
                if (password === "") {
                    $('#passwordError').text("Password is required.").css('color', 'red');
                } else if (!passwordPattern.test(password)) {
                    $('#passwordError').text("Password must be at least 9 characters, with uppercase, lowercase, number, and special character.").css('color', 'red');
                } else {
                    $('#passwordError').text("");
                }
            });

            $('#conformpassword').keyup(function () {
                var password = $('#password').val();
                var confirmPassword = $('#conformpassword').val();
                if (confirmPassword !== password) {
                    $('#passwordmatch').text("Passwords do not match.");
                } else {
                    $('#passwordmatch').text("");
                }
            });

            // AJAX submission
            $("#registerForm").submit(function (e) {
                e.preventDefault();

                if ($("#usernameError").text() || $("#emailError").text() || $("#phoneError").text() || $("#passwordError").text() || $("#passwordmatch").text()) {
                    alert("Please fix the errors in the form.");
                    return;
                }

                $.ajax({
                    url: "process_register.php",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.trim() === "success") {
                            alert("Registration successful!");
                            window.location.href = "index.php";
                        } else {
                            alert(response);
                        }
                    },
                    error: function () {
                        alert("An error occurred while submitting the form. Please try again.");
                    }
                });
            });
        });
    </script>
</body>
</html>
