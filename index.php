<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="scripts/jquery-3.7.1.min.js"></script>

    <title>Login</title>
</head>
<body>
   
    <div class="login-container">
        <form id="loginForm" method="post">
            
            <h1>Login</h1>

            <div class="input-box">
                <input type="text" placeholder="Username" name="username" id="username">
                <i class='bx bxs-user'></i>
                <span id="usernameError" class="error-message"></span>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" name="password" id="password">
                <i class='bx bxs-lock-alt'></i>
                <span id="passwordError" class="error-message"></span>
            </div>

            <div class="remember-forget">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forget Password?</a>
            </div>

            <button type="submit" class="btn" disabled>Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>

        </form>
    </div>

    <script>
    $(document).ready(function () {
        function validateForm() {
            var username = $('#username').val();
            var password = $('#password').val();
            var isValid = username.length > 0 && password.length > 0;

            // Enable or disable the submit button based on the validation
            $('.btn').prop('disabled', !isValid);
        }

        // Validation on username
        $('#username').keyup(function () {
            var username = $('#username').val();

            if (username === "") {
                $('#usernameError').text("Username is required.").css('color', 'red');
            } else if (username.length < 8 || username.length > 25) {
                $('#usernameError').text("Username must be more than 8 characters and less than 25 characters.").css('color', 'red');
            } else {
                $('#usernameError').text(""); // Clear the error message if validation is successful
            }

            validateForm(); // Check form validity after each keyup
        });

        // Validation on password
        $('#password').keyup(function () {
            var password = $('#password').val();
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{9,}$/;

            if (password === "") {
                $('#passwordError').text("Password is required.").css('color', 'red');
            } else if (!passwordPattern.test(password)) {
                $('#passwordError').text("Password must be at least 8 characters, with uppercase, lowercase, number, and special character.").css('color', 'red');
            } else {
                $('#passwordError').text(""); // Clear the error message if password is valid
            }

            validateForm(); // Check form validity after each keyup
        });

        // Handle form submission using AJAX
        $("form").submit(function (e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: "process_login.php",
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if (response.trim() === "success") {
                        alert("Login Successful");
                        window.location.href = "dashboard.php";
                    } else {
                        alert(response);
                    }
                },
                error: function () {
                    alert("An error occurred. Please try again later.");
                }
            });
        });
    });
</script>

</body>
</html>