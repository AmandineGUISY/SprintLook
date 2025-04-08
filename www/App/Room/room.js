async function loadRooms(searchTerm = '', sortBy = 'date-desc') {
    try {
        // Afficher le loader
        document.getElementById('roomsContainer').innerHTML = `
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                <p>Chargement des salons...</p>
            </div>
        `;

        // Préparer les paramètres
        const params = new URLSearchParams({
            sort: sortBy
        });
        
        if (searchTerm) {
            params.append('search', searchTerm);
        }

        const response = await fetch(`Room/room_ajax.php?${params.toString()}`);
        const result = await response.json();

        if (!result.success) {
            throw new Error(result.message || 'Erreur lors du chargement des salons');
        }

        // Afficher les résultats
        if (result.count === 0) {
            document.getElementById('roomsContainer').innerHTML = `
                <div class="col-span-full text-center py-8 text-gray-500">
                    <i class="fas fa-inbox text-2xl mb-2"></i>
                    <p>Aucun salon trouvé</p>
                    ${searchTerm ? `<p class="text-sm">pour "${searchTerm}"</p>` : ''}
                </div>
            `;
        } else {
            displayRooms(result.data);
        }

    } catch (error) {
        console.error("Erreur:", error);
        document.getElementById('roomsContainer').innerHTML = `
            <div class="text-center py-8 text-red-500">
                <i class="fas fa-exclamation-circle text-2xl mb-2"></i>
                <p>Erreur lors du chargement</p>
                <p class="text-sm mt-2">${error.message}</p>
            </div>
        `;
    }
}

function displayRooms(rooms) {
    const container = document.getElementById('roomsContainer');
    
    container.innerHTML = rooms.map(room => `
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">${room.name}</h3>
                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">${room.code}</span>
                </div>
                <div class="flex items-center text-gray-500 text-sm mb-4">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <span>Créé le ${room.created_at}</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-blue-600 text-sm font-medium">
                        <i class="fas fa-users mr-1"></i>
                        <span>${room.member_count} participant(s)</span>
                    </div>
                    <button onclick="inviteToRoom(${room.id})" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                        <i class="fas fa-user-plus mr-1"></i> Inviter
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

function escapeHtml(unsafe) {
    return unsafe
        .toString()
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// Événements
document.getElementById('filterBtn').addEventListener('click', () => {
    const searchTerm = document.getElementById('searchInput').value;
    const sortBy = document.getElementById('sortBy').value;
    loadRooms(searchTerm, sortBy);
});

document.getElementById('searchInput').addEventListener('keyup', (e) => {
    if (e.key === 'Enter') {
        const searchTerm = e.target.value;
        const sortBy = document.getElementById('sortBy').value;
        loadRooms(searchTerm, sortBy);
    }
});

// Fonctions des boutons
function showRoomMembers(roomId) {
    console.log('Voir membres du salon', roomId);
}

function inviteToRoom(roomId) {
    console.log('Inviter au salon', roomId);
}

// Chargement initial
document.addEventListener('DOMContentLoaded', () => {
    loadRooms();
});