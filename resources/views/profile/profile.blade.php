<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Manrope', Arial, sans-serif;
            background: #1c1c1c;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 2.5rem;
            background-color: #1c1c1c;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            border: 1px solid #ffd700;
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.2rem;
            color: #ffd700;
            font-weight: 700;
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            background-color: #1c1c1c;
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid #ffd700;
        }

        .profile-info {
            font-size: 1.1rem;
            line-height: 2;
            text-align: center;
            color: #ffffff;
        }

        .profile-info p {
            margin-bottom: 0.5rem;
            padding: 0.75rem 1.5rem;
            background-color: #2c2c2c;
            border-radius: 8px;
            transition: transform 0.2s ease;
            color: #ffffff;
        }

        .profile-info p:hover {
            transform: translateX(5px);
            background-color: #ffd700;
            color: #1c1c1c;
        }

        .profile-info span {
            font-weight: 600;
            color: #ffd700;
            margin-left: 0.5rem;
        }

        .button-container {
            margin-top: 2rem;
            text-align: center;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #ffd700 0%, #d4af37 100%);
            color: #1c1c1c;
            padding: 12px 28px;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            background: linear-gradient(135deg, #d4af37 0%, #b8860b 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(0);
        }
    </style>
    <title>Profile</title>
</head>

<body>
    @include('home.header')
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <h1>Profile</h1>
        <div class="profile-section">
            <div class="profile-info">
                <p>Name: <span>{{ Auth::user()->name }}</span></p>
                <p>Email: <span>{{ Auth::user()->email }}</span></p>
                <p>Role: <span>{{ Auth::user()->role ?? 'User' }}</span></p>
            </div>
            <div class="button-container">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>

    @include('component.footer')
</body>

</html>