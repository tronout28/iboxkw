<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="/css/register/register.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Spinner style inside the button */
        .spinner {
            display: none;
            border: 3px solid #f3f3f3; /* Light grey */
            border-top: 3px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 2s linear infinite;
            margin-left: 10px;
        }

        /* Spinner animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .btn-register {
            position: relative;
        }

        .btn-register span {
            visibility: visible;
        }

        .btn-register.loading span {
            visibility: hidden;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="left-side">
                <div class="left-content">
                    <h2>Welcome Aboard!<br>Create Your Account</h2>
                    <p>Join us and start enjoying<br>amazing features today.</p>
                </div>
            </div>
            <div class="right-side">
                <div class="register-box">
                    
                    <h1>Welcome!</h1>
                    <p class="subtitle">Create an account to start your journey with us</p>
                    <form id="registerForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="youremail@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="minimal 8 huruf" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="minimal 8 huruf" required>
                        </div>
                        <button type="submit" class="btn-register">Register
                            <span>Register</span>
                            <div class="spinner"></div>
                        </button>
                        <p class="login-link">
                            Already have an account? <a href="/">Login</a>
                        </p>
                    </form>
                    <div id="responseMessage"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#registerForm').on('submit', function (e) {
                e.preventDefault();

                // Show the loading spinner inside the button and hide text
                $('.btn-register').addClass('loading');

                $.ajax({
                    url: '/register',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#responseMessage').html('<p style="color: green;">' + response.message + '</p>');
                        // Hide the loading spinner after success
                        $('.btn-register').removeClass('loading');
                        // Redirect or perform other actions after successful registration
                        window.location.href = '/';
                    },
                    error: function (xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            let messages = Object.values(errors).map(error => `<p style="color: red;">${error[0]}</p>`).join('');
                            $('#responseMessage').html(messages);
                        } else {
                            console.error(xhr.responseText);
                            $('#responseMessage').html('<p style="color: red;">Terjadi kesalahan. Silakan cek log konsol.</p>');
                        }
                        // Hide the loading spinner in case of error
                        $('.btn-register').removeClass('loading');
                    }
                });
            });
        });
    </script>
</body>
</html>
