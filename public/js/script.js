

window.onload = function() {

document.getElementById('email').addEventListener('input', validateEmail);
document.getElementById('password').addEventListener('input', validatePassword);
document.getElementById('repassword').addEventListener('input', validatePassword);

function validateEmail() {
    var email = document.getElementById('email').value;
    var emailMessage = document.getElementById('emailMessage');

    // Expression régulière pour valider l'email
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,6}$/;
    var emailValid = emailPattern.test(email);

    if (emailValid) {
        emailMessage.textContent = 'Email valide';
        emailMessage.className = 'valid';
    } else {
        emailMessage.textContent = 'Email invalide';
        emailMessage.className = 'invalid';
    }
}

function validatePassword() {
    var password = document.getElementById('password').value;
    var repassword = document.getElementById('repassword').value;

    // Conditions de validation du mot de passe
    var minLength = password.length >= 8;
    var hasUpperCase = /[A-Z]/.test(password);
    var hasLowerCase = /[a-z]/.test(password);
    var hasNumber = /[0-9]/.test(password);
    var passwordsMatch = password === repassword;

    // Mettre à jour les conditions de mot de passe
    updateCondition('length', minLength);
    updateCondition('uppercase', hasUpperCase);
    updateCondition('lowercase', hasLowerCase);
    updateCondition('number', hasNumber);
    updateCondition('match', passwordsMatch);

    // Afficher le message de validation
    var message = document.getElementById('passwordMessage');
    if (minLength && hasUpperCase && hasLowerCase && hasNumber && passwordsMatch) {
        message.textContent = 'Mot de passe valide';
        message.className = 'valid';
    } else {
        message.textContent = 'Mot de passe invalide';
        message.className = 'invalid';
    }
}

function updateCondition(id, condition) {
    var element = document.getElementById(id);
    if (condition) {
        element.classList.remove('invalid');
        element.classList.add('valid');
    } else {
        element.classList.remove('valid');
        element.classList.add('invalid');
    }
}

}