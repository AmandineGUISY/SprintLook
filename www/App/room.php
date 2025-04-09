<?php 
require_once "Header/header.php";
session_start();
?>
<!-- Addition of Room button -->
<div class="fixed bottom-8 right-8">
    <button onclick="roomModal.open()" class="p-4 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 transition-all">
        <i class="fas fa-plus text-2xl"></i>
    </button>
</div>

<!-- Addition of an edditor of Room -->
<div id="addRoomModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <h3 class="text-xl font-bold mb-4">Créer un nouveau salon</h3>
            <input  type="text" 
                    id="newRoomName"
                    placeholder="Nom du salon" 
                    class="w-full p-3 border rounded-lg mb-4 focus:ring-1"
                    maxlength="20"
                   >

            <div class="text-right text-sm text-gray-500 pb-3">
                <span id="charCount">0</span>/20 caractères
            </div>

            <div class="flex justify-end gap-3">
                <button class="px-4 py-2 border rounded-lg cancel-btn">Annuler</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 create-btn">
                    Créer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- update the room-->
<div id="openUpdateRoom" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
        <h3 class="text-xl font-bold mb-4">Modifier un salon</h3>
        <input  type="text"
                id="updateRoomName"
                placeholder="Nouveau nom"
                class="w-full p-3 border rounded-lg mb-4 focus:ring-1"
                maxlength="20"
                >

        <div class="text-right text-sm text-gray-500 pb-3">
            <span id="charCountUpdate">0</span>/20 caractères
        </div>

        <div class="flex justify-end gap-3">
            <button class="px-4 py-2 border rounded-lg cancel-btn">Annuler</button>
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 create-btn">
                Modifier
            </button>
        </div>
    </div>
</div>

<!-- researsh room div -->
<div class="mt-2 bg-gray-100 min-h-screen">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-align">Mes salons</h1>

        
        <!-- researsh bar and filter -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Search field-->
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
                
                <!-- Filters -->
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
        
        <!-- rooms list -->
        <div id="roomsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- loading field -->
            <div class="col-span-full flex justify-center items-center py-12">
                <div class="text-center animate-pulse">
                    <i class="fas fa-spinner fa-spin text-3xl mb-3 text-blue-500"></i>
                    <p class="text-gray-600 font-medium">Chargement des salons...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="Room/room_update.js"></script>
<script src="Room/room.js"></script>
<script src="Room/room_create.js"></script>
<script src="Room/room_char_count.js"></script>

<?php require_once "Footer/footer.php"?>