document.querySelector('form').addEventListener('submit', async function (event) {
    event.preventDefault();

    document.getElementById('error-message').classList.add('hidden');
    document.getElementById('success-message').classList.add('hidden');

    const formData = new FormData(this);

    try {
        const response = await fetch('Register/register_ajax.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.status === 200) {
            const successMessage = document.getElementById('success-message');
            successMessage.textContent = result.message;
            successMessage.classList.remove('hidden');

            document.getElementById('registerForm').reset();

            // if their is a reddirection, that mean we are connected ans we redirect on the login page
            if (result.redirect) {
                setTimeout(() => {
                    window.location.href = result.redirect;
                }, 200);
            }
        } else {
            const errorMessage = document.getElementById('error-message');

            if (Array.isArray(result.message)) {
                errorMessage.innerHTML = result.message.join('<br>'); // Afficher plusieurs erreurs
            } else {
                errorMessage.textContent = result.message; // Afficher une seule erreur
            }
            errorMessage.classList.remove('hidden');
        }
    } catch (error) {
        console.error('Erreur :', error);
        const errorMessage = document.getElementById('error-message');
        errorMessage.textContent = 'Une erreur est survenue.';
        errorMessage.classList.remove('hidden');
    }
});