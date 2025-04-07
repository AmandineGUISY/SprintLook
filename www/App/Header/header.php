<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SprintLook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Vous pouvez remplacer cette icône par votre propre logo -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <header class="bg-blue-500 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2 bg-blue-200 rounded-xl px-4 py-1 shadow">
                <img src="/Resources/Images/SprintLook.png" alt="Sprintlook Logo" class="h-10 w-10 rounded">
                <span class="text-xl font-bold text-black">SprintLook</span>
            </div>
            
            <!-- Navigation -->
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="hover:text-blue-200 transition">Connexion</a>
                <a href="#" class="hover:text-blue-200 transition">Inscription</a>
                <div class="flex items-center space-x-2 bg-blue-200 rounded-xl px-4 shadow">
                    <a href="#" class="hover:text-white transition text-black">Rejoindre un salon</a>
                </div>
            </nav>
            
            <!-- Menu mobile (hamburger) -->
            <button class="md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        
        <!-- Menu mobile déroulant -->
        <div class="md:hidden bg-blue-700 hidden" id="mobileMenu">
            <div class="container mx-auto px-4 py-2 flex flex-col space-y-3">
                <a href="#" class="block py-2 hover:text-blue-200 transition">Connexion</a>
                <a href="#" class="block py-2 hover:text-blue-200 transition">Inscription</a>
                <a href="#" class="block py-2 hover:text-blue-200 transition">Rejoindre un salon</a>
            </div>
        </div>
    </header>

