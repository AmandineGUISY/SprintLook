document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('retro-board').addEventListener('click', async function(event) {
        // verify if the element clicked have the delet-postit class in the retro-board div
        const deleteButton = event.target.closest('.delete-postit');
        
        if (deleteButton) {
            event.preventDefault();
            const postitId = deleteButton.getAttribute('data-id');
            
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
                        deleteButton.closest('.post-it').remove();
                    } else {
                        alert('Erreur: ' + (result.error || 'Échec de la suppression'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Une erreur est survenue');
                }
            }
        }
    });
});