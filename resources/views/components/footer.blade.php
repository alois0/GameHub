<footer class="bg-gray-900 text-white py-10">
    <div class="container mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- À propos -->
            <div>
                <h2 class="text-xl font-semibold mb-3">À propos</h2>
                <p class="text-gray-400 text-sm">
                    GameHub est votre boutique de jeux vidéo en ligne. Découvrez les meilleures offres et les dernières nouveautés.
                </p>
            </div>

            <!-- Liens rapides -->
            <div>
                <h2 class="text-xl font-semibold mb-3">Liens rapides</h2>
                <ul class="text-gray-400 text-sm space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-gray-300">Accueil</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-gray-300">Boutique</a></li>
                
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h2 class="text-xl font-semibold mb-3">Contact</h2>
                <p class="text-gray-400 text-sm">Email : support@gamehub.com</p>
                <p class="text-gray-400 text-sm">Tél. : +33 1 23 45 67 89</p>
                <p class="text-gray-400 text-sm">Adresse : Paris, France</p>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-10 text-center text-gray-500 text-sm">
            © {{ date('Y') }} GameHub. Tous droits réservés.
        </div>
    </div>
</footer>
