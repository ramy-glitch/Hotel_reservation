<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <style>
            .alert alert-danger {
                color: red;
            }
        </style>
        
    </head>
    <body>
        <header>
            <h1>Connexion / Inscription</h1>
            <nav>
                <a href="{{ route('welcome') }}" class="register-btn">Home</a>
            </nav>
        </header>


        <main class="main content">
            <div class="div">
                <form class="signUpForm" id="login-form" method="POST" action="{{ route('customers.store') }}">
                    @csrf
                    <label for="username">Pseudo :</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="email">E-mail :</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="birth_date">Birthdate :</label>
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                    @error('birth_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="password">Password :</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <ul class="password-conditions">
                        <li id="length" class="invalid">Au moins 8 caractères</li>
                        <li id="uppercase" class="invalid">Au moins une majuscule</li>
                        <li id="lowercase" class="invalid">Au moins une minuscule</li>
                        <li id="number" class="invalid">Au moins un chiffre</li>
                    </ul>


                    <button type="submit">create account</button>
                </form>
                <p>Already registered? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </main>

        <footer>
            <div class="footer-info">
                <div class="footer-logo">HotelBooking</div>
                <p>Your perfect stay is just a click away.</p>
            </div>
            <div class="footer-links">
                <h4>Quick Links</h4>
                <a href="{{ route('welcome') }}">Home</a>
                <a href="#">View Hotels</a>
                <a href="#">Contact Us</a>
            </div>
            <div class="footer-contact">
                <h4>Contact Us</h4>
                <p>Email: support@hotelbooking.com</p>
                <p>Address: 123 Main St, City, Country</p>
            </div>
        </footer>


        <script src="{{ asset('js/script2.js') }}"></script>








    </body>
</html>
