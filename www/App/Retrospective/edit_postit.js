document.addEventListener('DOMContentLoaded', function() {
    const editModal = document.getElementById('editPostItModal');
    const editForm = document.getElementById('editPostItForm');
    let currentPostItId = null;

    document.getElementById('retro-board').addEventListener('click', function(event) { // on retro board
        const editButton = event.target.closest('.edit-postit'); // if the click is on a edit postit button
        
        if (editButton) {
            event.preventDefault();
            currentPostItId = editButton.getAttribute('data-id');
            const category = editButton.getAttribute('data-category');
            const content = editButton.getAttribute('data-content');
            
            // form of edition is now completed
            document.getElementById('editPostItCategory').value = category;
            document.getElementById('editPostItContent').value = content;
            document.getElementById('editPostItId').value = currentPostItId;
            
            // display the modale
            editModal.classList.remove('hidden');
        }
    });

    // cancel button
    document.getElementById('cancelEditPostIt').addEventListener('click', () => {
        editModal.classList.add('hidden');
    });

    // cross button
    document.getElementById('closeEditModalBtn').addEventListener('click', () => {
        editModal.classList.add('hidden');
    });

    editForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        formData.append('id', currentPostItId);
        
        try {
            const response = await fetch('Retrospective/edit_postit.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                location.reload();
            } else {
                alert('Erreur: ' + (result.error || 'Échec de la modification'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Une erreur est survenue');
        }
    });
});