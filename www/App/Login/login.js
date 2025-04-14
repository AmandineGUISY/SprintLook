document.querySelector('form').addEventListener('submit', async function (event) {

    event.preventDefault();
    
    document.getElementById('error-message').classList.add('hidden');
    document.getElementById('success-message').classList.add('hidden');
    
    const formData = new FormData(this);

    try {
        const response = await fetch('Login/login_ajax.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.status === 200) {
            const successMessage = document.getElementById('success-message');
            successMessage.textContent = result.message;
            successMessage.classList.remove('hidden');

            document.getElementById('loginForm').reset();

            setTimeout(() => {
                window.location.href = '/App/index.php';
            }, 200);
        } else {
            const errorMessage = document.getElementById('error-message');

            if (Array.isArray(result.message)) {
                errorMessage.innerHTML = result.message.join('<br>'); // display many error
            } else {
                errorMessage.textContent = result.message; // display one error
            }
            errorMessage.classList.remove('hidden');
        }
    } catch (error) {
        console.error('Erreur :', error);
        const errorMessage = document.getElementById('error-message');
        errorMessage.textContent = 'Une erreur est survenue.';
        errorMessage.classList.remove('hidden');
    }
})