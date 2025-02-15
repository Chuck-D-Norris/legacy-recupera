<?php
function mapWithId($items, $getIdMethod)
{
    return array_map(function ($item) use ($getIdMethod) {
        $properties = get_object_vars($item);
        $properties['id'] = $item->$getIdMethod();

        return (object) $properties;
    }, $items);
}
?>

<div class="mb-4 flex justify-end">
    <a href="/admin/work-orders" class="px-4 py-2 bg-gray-700 text-white shadow-sm hover:bg-gray-500 transition-all duration-200 rounded flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        <span>Volver a órdenes de trabajo</span>
    </a>
</div>

<div class="bg-white p-8 border border-gray-300 rounded shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Crear nueva órden de trabajo</h2>
    <form id="workOrderForm" action="/admin/work-order/store" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Error Messages -->
        <div id="errorMessages" class="hidden col-span-1 md:col-span-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"></div>

        <!-- Date -->
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
            <input type="date" id="date" name="date" required class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Users -->
        <div>
            <label for="users" class="block text-sm font-medium text-gray-700 mb-1">Operarios</label>
            <input type="text" name="userNames" id="workersInput" readonly onclick="openModal('modalWorkers', 'workersInput')" placeholder="Seleccionar Operarios" class="w-full px-4 py-2 border border-gray-300 rounded cursor-pointer focus:outline-none">
            <input type="hidden" name="userIds" id="userIdsInput">
        </div>

        <!-- Add Blocks Button -->
        <div class="col-span-1 md:col-span-2 flex justify-end">
            <button type="button" id="addBlocks" onclick="addBlock()" class="px-4 py-2 bg-green-500 text-white shadow-sm hover:bg-green-600 transition-all duration-200 rounded mt-4">
                Añadir Bloques
            </button>
        </div>

        <!-- Blocks Container -->
        <div id="blocksContainer" class="col-span-1 md:col-span-2 space-y-6">
            <div class="workorder-block border border-gray-300 rounded shadow p-6 bg-gray-50 mb-6" data-block-index="0">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Bloque <span class="block-number">1</span></h3>
                    <button type="button" onclick="removeBlock(this)" class="text-red-500 hover:text-red-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
                <div class="mb-4">
                    <label for="zonesInput_0" class="block text-sm font-medium text-gray-700 mb-1">Zonas</label>
                    <input type="text" id="zonesInput_0" readonly onclick="openModal('modalZones', 'zonesInput_0')" placeholder="Seleccionar Zonas" class="w-full px-4 py-2 border border-gray-300 rounded cursor-pointer focus:outline-none">
                    <input type="hidden" name="blocks[0][zonesIds]" id="zonesIdsInput_0">
                </div>
                <div class="tasksContainer space-y-4 mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 my-3">Tareas</h3>
                    <div class="task-row flex space-x-4 items-end" data-task-index="0">
                        <div class="flex-auto">
                            <label for="taskType_0_0" class="block text-sm font-medium text-gray-700 mb-1">Tarea</label>
                            <select name="blocks[0][tasks][0][taskType]" id="taskType_0_0" class="w-full px-4 py-2 border border-gray-300 rounded bg-white focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Seleccione una tarea</option>
                                <?php foreach ($task_types as $task_type) { ?>
                                    <option value="<?= htmlspecialchars($task_type->getId()) ?>"><?= htmlspecialchars($task_type->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="flex-auto">
                            <label for="elementType_0_0" class="block text-sm font-medium text-gray-700 mb-1">Elemento</label>
                            <select name="blocks[0][tasks][0][elementType]" id="elementType_0_0" class="w-full px-4 py-2 border border-gray-300 rounded bg-white focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                                <option value="" selected>Seleccione un elemento</option>
                                <?php foreach ($element_types as $element_type) { ?>
                                    <option value="<?= htmlspecialchars($element_type->getId()) ?>"><?= htmlspecialchars($element_type->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="flex-auto">
                            <label for="species_0_0" class="block text-sm font-medium text-gray-700 mb-1">Species</label>
                            <select name="blocks[0][tasks][0][species]" id="species_0_0" class="w-full px-4 py-2 border border-gray-300 rounded bg-white focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                                <option value="" selected>Sin definir (Opcional)</option>
                                <?php foreach ($tree_types as $tree_type) { ?>
                                    <option value="<?= htmlspecialchars($tree_type->getId()) ?>"><?= htmlspecialchars($tree_type->species) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="button" onclick="removeTaskRow(this)" class="text-red-500 hover:text-red-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="button" onclick="addTask(this)" class="px-4 py-2 bg-green-500 text-white shadow-sm hover:bg-green-600 transition-all duration-200 rounded">
                    Añadir Tarea
                </button>
                <div class="mt-4">
                    <label for="notes_0" class="block text-sm font-medium text-gray-700 mb-1">Notas</label>
                    <textarea name="blocks[0][notes]" id="notes_0" rows="4" placeholder="Añadir notas aquí..." class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 resize-none"></textarea>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-span-1 md:col-span-2 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white shadow-sm hover:bg-blue-600 transition-all duration-200 rounded">
                Crear
            </button>
        </div>
    </form>
</div>

<div id="modalWorkers" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded shadow-lg p-6 w-1/3">
        <h3 class="text-lg font-semibold mb-4">Seleccionar Operarios</h3>
        <div class="space-y-2">
            <?php foreach ($users as $user) { ?>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" value="<?= htmlspecialchars($user->getId()); ?>" class="form-checkbox">
                    <span><?= htmlspecialchars($user->name.' '.$user->surname); ?></span>
                </label>
            <?php } ?>
        </div>
        <div class="flex justify-end mt-4">
            <button onclick="saveSelection('modalWorkers')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Aplicar
            </button>
            <button onclick="closeModal('modalWorkers')" class="ml-2 text-gray-700 px-4 py-2 rounded hover:bg-gray-200">
                Cancelar
            </button>
        </div>
    </div>
</div>

<div id="modalZones" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded shadow-lg p-6 w-1/3">
        <h3 class="text-lg font-semibold mb-4">Seleccionar Zonas</h3>
        <div class="space-y-2">
            <?php foreach ($zones as $zone) { ?>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" value="<?= htmlspecialchars($zone->getId()); ?>" class="form-checkbox">
                    <span><?= htmlspecialchars($zone->name); ?></span>
                </label>
            <?php } ?>
        </div>
        <div class="flex justify-end mt-4">
            <button onclick="saveSelection('modalZones')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Aplicar
            </button>
            <button onclick="closeModal('modalZones')" class="ml-2 text-gray-700 px-4 py-2 rounded hover:bg-gray-200">
                Cancelar
            </button>
        </div>
    </div>
</div>

<script>
    const taskTypes = <?= json_encode(mapWithId($task_types, 'getId')); ?>;
    const treeTypes = <?= json_encode(mapWithId($tree_types, 'getId')); ?>;
    const elementTypes = <?= json_encode(mapWithId($element_types, 'getId')); ?>;
</script>
