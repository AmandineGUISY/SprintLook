class RoomModal {
    constructor() {
        this.modal = document.getElementById('addRoomModal');
        this.input = document.getElementById('newRoomName');

        this.counter = document.getElementById('charCount');

        this.initEvents();
    }

    initEvents() {
        // cancel button
        document.querySelector('#addRoomModal .cancel-btn').addEventListener('click', () => this.close());
        
        // create button
        document.querySelector('#addRoomModal .create-btn').addEventListener('click', () => this.createRoom());

        this.input.addEventListener('input', () => {
            this.counter.textContent = this.input.value.trim().length;
        });
    }

    open() {
        this.modal.classList.remove('hidden');
        this.input.focus();
        this.input.value = '';
        this.counter.textContent = '0';
    }

    close() {
        this.modal.classList.add('hidden');
    }

    async createRoom() {
        const roomName = this.input.value.trim();
        
        if (!roomName) {
            alert('Veuillez entrer un nom pour le salon');
            return;
        }

        try {
            const response = await fetch('Room/room_create.php', {
                method: 'POST',
                body: JSON.stringify({name:roomName})
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
    window.roomModal = new RoomModal();
});