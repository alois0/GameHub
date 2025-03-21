<x-mail::message>
{{-- Greeting --}}
# Bonjour {{ $user->name }}! 🎉

{{-- Intro Lines --}}
Merci pour votre commande sur **GameHub**. Voici les détails de votre commande :

{{-- Order Details --}}
## 🛒 Détails de la commande
- **Numéro de commande :** {{ $order->id }}
- **Total :** {{ number_format($order->total_price, 2) }} €

---
---
## 🛍️ Produits commandés :
@foreach ($order->orderDetails as $detail)
- **Produit :** {{ $detail->product->product_name ?? 'Produit inconnu' }}  
- **Quantité :** {{ $detail->quantity }}  
- **Prix unitaire :** {{ number_format($detail->price_each, 2) }} €
- **Code : ** 
    <span 
        style="
            background-color: #000; 
            color: #000; *
            padding: 2px 4px; *
            border-radius: 4px; 
            cursor: pointer;"
        onmouseover="this.style.color = '#fff'"
        onmouseout="this.style.color = '#000'">
        {{ strtoupper(Str::random(12)) }}
    </span>
---
@endforeach

---

Merci pour votre achat ! 🎮 Nous espérons vous revoir bientôt sur **GameHub**.

{{-- Salutation --}}
Cordialement,  
**L'équipe GameHub**  

{{-- Subcopy --}}
<x-slot:subcopy>
📧 **Besoin d'aide ?** Contactez-nous à **support@gamehub.com**.  
Vous pouvez également consulter votre commande ici :  
[Voir ma commande]({{ url('/orders/' . $order->id) }})
</x-slot:subcopy>
</x-mail::message>
