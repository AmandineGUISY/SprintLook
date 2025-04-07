<?php require_once "Header/header.php"?>

<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Créer un compte</h2>
  </div>

  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
      <form class="space-y-6" action="#" method="POST">
        <div>
            <!-- username -->
          <label for="username" class="block text-sm font-medium text-gray-700">Pseudo</label>
          <div class="mt-1">
            <input id="username" name="username" type="text" required 
                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
          <div class="mt-1">
            <input id="email" name="email" type="email" autocomplete="email" required 
                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
          <div class="mt-1">
            <input id="password" name="password" type="password" required 
                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

                <!-- Confirm Password -->
                <div>
          <label for="confirm password" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
          <div class="mt-1">
            <input id="confirm password" name="confirm password" type="password" required 
                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <div>
          <button
                type="submit" 
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                S'inscrire
          </button>
        </div>
      </form>

      <div class="mt-6 text-center text-sm">
        <p class="text-gray-600">
            Déjà un compte? <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Se connecter</a>
        </p>
      </div>
    </div>
  </div>
</div>

<?php require_once "Footer/footer.php"?>