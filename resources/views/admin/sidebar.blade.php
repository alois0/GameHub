<div class="bg-gray-800 text-white w-64 min-h-screen p-4 fixed h-full">
    <h2 class="text-2xl font-bold mb-4">Administration</h2>
    <ul>
        <li class="mb-2">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Acceuil</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.orders.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Commandes</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Produits</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Catégories</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.platforms.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Platformes</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Utilisateurs</a>
        </li>
    </ul>
</div>