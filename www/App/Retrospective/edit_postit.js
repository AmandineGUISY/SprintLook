document.addEventListener('DOMContentLoaded', function() {
    const editModal = document.getElementById('editPostItModal');
    const editForm = document.getElementById('editPostItForm');
    let currentPostItId = null;

    // edit button
    document.querySelectorAll('.edit-postit').forEach(button => {
        button.addEventListener('click', function() {
            currentPostItId = this.getAttribute('data-id');
            const category = this.getAttribute('data-category');
            const content = this.getAttribute('data-content');
            
            editForm.querySelector('[name="category"]').value = category;
            editForm.querySelector('[name="content"]').value = content;
            
            editModal.classList.remove('hidden');
        });
    });

    // cancel button
    document.getElementById('cancelEditPostIt').addEventListener('click', () => {
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