<x-mail::message>
{{-- Greeting --}}
# Bonjour!

{{-- Intro Lines --}}
Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.

{{-- Action Button --}}
<x-mail::button :url="$actionUrl" color="primary">
Réinitialiser le mot de passe
</x-mail::button>

{{-- Outro Lines --}}
Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune autre action n'est requise.

{{-- Salutation --}}
Cordialement,<br>
{{ config('app.name') }}

{{-- Subcopy --}}
<x-slot:subcopy>
Si vous avez des difficultés à cliquer sur le bouton "Réinitialiser le mot de passe", copiez et collez l'URL ci-dessous
dans votre navigateur web : <span class="break-all">[{{ $actionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
</x-mail::message>