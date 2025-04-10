document.addEventListener('DOMContentLoaded', function() {

    const modal = document.getElementById('postItModal');

    const newBtn = document.getElementById('newPostItBtn');
    const cancelBtn = document.getElementById('cancelPostIt');
    
    newBtn.addEventListener('click', () => modal.classList.remove('hidden'));
    cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));
    
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

                const postIt = createPostItElement(data.message);
                const columnId = `${data.message.category}-column`;
                const column = document.getElementById(columnId);
                column.prepend(postIt);
            
                modal.classList.add('hidden');
                form.reset();

            } else {
                alert('Erreur: ' + (data.error || 'Une erreur est survenue'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue');
        });
    });
    
    function createPostItElement(message) {
        const postIt = document.createElement('div');
        postIt.className = `post-it ${getCategoryClass(message.category)} p-4 rounded-lg`;

        const authorImage = message.author_image || '/Resources/Images/SprintLook.png';
        const authorName = message.author || 'Anonyme';
        const date = new Date(message.created_at).toLocaleString('fr-FR');

        postIt.innerHTML = `
            <button class="delete-postit absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"
                data-id="<?= $msg['id'] ?>"
                title="Supprimer">
                <i class="fas fa-trash text-sm"></i>
            </button>       
            <div class="flex items-start mb-2">
                <img src="${authorImage}" alt="Profile" class="w-8 h-8 rounded-full mr-2">
                <span class="font-semibold">${authorName}</span>
            </div>
            <p class="whitespace-pre-wrap text-sm">${message.content}</p>
            <div class="text-xs text-gray-500 mt-2">${date}</div>
        `;

        return postIt;
    }

    function getCategoryClass(category) {
        switch(category) {
            case 'positif': return 'positive';
            case 'negatif': return 'negative';
            case 'a_ameliorer': return 'improve';
            default: return '';
        }
    }
});