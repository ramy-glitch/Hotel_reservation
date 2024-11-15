<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                <form class="signInForm" id="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <label for="email">E-mail :</label>
                    <input type="email" id="email" name="email" required>
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit">Se connecter</button>
                </form>
                <p>Pas encore inscrit ? <a href="{{ route('register') }}">Inscrivez-vous ici</a></p>
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
    </body>
</html>
