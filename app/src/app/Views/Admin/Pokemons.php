<div class="mb-4 flex justify-end">
    <a href="/admin/pokemon/convert" class="mr-5 7px-5 py-2 bg-gray-700 text-white shadow-sm hover:bg-gray-500 transition-all duration-200 rounded">
        <i class="fas fa-plus mr-2"></i> Conversio de Punts
    </a>
    <a href="/admin/pokemon/create" class="px-4 py-2 bg-gray-700 text-white shadow-sm hover:bg-gray-500 transition-all duration-200 rounded">
        <i class="fas fa-plus mr-2"></i> Nou Pokémon
    </a>
   
</div>

<!-- Table -->
<div class="relative overflow-x-auto rounded">
    <table class="w-full text-sm text-left text-gray-700 border border-gray-200">
        <thead class="bg-gray-700 text-white">
            <tr class="h-12">
                <th scope="col" class="px-4 py-3 font-medium rounded-tl-lg">Nom</th>
                <th scope="col" class="px-4 py-3 font-medium">Tipus</th>
                <th scope="col" class="px-4 py-3 font-medium">Punts</th> 
                <th scope="col" class="px-4 py-3 text-center font-medium w-32 rounded-tr-lg">Accions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php if (empty($pokemons)) { ?>
                <tr>
                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">No hi ha Pokémons disponibles.</td>
                </tr>
            <?php } else { ?>
                <?php foreach ($pokemons as $pokemon) { ?>
                    <tr class="hover:bg-gray-50 transition-colors duration-300">
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                            <?= htmlspecialchars($pokemon->name); ?>
                        </th>
                        <td class="px-4 py-3">
                            <?= htmlspecialchars($pokemon->type); ?>
                        </td>
                        <td class="px-4 py-3 flex items-center">
                            <form action="/admin/pokemon/<?= htmlspecialchars($pokemon->id); ?>/points" method="post" class="inline">
                                <input type="hidden" name="action" value="increment">
                                <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded mr-2">+</button>
                            </form>
                            <span class="mx-2"><?= htmlspecialchars($pokemon->points ?? 0); ?></span>
                            <form action="/admin/pokemon/<?= htmlspecialchars($pokemon->id); ?>/points" method="post" class="inline">
                                <input type="hidden" name="action" value="de crement">
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded ml-2">-</button>
                            </form>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center space-x-3">
                                <a href="/admin/pokemon/<?= htmlspecialchars($pokemon->id); ?>/edit"
                                    class="p-2 text-gray-700 border border-transparent hover:text-gray-500 transition-all duration-200"
                                    title="Editar" aria-label="Editar Pokémon <?= htmlspecialchars($pokemon->name); ?>">
                                    <i class="fas fa-pencil"></i>
                                </a>
                                <a href="/admin/pokemon/<?= htmlspecialchars($pokemon->id); ?>/delete"
                                    class="p-2 text-gray-700 border border-transparent hover:text-red-500 transition-all duration-200"
                                    title="Eliminar" aria-label="Eliminar Pokémon <?= htmlspecialchars($pokemon->name); ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>