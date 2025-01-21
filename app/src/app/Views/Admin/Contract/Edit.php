<div class="mb-4 flex justify-end">
    <a href="/admin/contracts" class="px-4 py-2 bg-gray-700 text-white shadow-sm hover:bg-gray-500 transition-all duration-200 rounded flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        <span>Volver a contratos</span>
    </a>
</div>

<div class="bg-white p-8 border border-gray-300 rounded shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Editando contrato</h2>

    <form id="contractForm" action="/admin/contract/<?= htmlspecialchars($contract->getId()); ?>/update" method="POST"
        class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Error Messages -->
        <div id="errorMessages"
            class="hidden col-span-1 md:col-span-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6"></div>

        <!-- Contract Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($contract->name); ?>"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Start Date -->
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha inicial</label>
            <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($contract->start_date); ?>"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- End Date -->
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha final</label>
            <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($contract->end_date); ?>"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Proposed Invoice -->
        <div>
            <label for="invoice_proposed" class="block text-sm font-medium text-gray-700 mb-1">Factura propuesta</label>
            <input type="number" step="0.01" id="invoice_proposed" name="invoice_proposed"
                value="<?= htmlspecialchars($contract->invoice_proposed); ?>" max="999999999.99"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Agreed Invoice -->
        <div>
            <label for="invoice_agreed" class="block text-sm font-medium text-gray-700 mb-1">Factura aceptada</label>
            <input type="number" step="0.01" id="invoice_agreed" name="invoice_agreed"
                value="<?= htmlspecialchars($contract->invoice_agreed); ?>" max="999999999.99"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Paid Invoice -->
        <div>
            <label for="invoice_paid" class="block text-sm font-medium text-gray-700 mb-1">Factura pagada</label>
            <input type="number" step="0.01" id="invoice_paid" name="invoice_paid"
                value="<?= htmlspecialchars($contract->invoice_paid); ?>" max="999999999.99"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Submit Button -->
        <div class="col-span-1 md:col-span-2 flex justify-end gap-4">
            <button type="submit"
                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white shadow-sm rounded focus:outline-none focus:ring focus:ring-blue-500">
                Actualizar
            </button>
            <button type="button"
                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white shadow-sm rounded focus:outline-none focus:ring focus:ring-red-500">
                Eliminar
            </button>
        </div>
    </form>
</div>
