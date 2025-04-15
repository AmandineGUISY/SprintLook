<?php
require_once "Header/header.php";
require_once "Profile/profile_data.php";
?>

<div class="bg-gray-100 min-h-screen flex items-center justify-center p-2">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-center">
            <h1 class="text-2xl font-bold text-white">Mon Profil</h1>
        </div>

        <!-- display the error or sucess message-->
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?= htmlspecialchars($error) ?></span>
            </div>
        <?php elseif (isset($success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?= htmlspecialchars($success) ?></span>
            </div>
        <?php endif; ?>

        <!-- profile field -->
        <div class="p-6">
            <form action="profile.php" method="post" enctype="multipart/form-data" class="space-y-6">
                <!-- profile picture -->
                <div class="flex flex-col items-center">
                    <label for="profile-upload" class="cursor-pointer group">
                        <div class="relative">
                            <img src="<?= htmlspecialchars($user['image_profile'] ?? '../Resources/Images/SprintLook.png') ?>" 
                                alt="Photo de profil" 
                                class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md group-hover:border-blue-300 transition-all duration-300">
                            <div class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-2 group-hover:bg-blue-600 transition-all duration-300">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                        <input type="file" 
                            id="profile-upload" 
                            name="profile_image" 
                            class="hidden"
                            accept="image/jpeg, image/png, image/gif">
                    </label>
                    <span class="mt-2 text-sm text-gray-500">Cliquez pour changer</span>
                </div>
                
                <!-- Informations utilisateur -->
                <div class="space-y-4">
                    <div class="mt-1 p-2 bg-gray-50 rounded-md text-gray-900">
                        Pseudo : <?= htmlspecialchars($user['pseudo'] ?? '') ?>
                    </div>
                
                    <div class="mt-1 p-2 bg-gray-50 rounded-md text-gray-900">
                        Email : <?= htmlspecialchars($user['email'] ?? '') ?>
                    </div>
                </div>
                
                <!-- Boutons -->
                <div class="flex flex-col space-y-3">
                    <button type="button" 
                            onclick="document.getElementById('profile-upload').click()"
                            class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300">
                        <i class="fas fa-image mr-2"></i> Changer la photo
                    </button>
                    
                    <button type="submit" 
                            id="submit-btn" 
                            class="hidden w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-300">
                        <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                    </button>
                    
                    <a href="Header/logout.php" 
                        class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-300">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-gray-50 px-6 py-4 text-center">
            <p class="text-sm text-gray-500">
                Membre depuis <?= isset($user['created_at']) ? date('d/m/Y', strtotime($user['created_at'])) : '' ?>
            </p>
        </div>
    </div>
</div>

<script src="Profile/update_picture.js"></script>

<?php require_once "Footer/footer.php"; ?>