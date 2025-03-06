<div x-data="{ showAdd: @json(session('error_add') ? true : false), showUpdate: @json(session('error_update') ? true : false) }">
    @if (session('error_add'))
        <div x-show="showAdd"
             x-transition.opacity
             class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm text-center relative">
                <button @click="showAdd = false" 
                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-lg font-bold">
                    &times;
                </button>
                
                <div class="text-red-500 text-6xl mb-2">⚠️</div>
                <h2 class="text-xl font-semibold text-gray-800">Rupture de stock</h2>
                <p class="text-gray-600 mt-2">{{ session('error_add') }}</p>

                <button @click="showAdd = false"
                        class="mt-4 bg-red-500 text-white px-5 py-2 rounded-md hover:bg-red-600 transition">
                    OK
                </button>
            </div>
        </div>
        {{ session()->forget('error_add') }}
    @endif

    @if (session('error_update'))
        <div x-show="showUpdate"
             x-transition.opacity
             class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm text-center relative">
                <button @click="showUpdate = false" 
                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-lg font-bold">
                    &times;
                </button>
                
                <div class="text-yellow-500 text-6xl mb-2">⚠️</div>
                <h2 class="text-xl font-semibold text-gray-800">Stock insuffisant</h2>
                <p class="text-gray-600 mt-2">{{ session('error_update') }}</p>

                <button @click="showUpdate = false"
                        class="mt-4 bg-yellow-500 text-white px-5 py-2 rounded-md hover:bg-yellow-600 transition">
                    OK
                </button>
            </div>
        </div>
        {{ session()->forget('error_update') }}
    @endif
</div>
