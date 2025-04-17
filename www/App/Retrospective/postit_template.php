<div class="post-it p-3 md:p-4 rounded-lg bg-white shadow-md relative hover:shadow-lg transition-shadow duration-200 border-l-4 
    <?= $msg['category'] === 'positif' ? 'border-green-500' : ($msg['category'] === 'a_ameliorer' ? 'border-orange-500' : 'border-red-500') ?>">
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="absolute top-2 right-2 flex space-x-2">
            <?php if ($msg['user_id'] == $_SESSION['user_id']): ?>
                <button class="edit-postit text-blue-500 hover:text-blue-700 transition-colors"
                        data-id="<?= $msg['id'] ?>"
                        data-category="<?= $msg['category'] ?>"
                        data-content="<?= htmlspecialchars($msg['content']) ?>"
                        title="Modifier">
                    <i class="fas fa-edit text-sm"></i>
                </button>
            <?php endif; ?>
            <button class="delete-postit text-red-500 hover:text-red-700 transition-colors"
                    data-id="<?= $msg['id'] ?>"
                    title="Supprimer">
                <i class="fas fa-trash text-sm"></i>
            </button>
        </div>
    <?php elseif (isset($_SESSION['nameless_id']) && $msg['nameless_id'] == $_SESSION['nameless_id']): ?>
        <div class="absolute top-2 right-2 flex space-x-2">
            <button class="edit-postit text-blue-500 hover:text-blue-700 transition-colors"
                    data-id="<?= $msg['id'] ?>"
                    data-category="<?= $msg['category'] ?>"
                    data-content="<?= htmlspecialchars($msg['content']) ?>"
                    title="Modifier">
                <i class="fas fa-edit text-sm"></i>
            </button>
            <button class="delete-postit text-red-500 hover:text-red-700 transition-colors"
                    data-id="<?= $msg['id'] ?>"
                    title="Supprimer">
                <i class="fas fa-trash text-sm"></i>
            </button>
        </div>
    <?php endif; ?>
    <div class="flex items-start mb-2">
        <img src="<?= htmlspecialchars($msg['author_image'] ?? '../Resources/Images/SprintLook.png') ?>" 
            alt="Profile" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 object-cover">
        <span class="font-semibold text-sm md:text-base"><?= htmlspecialchars($msg['author']) ?></span>
    </div>
    <p class="whitespace-pre-wrap text-xs md:text-sm mt-1"><?= htmlspecialchars($msg['content']) ?></p>
    <div class="text-xs text-gray-500 mt-2">
        <?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?>
    </div>
</div>