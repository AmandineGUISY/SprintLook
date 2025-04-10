<?php 
require_once 'Header/header.php';
require_once 'Retrospective/retrospective.php';
?>

<div class="flex flex-col items-center space-y-8 py-8 bg-blue-50">
    <h1 class="font-bold text-3xl md:text-4xl text-center text-blue-800"><?= htmlspecialchars($_GET['room_name'] ?? 'Rétrospective') ?></h1>
    
    <button id="newPostItBtn" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-6 rounded-full shadow-lg transition transform hover:scale-105">
        <i class="fas fa-plus mr-2"></i>Nouveau Post-it
    </button>
</div>

<main class="container mx-auto px-4 py-8">
    <!-- New post-it modal -->
    <div id="postItModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-blue-700">Nouveau Post-it</h3>
                <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="postItForm" class="space-y-4">
                <input type="hidden" name="room_id" value="<?= $room_id ?>">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                    <select name="category" class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="positif">Positif</option>
                        <option value="negatif">Négatif</option>
                        <option value="a_ameliorer">À améliorer</option>
                    </select>
                </div>
                    
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea name="content" class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" rows="4" required></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" id="cancelPostIt" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit post it modal -->
    <div id="editPostItModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-blue-700">Modifier Post-it</h3>
                <button id="closeEditModalBtn" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editPostItForm" class="space-y-4">
                <input type="hidden" name="postit_id" id="editPostItId">
                <input type="hidden" name="room_id" value="<?= $room_id ?>">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                    <select name="category" id="editPostItCategory" class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="positif">Positif</option>
                        <option value="negatif">Négatif</option>
                        <option value="a_ameliorer">À améliorer</option>
                    </select>
                </div>
                    
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea name="content" id="editPostItContent" class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" rows="4" required></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" id="cancelEditPostIt" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Retrospective board -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
        <!-- Positive Column -->
        <div class="column bg-green-50 p-3 md:p-4 rounded-lg border border-green-200 shadow-sm">
            <h2 class="text-lg md:text-xl font-bold text-center mb-3 md:mb-4 text-green-700">
                <i class="fas fa-smile mr-2"></i>Positif
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4" id="positif-column">
                <?php foreach ($positive as $msg): ?>
                    <div class="post-it p-3 md:p-4 rounded-lg bg-white shadow-md relative hover:shadow-lg transition-shadow duration-200 border-l-4 border-green-500">
                        <?php if ($msg['user_id'] == $_SESSION['user_id'] || $isRoomOwner): ?>
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
                        <?php endif; ?>
                        <div class="flex items-start mb-2">
                            <img src="<?= htmlspecialchars($msg['author_image'] ?? '/Resources/Images/SprintLook.png') ?>" 
                                alt="Profile" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 object-cover">
                            <span class="font-semibold text-sm md:text-base"><?= htmlspecialchars($msg['author']) ?></span>
                        </div>
                        <p class="whitespace-pre-wrap text-xs md:text-sm mt-1"><?= htmlspecialchars($msg['content']) ?></p>
                        <div class="text-xs text-gray-500 mt-2">
                            <?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- To Improve Column -->
        <div class="column bg-orange-50 p-3 md:p-4 rounded-lg border border-orange-200 shadow-sm">
            <h2 class="text-lg md:text-xl font-bold text-center mb-3 md:mb-4 text-orange-700">
                <i class="fas fa-lightbulb mr-2"></i>À améliorer
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4" id="a_ameliorer-column">
                <?php foreach ($improve as $msg): ?>
                    <div class="post-it p-3 md:p-4 rounded-lg bg-white shadow-md relative hover:shadow-lg transition-shadow duration-200 border-l-4 border-orange-500">
                        <?php if ($msg['user_id'] == $_SESSION['user_id'] || $isRoomOwner): ?>
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
                        <?php endif; ?>
                        <div class="flex items-start mb-2">
                            <img src="<?= htmlspecialchars($msg['author_image'] ?? '/Resources/Images/SprintLook.png') ?>" 
                                alt="Profile" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 object-cover">
                            <span class="font-semibold text-sm md:text-base"><?= htmlspecialchars($msg['author']) ?></span>
                        </div>
                        <p class="whitespace-pre-wrap text-xs md:text-sm mt-1"><?= htmlspecialchars($msg['content']) ?></p>
                        <div class="text-xs text-gray-500 mt-2">
                            <?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Negative Column -->
        <div class="column bg-red-50 p-3 md:p-4 rounded-lg border border-red-200 shadow-sm">
            <h2 class="text-lg md:text-xl font-bold text-center mb-3 md:mb-4 text-red-700">
                <i class="fas fa-frown mr-2"></i>Négatif
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4" id="negatif-column">
                <?php foreach ($negative as $msg): ?>
                    <div class="post-it p-3 md:p-4 rounded-lg bg-white shadow-md relative hover:shadow-lg transition-shadow duration-200 border-l-4 border-red-500">
                        <?php if ($msg['user_id'] == $_SESSION['user_id'] || $isRoomOwner): ?>
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
                        <?php endif; ?>
                        <div class="flex items-start mb-2">
                            <img src="<?= htmlspecialchars($msg['author_image'] ?? '/Resources/Images/SprintLook.png') ?>" 
                                alt="Profile" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 object-cover">
                            <span class="font-semibold text-sm md:text-base"><?= htmlspecialchars($msg['author']) ?></span>
                        </div>
                        <p class="whitespace-pre-wrap text-xs md:text-sm mt-1"><?= htmlspecialchars($msg['content']) ?></p>
                        <div class="text-xs text-gray-500 mt-2">
                            <?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<script src="Retrospective/delete_postit.js"></script>
<script src="Retrospective/retrospective.js"></script>
<script src="Retrospective/edit_postit.js"></script>

<?php include 'Footer/footer.php'; ?>