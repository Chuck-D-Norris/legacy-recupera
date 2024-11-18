<div class="mb-4 flex justify-end">
    <a href="/users"
        class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg shadow focus:outline-none focus:ring focus:ring-green-500 flex items-center space-x-2">
        <!-- Heroicon for return/back (chevron-left) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        <span>Return to Users</span>
    </a>
</div>


<div class="bg-white p-8 border border-gray-300 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Create User</h2>
    <form action="/user/store" method="POST" class="space-y-6">

        <!-- Company -->
        <div>
            <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Company</label>
            <input type="text" id="company" name="company"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" id="name" name="name"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- DNI -->
        <div>
            <label for="dni" class="block text-sm font-medium text-gray-700 mb-1">DNI</label>
            <input type="text" id="dni" name="dni"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Role -->
        <div>
            <label for="role_id" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select id="role_id" name="role_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500"
                    required>
                <option value="" disabled selected>Select Role</option>
                <option value="1">Admin</option>
                <option value="2">User</option>
                <option value="3">Guest</option>
            </select>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" name="password"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center">
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring focus:ring-blue-500">
                Create User
            </button>
        </div>
    </form>
</div>
