<div class="mb-4 flex justify-end">
    <a href="/admin/pokemon" class="px-4 py-2 bg-gray-700 text-white shadow-sm hover:bg-gray-500 transition-all duration-200 rounded flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg> 
        <span>Volver a Pokemons</span>
    </a>
</div>

<div class="bg-white p-8 border border-gray-300 rounded shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Traspasar Puntos</h2>

    <div id="errorMessages"
        class="hidden col-span-1 md:col-span-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"></div>

    <form action="/admin/pokemon/intercanvis" method="post">
        <div class="flex space-x-4 mb-4">
            <div class="w-1/2">
                <label for="pokemon" class="block text-sm font-medium text-gray-700 mb-1">Donar punts</label>
                <select id="pokemon" name="pokemon" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Selecciona un Pokémon</option>
                    <?php foreach ($pokemons as $pokemon) { ?>
                        <option value="<?= htmlspecialchars($pokemon->id); ?>"><?= htmlspecialchars($pokemon->name); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="w-1/2">
                <label for="pokemon2" class="block text-sm font-medium text-gray-700 mb-1">Rebre punts</label>
                <select id="pokemon2" name="pokemon2" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Selecciona un Pokémon</option>
                    <?php foreach ($pokemons as $pokemon) { ?>
                        <option value="<?= htmlspecialchars($pokemon->id); ?>"><?= htmlspecialchars($pokemon->name); ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="mb-4">   
            <label for="points" class="block text-sm font-medium text-gray-700 mb-1">Puntos</label>
            <input type="number" id="points" name="points" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="col-span-1 md:col-span-2 flex justify-end">
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white shadow-sm hover:bg-blue-600 transition-all duration-200 rounded">
                Convertir Pokémon
            </button>
        </div>
    </form>
</div>