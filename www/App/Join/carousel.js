// Image management
const imagePaths = Array.from({length: 9}, (_, i) => `/Resources/Images/${i + 1}.png`);
let currentImageIndex = 0;
const imageElement = document.getElementById('currentImage');
const imageCounter = document.getElementById('imageCounter');

const currentImageInput = document.getElementById('currentImageInput')

// name management
const names = ["Alex", "Morgane", "Soraya", "Hinata", "Megan", "Steve", "Max", "Jacob", "Nicolas", "Amine"];
let currentNameIndex = 0;
const nameElement = document.getElementById('currentName');
const nameCounter = document.getElementById('nameCounter');

const currentNameInput = document.getElementById('currentNameInput');

function updateDisplay() {
    imageElement.src = imagePaths[currentImageIndex];
    imageCounter.textContent = `${currentImageIndex + 1}/${imagePaths.length}`;
    currentImageInput.value = `${currentImageIndex + 1}.png`;
    
    nameElement.textContent = names[currentNameIndex];
    nameCounter.textContent = `${currentNameIndex + 1}/${names.length}`;
    currentNameInput.value = names[currentNameIndex];
}

// Listener for the arrow of the image
document.getElementById('prevImage').addEventListener('click', () => {
    currentImageIndex = (currentImageIndex - 1 + imagePaths.length) % imagePaths.length;
    updateDisplay();
});

document.getElementById('nextImage').addEventListener('click', () => {
    currentImageIndex = (currentImageIndex + 1) % imagePaths.length;
    updateDisplay();
});

// Listener for the arrow of the name
document.getElementById('prevName').addEventListener('click', () => {
    currentNameIndex = (currentNameIndex - 1 + names.length) % names.length;
    updateDisplay();
});

document.getElementById('nextName').addEventListener('click', () => {
    currentNameIndex = (currentNameIndex + 1) % names.length;
    updateDisplay();
});

// initialization of the display
updateDisplay();