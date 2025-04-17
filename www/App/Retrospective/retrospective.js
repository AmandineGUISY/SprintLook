document.addEventListener('DOMContentLoaded', function() {

    const modal = document.getElementById('postItModal');

    const newBtn = document.getElementById('newPostItBtn');
    const cancelBtn = document.getElementById('cancelPostIt');
    const closeModalBtn = document.getElementById('closeModalBtn');
    
    newBtn.addEventListener('click', () => modal.classList.remove('hidden'));
    cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));
    closeModalBtn.addEventListener('click', () => modal.classList.add('hidden'));
    
    const form = document.getElementById('postItForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('Retrospective/save_postit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur: ' + (data.error || 'Une erreur est survenue'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue');
        });
    });
});