
function checkPasswordStrength() {
    const password = document.getElementById('password').value;
    const strengthBar = document.getElementById('password-strength-bar');
    const strengthText = document.getElementById('password-strength-text');

    strengthBar.style.width = '0%';
    strengthText.textContent = '';

    let strength = 0;

    // lenth is greater or equal to 8
    if (password.length >= 8) strength += 1;

    // contains numbers
    if (/\d/.test(password)) strength += 1;

    // contains maj
    if (/[A-Z]/.test(password)) strength += 1;

    // contains spécial char
    if (/[\W_]/.test(password)) strength += 1;

    // update the bar
    switch (strength) {
        case 0:
        case 1:
            strengthBar.style.width = '25%';
            strengthBar.className = 'h-2.5 rounded-full bg-red-500';
            strengthText.textContent = 'Faible';
            strengthText.style.color = '#ff4d4d';
            break;
        case 2:
            strengthBar.style.width = '50%';
            strengthBar.className = 'h-2.5 rounded-full bg-orange-500';
            strengthText.textContent = 'Moyen';
            strengthText.style.color = '#ffcc00';
            break;
        case 3:
            strengthBar.style.width = '75%';
            strengthBar.className = 'h-2.5 rounded-full bg-green-500';
            strengthText.textContent = 'Fort';
            strengthText.style.color = '#4caf50';
            break;
        case 4:
            strengthBar.style.width = '100%';
            strengthBar.className = 'h-2.5 rounded-full bg-green-700';
            strengthText.textContent = 'Très fort';
            strengthText.style.color = '#388e3c';
            break;
    }
}

document.getElementById('password').addEventListener('input', checkPasswordStrength);