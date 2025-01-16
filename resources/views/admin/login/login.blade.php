<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="/css/login/login.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .error-message-container {
            display: none;
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            position: relative;
        }
        .error-message-container button {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #721c24;
            font-weight: bold;
            cursor: pointer;
        }
        .error-message-container button:hover {
            color: #f44336;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="left-side">
                <div class="left-content">
                    <h2>Login Sebagai admin</h2>
                </div>
            </div>
            <div class="right-side">
                <div class="login-box">
                   
                    <h1>Hello Again!</h1>
                    <p class="subtitle">Ini admin</p>

                    <!-- Error Message Container -->
                    <div id="responseMessage" class="error-message-container">
                        <button id="closeErrorMessage">×</button>
                        <span id="errorText"></span>
                    </div>

                    <form id="loginForm">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="email" placeholder="johnnnybravo@afterglow.com" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="password" placeholder="••••••••••" required>
                        </div>
                        <div class="remember-forgot">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                            <a href="#" style="color: #4d7cff; text-decoration: none;">Recovery Password</a>
                        </div>
                        <button type="submit" class="btn-login">Login</button>
                        <p class="signup-link">
                            Login sebagai user? <a href="/">Login user</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set up the CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#loginForm').on('submit', function (e) {
                e.preventDefault();

                // Prepare the data
                let email = $('#email').val();
                let password = $('#password').val();

                $.ajax({
                    url: '/login',  // Make sure this URL matches the route for login
                    type: 'POST',
                    data: {
                        email: email,
                        password: password,
                    },
                    success: function (response) {
                        // Display success message
                        $('#responseMessage').html('Login successful! Redirecting...').css('color', 'green').show();
                        $('#errorText').text(''); // Clear previous error message
                        $('#responseMessage').css('background-color', '#d4edda'); // Green background for success

                        // If login is successful, store the token in localStorage or cookies
                        localStorage.setItem('auth_token', response.token);

                        // Redirect to home page after 1 second
                        setTimeout(function () {
                            window.location.href = '/admin/dealer-admin';
                        }, 1000);
                    },
                    error: function (xhr) {
                        // Display error message
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            $('#responseMessage').html(xhr.responseJSON.message).css('color', 'red').show();
                            $('#errorText').text(xhr.responseJSON.message); // Display the error message
                        } else {
                            $('#responseMessage').html('Incorrect password or email. Please try again.').css('color', 'red').show();
                            $('#errorText').text('Incorrect password or email. Please try again.');
                        }
                        $('#responseMessage').css('background-color', '#f8d7da'); // Red background for error
                    }
                });
            });

            // Close error message when the "×" button is clicked
            $('#closeErrorMessage').on('click', function () {
                $('#responseMessage').hide();
            });
        });
    </script>
</body>
</html>
 