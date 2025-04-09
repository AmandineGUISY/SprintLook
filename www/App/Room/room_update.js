class RoomUpdate {
    constructor() {
        this.modal = document.getElementById('openUpdateRoom');
        this.input = document.getElementById('updateRoomName');
        this.currentRoomId = null;
        this.currentRoomName = null;
        this.initEvents();
    }

    initEvents() {
        // cancel button
        document.querySelector('#openUpdateRoom .cancel-btn').addEventListener('click', () => this.close());
        
        // create button
        document.querySelector('#openUpdateRoom .create-btn').addEventListener('click', () => this.updateRoom());
    }

    open(name, id) {
        this.currentRoomId = id;
        this.currentRoomName = name
        this.modal.classList.remove('hidden');
        this.input.focus();
        this.input.value = name;
    }

    close() {
        this.modal.classList.add('hidden');
    }

    async updateRoom() {
        const roomName = this.input.value.trim();
        
        if (!roomName) {
            alert('Le nom du salon ne peut pas être vide');
            return;
        }

        if (!this.currentRoomId) {
            alert('Erreur: ID de salon non défini');
            return;
        }

        if (this.currentRoomName == roomName) {
            alert('Veuillez entrer un nouveau nom pour le salon')
            return;
        }

        try {
            const response = await fetch('Room/room_update.php', {
                method: 'POST',
                body: JSON.stringify({
                    room_id: this.currentRoomId,
                    name:roomName})
            });
            
            const result = await response.json();
            
            if (result.success) {
                this.close();
                if (typeof window.loadRooms === 'function') {
                    await window.loadRooms();
                }
            } else {
                alert(result.message || 'Erreur lors de la création');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Erreur réseau');
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    window.roomUpdate = new RoomUpdate();
});