<?php require_once "Header/header.php";?>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary-500 to-blue-400 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Rétrospectives collaboratives sans perte</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Créez des salons, invitez des participants et conservez toutes vos rétrospectives en un seul endroit. Plus de post-it perdus !</p>
            <div class="space-x-4">
                <a href="register.php" class="bg-white text-primary-600 px-6 py-3 rounded-md font-bold hover:bg-gray-100 transition text-lg">Commencer maintenant</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Comment ça marche ?</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="bg-primary-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Créez un salon</h3>
                    <p class="text-gray-600">Lancez une nouvelle rétrospective en quelques clics. Personnalisez le nom.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="bg-primary-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Invitez des participants</h3>
                    <p class="text-gray-600">Partagez un code unique. Les participants rejoignent anonymement.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="bg-primary-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Archivez et conservez</h3>
                    <p class="text-gray-600">Clôturez vos rétros et conservez-les dans les archives. Retrouvez-les facilement plus tard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Preview -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Une interface intuitive</h2>
            
            <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
                <div class="flex mb-4">
                    <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                </div>
                
                <!-- Board simulation -->
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-primary-500 text-white p-3"></div>

                    <div class="flex flex-col items-center space-y-2 py-2 bg-blue-50">
                        <h1 class="font-bold text-3xl md:text-1xl text-center text-blue-800"><?= htmlspecialchars($_GET['room_name'] ?? 'Rétrospective') ?></h1>
                        
                        <button id="newPostItBtn" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-1 px-2 rounded-full shadow-lg transition transform hover:scale-105">
                            <i class="fas fa-plus mr-2"></i>Nouveau Post-it
                        </button>
                    </div>
                    
                    <div class="grid md:grid-cols-3 gap-4 p-4">

                        
                        <!-- Positive Column -->
                        <div class="bg-green-50 p-3 rounded">
                            <h4 class="font-medium text-green-700 mb-3">Positif</h4>
                            <div class="space-y-3">
                                <div class="bg-white p-2 rounded shadow-sm border-l-4 border-green-500">
                                    Bonne collaboration entre dev et design
                                </div>
                                <div class="bg-white p-2 rounded shadow-sm border-l-4 border-green-500">
                                    Nouvelle feature bien accueillie par les users
                                </div>
                            </div>
                        </div>
                        
                        <!-- To Improve Column -->
                        <div class="bg-yellow-50 p-3 rounded">
                            <h4 class="font-medium text-yellow-700 mb-3">À améliorer</h4>
                            <div class="space-y-3">
                                <div class="bg-white p-2 rounded shadow-sm border-l-4 border-yellow-500">
                                    Processus de revue de code
                                </div>
                                <div class="bg-white p-2 rounded shadow-sm border-l-4 border-yellow-500">
                                    Communication inter-équipes
                                </div>
                            </div>
                        </div>
                    
                        <!-- Negative Column -->
                        <div class="bg-red-50 p-3 rounded">
                            <h4 class="font-medium text-red-700 mb-3">Négatif</h4>
                            <div class="space-y-3">
                                <div class="bg-white p-2 rounded shadow-sm border-l-4 border-red-500">
                                    Les déploiements prennent trop de temps
                                </div>
                                <div class="bg-white p-2 rounded shadow-sm border-l-4 border-red-500">
                                    Manque de documentation sur l'API
                                </div>
                            </div>
                        </div> 
                    </div>                   
                    
                    <div class="bg-gray-100 p-3 flex justify-between items-center">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-8 md:mb-12 text-gray-800">Foire aux questions</h2>
            
            <div class="space-y-4">
                <!-- Question 1 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition">
                        <span class="text-lg font-medium text-left">Comment créer une rétrospective ?</span>
                        <i class="fas fa-chevron-down transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer hidden p-4 bg-white">
                        <p>Pour créer une rétrospective, cliquez sur "Commencer maintenant" puis connectez-vous ou créez un compte. Une fois connecté, vous pourrez créer un nouveau salon en cliquant sur le bouton +.</p>
                    </div>
                </div>
                
                <!-- Question 2 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition">
                        <span class="text-lg font-medium text-left">Les participants doivent-ils créer un compte ?</span>
                        <i class="fas fa-chevron-down transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer hidden p-4 bg-white">
                        <p>Non, les participants ne doivent de créer un compte. Ils peuvent rejoindre la rétrospective avec le code que vous leur fournissez, anonymement</p>
                    </div>
                </div>
                
                <!-- Question 3 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition">
                        <span class="text-lg font-medium text-left">Combien de temps les rétrospectives sont-elles conservées ?</span>
                        <i class="fas fa-chevron-down transition-tr ansform duration-300"></i>
                    </button>
                    <div class="faq-answer hidden p-4 bg-white">
                        <p>Les rétrospectives sont conservées indéfiniment dans vos archives. Vous pouvez les consulter à tout moment après les avoir clôturées.</p>
                    </div>
                </div>
                
                <!-- Question 4 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition">
                        <span class="text-lg font-medium text-left">Comment rejoindre un salon ?</span>
                        <i class="fas fa-chevron-down transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer hidden p-4 bg-white">
                        <p>Pour rejoindre un salon, cliquez sur "Rejoindre un salon" puis sélectionnez une fausse identitée. Une fois chose faite, insérez le code du salon ainsi que le pseudo de l'Host puis cliquer sur "Rejoindre".</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 md:py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-6">Prêt à transformer vos rétrospectives ?</h2>
            <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">Rejoignez des centaines d'équipes qui utilisent déjà SprintLook pour leurs rétrospectives.</p>
            <a href="register.php" class="bg-white text-blue-600 px-8 py-3 rounded-md font-bold hover:bg-gray-100 transition text-lg inline-block">Créer un compte gratuit</a>
        </div>
    </section>

    <script src="Index/faq.js"></script>

<!-- Footer -->
<?php require_once "Footer/footer.php";?>