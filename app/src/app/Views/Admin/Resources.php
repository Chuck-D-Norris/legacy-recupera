<div class="mb-4 flex justify-end">
    <a href="/admin/resource/create"
        class="px-4 py-2 bg-gray-700 text-white shadow-sm hover:bg-gray-500 transition-all duration-200 rounded">
        <i class="fas fa-plus mr-2"></i> Nuevo recurso
    </a>
</div>
<!-- Element Types Table -->
<div class="relative overflow-x-auto rounded">
    <table class="w-full text-sm text-left text-gray-700 border border-gray-200">
        <thead class="bg-gray-700 text-white">
            <tr class="h-12"> <!-- Adjusted height -->
                <th scope="col" class="px-4 py-3 font-medium rounded-tl-lg">Nombre</th>
                <th scope="col" class="px-4 py-3 font-medium">Tipo de recurso</th>
                <th scope="col" class="px-4 py-3 font-medium">Descripción</th>
                <th scope="col" class="px-4 py-3 text-center font-medium w-32 rounded-tr-lg">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php if (empty($resources)) { ?>
                <tr>
                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">No hay recursos disponibles.</td>
                </tr>
            <?php } else { ?>
                <?php foreach ($resources as $resource) { ?>
                    <tr class="hover:bg-gray-50 transition-colors duration-300">
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                            <?= htmlspecialchars($resource->name); ?>
                        </th>
                        <td class="px-4 py-3">
                            <?= htmlspecialchars($resource->resourceType()->name); ?>
                        </td>
                        <td class="px-4 py-3">
                            <?= htmlspecialchars($resource->description ? $resource->description : 'N/A'); ?>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center space-x-3">
                                <a href="/admin/resource/<?= htmlspecialchars($resource->getId()); ?>/edit"
                                    class="p-2 text-gray-700 border border-transparent hover:text-gray-500 transition-all duration-200"
                                    title="Editar"
                                    aria-label="Editar tipo de recurso <?= htmlspecialchars($resource->getId()); ?>?');"><i
                                        class="fas fa-pencil"></i>
                                </a>
                                <a href="/admin/resource/<?= htmlspecialchars($resource->getId()); ?>/delete"
                                    onclick="return confirm('¿Desea eliminar el tipo de elemento <?= htmlspecialchars($resource->getId()); ?>?');"
                                    class="p-2 text-gray-700 border border-transparent hover:text-red-500 transition-all duration-200"
                                    title="Eliminar"
                                    aria-label="Eliminar tipo de elemento <?= htmlspecialchars($resource->name); ?>">
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
