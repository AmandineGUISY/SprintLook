<?php require_once "Header/header.php";?>

<div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-4">
    <div class="max-w-2xl w-full bg-white rounded-xl shadow-lg overflow-hidden p-6">
        <!-- Images -->
        <div class="mb-7">
            <div class="relative">
            <h2 id="imageCounter" class="text-center text-1xl font-bold text-gray-600 mb-1">1/9</h2>
                <div class="flex items-center justify-center">
                    <!-- left arrow-->
                    <button id="prevImage" class="p-2 rounded-full bg-blue-200 hover:bg-blue-300 mr-4 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    
                    <!-- Image -->
                    <div class="w-40 h-40 sm:w-48 sm:h-48 md:w-56 md:h-56 lg:w-64 lg:h-64 flex items-center justify-center bg-gray-200 rounded-full overflow-hidden mx-2">
                        <img id="currentImage" src="Resources/Images/1.png" alt="Image sélectionnée" 
                             class="w-full h-full object-cover">
                    </div>
                    
                    <!-- right arrow -->
                    <button id="nextImage" class="p-2 rounded-full bg-blue-200 hover:bg-blue-300 ml-4 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Select a name -->
        <div>
            <div class="relative">
                <div class="flex items-center justify-center">
                    <!-- left arrow -->
                    <button id="prevName" class="p-2 rounded-full bg-blue-200 hover:bg-blue-300 mr-4 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    
                    <!-- name -->
                    <div class="w-64 h-16 flex items-center justify-center bg-gray-100 rounded-lg">
                        <p id="currentName" class="text-3xl font-medium text-gray-800">Alex</p>
                    </div>
                    
                    <!-- right arrow -->
                    <button id="nextName" class="p-2 rounded-full bg-blue-200 hover:bg-blue-300 ml-4 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                <h2 id="nameCounter" class="text-center mt-2 text-gray-600 text-1xl font-bold">1/10</h2>
            </div>
        </div>

        <form action="#" id ="namelessForm" method="POST" class="space-y-5 px-4 sm:px-8 mt-2">

            <!-- Name of the room -->
            <div class="group">
                <label for="nameRoom" class="block text-xl font-medium text-gray-700 mb-2 transition-all duration-200 group-focus-within:text-blue-600">
                    Nom du salon
                </label>
                <div class="relative">
                    <input 
                        type="text" 
                        id="nameRoom" 
                        name="nameRoom" 
                        class="w-full pl-11 pr-4 py-3 text-gray-700 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all duration-200 placeholder-gray-400 hover:border-gray-300"
                        placeholder="Entrez le nom du salon"
                        required
                    >
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-home text-gray-400 group-focus-within:text-blue-500"></i>
                    </div>
                </div>
            </div>

            <!-- code of the room -->
            <div class="group">
                <label for="code" class="block text-xl font-medium text-gray-700 mb-2 transition-all duration-200 group-focus-within:text-blue-600">
                    </i>Code du salon
                </label>
                <div class="relative">
                    <input 
                        type="text" 
                        id="code" 
                        name="code" 
                        class="w-full pl-11 pr-4 py-3 text-gray-700 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all duration-200 placeholder-gray-400 hover:border-gray-300"
                        placeholder="Entrez le code du salon"
                        required
                        maxlength="6"
                    >
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-key text-gray-400 group-focus-within:text-blue-500"></i>
                    </div>
                </div>
            </div>

            <!-- Enter the room -->
            <div class="mt-10 text-center">
                <button id="validate" class="text-2xl px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mt-5">
                    Entrer
                </button>
            </div>
        </form>
    </div>

    <script src="Join/carousel.js"></script>
</div>

<?php require_once "Footer/footer.php";?>