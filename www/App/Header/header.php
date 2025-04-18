<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SprintLook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="../Resources/Images/SprintLook.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="/Resources/Images/SprintLook.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="Header/style.css">
</head>

<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $disconnected = empty($_SESSION['user_id']);
    ?>

    <header class="bg-blue-500 text-white shadow-md">
        <nav class="bg-blue-500 text-white shadow-lg">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <div class="flex items-center space-x-2 bg-blue-200 rounded-xl px-4 py-1 shadow">
                    <img src="../Resources/Images/SprintLook.png" alt="Sprintlook Logo" class="h-10 w-10 rounded">
                    <span class="text-xl text-black font-bold">SprintLook</span>
                </div>
                
                <!-- Menu Desktop -->
                <div class="hidden md:flex space-x-6 items-center">
                    <a href="index.php" class="hover:underline font-medium">Accueil</a>
                    <a href="join.php" class="hover:underline">Rejoindre un salon</a>
                    <?php if ($disconnected) : ?>
                        <a href="login.php" class="bg-white text-blue-600 px-4 py-2 rounded-md font-medium hover:bg-gray-100 transition ml-4">Se connecter</a>
                    <?php elseif (!$disconnected) : ?>
                        <a href="profile.php" class="hover:underline">Profil</a>
                        <a href="room.php" class="hover:underline">Mes rétrospectives</a>

                        <a href="Header/logout.php" class="flex items-center gap-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm shadow-md hover:bg-gray-300 transition-colors duration-200">
                            <i class="fa-solid fa-right-from-bracket text-sm"></i>
                            <span class="font-medium">Déconnexion</span>
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Menu Mobile -->
                <div class="md:hidden flex items-center">
                    <button id="menu-btn" class="hamburger focus:outline-none">
                        <span class="hamburger-top"></span>
                        <span class="hamburger-middle"></span>
                        <span class="hamburger-bottom"></span>
                    </button>
                </div>
            </div>
            
            <!-- Menu Mobile Dropdown -->
            <div class="md:hidden">
                <div id="menu" class="hidden absolute flex-col items-center py-8 space-y-6 bg-blue-500 w-full left-0 right-0 z-50">
                    <a href="index.php" class="hover:underline">Accueil</a>
                    <a href="join.php" class="hover:underline">Rejoindre un salon</a>
                    <?php if ($disconnected) : ?>
                        <a href="login.php" class="bg-white text-blue-600 px-4 py-2 rounded-md font-medium hover:bg-gray-100 transition">Se connecter</a>
                    <?php elseif (!$disconnected) : ?>
                        <a href="room.php" class="hover:underline">Mes rétrospectives</a>
                        <a href="profile.php" class="hover:underline">Profil</a>
                        
                        <a href="Header/logout.php" class="flex items-center gap-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm shadow-md hover:bg-gray-300 transition-colors duration-200">
                            <i class="fa-solid fa-right-from-bracket text-sm"></i>
                            <span class="font-medium">Déconnexion</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

   



