<?php 
require_once "Header/header.php";
session_start();
?>

<div class="mt-2 bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-align">Mes salons</h1>
        
        <!-- Barre de recherche et filtres -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Champ de recherche -->
                <div class="flex-grow relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input 
                        type="text" 
                        id="searchInput" 
                        placeholder="Rechercher un salon par nom..." 
                        class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
                
                <!-- Filtres -->
                <div class="flex flex-col sm:flex-row gap-2">
                    <select id="sortBy" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="date-desc">Plus récent</option>
                        <option value="date-asc">Plus ancien</option>
                        <option value="name-asc">A-Z</option>
                        <option value="name-desc">Z-A</option>
                    </select>
                    
                    <button id="filterBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-filter mr-2"></i>Filtrer
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Liste des salons -->
        <div id="roomsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Les salons seront chargés ici dynamiquement -->
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                <p>Chargement des salons...</p>
            </div>
        </div>
    </div>
</div>

<script src="Room/room.js"></script>

<?php require_once "Footer/footer.php"?>