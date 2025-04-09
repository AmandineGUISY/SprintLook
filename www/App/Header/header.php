<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SprintLook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="/Resources/Images/SprintLook.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="/Resources/Images/SprintLook.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="Header/style.css">
</head>

<body>
    <header class="bg-blue-500 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2 bg-blue-200 rounded-xl px-4 py-1 shadow">
                <img src="/Resources/Images/SprintLook.png" alt="Sprintlook Logo" class="h-10 w-10 rounded">
                <h1><span class="text-xl font-bold text-black">SprintLook</span></h1>
            </div>
            
            <nav class="hidden md:flex space-x-6">
                <h2><a href="login.php" class="hover:text-blue-200 transition">Connexion</a></h2>
                <h2><a href="register.php" class="hover:text-blue-200 transition">Inscription</a></h2>
                <div class="flex items-center space-x-2 bg-blue-200 rounded-xl px-4 shadow">
                    <h2><a href="#" class="hover:text-white transition text-black">Rejoindre un salon</a></h2>
                </div>
            </nav>
            
            <button class="md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        
        <div class="md:hidden bg-blue-700 hidden flex flex-col items-center p-4" id="mobileMenu">
            <h2><a href="login.php" class="hover:text-blue-200 transition">Connexion</a></h2>
            <h2><a href="register.php" class="hover:text-blue-200 transition">Inscription</a></h2>
            <div class="flex items-center space-x-2 bg-blue-200 rounded-xl px-4 shadow">
                <h2><a href="#" class="hover:text-white transition text-black">Rejoindre un salon</a></h2>
            </div>
        </div>
    </header>

