<?php 
require_once 'Header/header.php';
require_once 'Retrospective/retrospective.php';
?>

<div class="flex flex-col items-center space-y-8">
    <h1 class="pt-8 font-bold text-5xl text-center">Rétrospective</h1>
    
    <button id="newPostItBtn" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded-full shadow-lg transition">
        <i class="fas fa-plus mr-2"></i>Nouveau Post-it
    </button>
</div>

<main class="container mx-auto px-4 py-8">
    <!-- Modal pour nouveau post-it -->
    <div id="postItModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-bold mb-4">Nouveau Post-it</h3>
            <form id="postItForm">
                <input type="hidden" name="room_id" value="<?= $room_id ?>">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Catégorie</label>
                    <select name="category" class="w-full p-2 border rounded" required>
                        <option value="positif">Positif</option>
                        <option value="negatif">Négatif</option>
                        <option value="a_ameliorer">À améliorer</option>
                    </select>
                </div>
                    
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Message</label>
                    <textarea name="content" class="w-full p-2 border rounded" rows="4" required></textarea>
                </div>
                
                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelPostIt" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">
                        Annuler
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau de rétrospective -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <!-- Colonne Positive -->
        <div class="column bg-green-50 p-4 rounded-lg border border-green-200">
            <h2 class="text-xl font-bold text-center mb-4 text-green-700">
                <i class="fas fa-smile mr-2"></i>Positif
            </h2>
            <div class="grid grid-cols-2 gap-4" id="positif-column">
                <?php foreach ($positive as $msg): ?>
                    <div class="post-it positive p-4 rounded-lg bg-white shadow-md relative hover:shadow-lg transition-shadow">
                        <?php if ($msg['user_id'] == $_SESSION['user_id'] || $isRoomOwner): ?>
                            <button class="delete-postit absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"
                                    data-id="<?= $msg['id'] ?>"
                                    title="Supprimer">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        <?php endif; ?>
                        <div class="flex items-start mb-2">
                            <img src="<?= htmlspecialchars($msg['author_image'] ?? '/Resources/Images/SprintLook.png') ?>" 
                                alt="Profile" class="w-8 h-8 rounded-full mr-2">
                            <span class="font-semibold"><?= htmlspecialchars($msg['author']) ?></span>
                        </div>
                        <p class="whitespace-pre-wrap text-sm"><?= htmlspecialchars($msg['content']) ?></p>
                        <div class="text-xs text-gray-500 mt-2">
                            <?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Colonne À améliorer -->
        <div class="column bg-orange-50 p-4 rounded-lg border border-orange-200">
            <h2 class="text-xl font-bold text-center mb-4 text-orange-700">
                <i class="fas fa-lightbulb mr-2"></i>À améliorer
            </h2>
            <div class="grid grid-cols-2 gap-4" id="a_ameliorer-column">
                <?php foreach ($improve as $msg): ?>
                    <div class="post-it improve p-4 rounded-lg bg-white shadow-md relative hover:shadow-lg transition-shadow">
                        <?php if ($msg['user_id'] == $_SESSION['user_id'] || $isRoomOwner): ?>
                            <button class="delete-postit absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"
                                    data-id="<?= $msg['id'] ?>"
                                    title="Supprimer">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        <?php endif; ?>
                        <div class="flex items-start mb-2">
                            <img src="<?= htmlspecialchars($msg['author_image'] ?? '/Resources/Images/SprintLook.png') ?>" 
                                alt="Profile" class="w-8 h-8 rounded-full mr-2">
                            <span class="font-semibold"><?= htmlspecialchars($msg['author']) ?></span>
                        </div>
                        <p class="whitespace-pre-wrap text-sm"><?= htmlspecialchars($msg['content']) ?></p>
                        <div class="text-xs text-gray-500 mt-2">
                            <?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Colonne Négative -->
        <div class="column bg-red-50 p-4 rounded-lg border border-red-200">
            <h2 class="text-xl font-bold text-center mb-4 text-red-700">
                <i class="fas fa-frown mr-2"></i>Négatif
            </h2>
            <div class="grid grid-cols-2 gap-4" id="negatif-column">
                <?php foreach ($negative as $msg): ?>
                    <div class="post-it negative p-4 rounded-lg bg-white shadow-md relative hover:shadow-lg transition-shadow">
                        <?php if ($msg['user_id'] == $_SESSION['user_id'] || $isRoomOwner): ?>
                            <button class="delete-postit absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"
                                    data-id="<?= $msg['id'] ?>"
                                    title="Supprimer">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        <?php endif; ?>
                        <div class="flex items-start mb-2">
                            <img src="<?= htmlspecialchars($msg['author_image'] ?? '/Resources/Images/SprintLook.png') ?>" 
                                alt="Profile" class="w-8 h-8 rounded-full mr-2">
                            <span class="font-semibold"><?= htmlspecialchars($msg['author']) ?></span>
                        </div>
                        <p class="whitespace-pre-wrap text-sm"><?= htmlspecialchars($msg['content']) ?></p>
                        <div class="text-xs text-gray-500 mt-2">
                            <?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<script>
// Gestion des boutons de suppression
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
                    body: `id=${postitId}`
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
</script>

<?php include 'Footer/footer.php'; ?>