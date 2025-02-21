<div x-data="{ show: @json(session('error') ? true : false) }">
    @if (session('error'))
        <div x-show="show" 
             x-transition.opacity
             class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm text-center relative">
                <!-- Bouton pour fermer la modale -->
                <button @click="show = false" 
                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-lg font-bold">
                    &times;
                </button>

                <!-- Icône d'erreur -->
                <div class="text-red-500 text-6xl mb-2">
                    &#10060;
                </div>

                <h2 class="text-xl font-semibold text-gray-800">Erreur</h2>
                <p class="text-gray-600 mt-2">{{ session('error') }}</p>

                <!-- Bouton OK -->
                <button @click="show = false"
                        class="mt-4 bg-red-500 text-white px-5 py-2 rounded-md hover:bg-red-600 transition">
                    OK
                </button>

                

            </div>
        </div>
    @endif
</div>
