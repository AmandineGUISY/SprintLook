document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-postit').forEach(button => {
        button.addEventListener('click', async function() {
            const postitId = this.getAttribute('data-id');
            
            if (confirm('Voulez-vous vraiment supprimer ce post-it ?')) {
                try {
                    const response = await fetch('Retrospective/delete_postit.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id=${encodeURIComponent(postitId)}`
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        this.closest('.post-it').remove();
                    } else {
                        alert('Erreur: ' + (result.error || 'Échec de la suppression'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Une erreur est survenue');
                }
            }
        });
    });
});