<!-- filepath: /c:/xampp/htdocs/GameHub/resources/views/admin/sidebar.blade.php -->
<div class="bg-gray-800 text-white w-64 min-h-screen p-4">
    <h2 class="text-2xl font-bold mb-4">Admin Panel</h2>
    <ul>
        <li class="mb-2">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.orders.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Orders</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Products</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Categories</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.platforms.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Platforms</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Users</a>
        </li>
    </ul>
</div>