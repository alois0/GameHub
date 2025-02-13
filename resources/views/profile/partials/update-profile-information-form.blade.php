<section class="bg-white shadow-lg rounded-lg p-6">
    <header class="border-b pb-4 mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Informations du profil</h2>
        <p class="mt-1 text-sm text-gray-600">
            Mettez à jour les informations de votre compte et votre adresse e-mail.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Nom -->
        <div>
            <label for="name" class="block text-gray-700 font-semibold">Nom</label>
            <input id="name" name="name" type="text" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-700 font-semibold">Email</label>
            <input id="email" name="email" type="email" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-800">
                        Votre adresse email n'est pas vérifiée.
                        <button form="send-verification"
                                class="underline text-sm text-blue-500 hover:text-blue-700">
                            Cliquez ici pour renvoyer l'email de vérification.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Bouton Enregistrer -->
        <div class="flex items-center justify-between">
            <button type="submit" 
                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                Enregistrer
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600">
                    Modifications enregistrées.
                </p>
            @endif
        </div>
    </form>
</section>
