<!-- resources/views/artisan/commandes.blade.php -->

<h1>Commandes de l'artisan : {{ $artisan->nom }}</h1>

<table>
    <thead>
        <tr>
            <th>Numéro de commande</th>
            <th>Date de la commande</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($artisan->commandes as $commande)
            <tr>
                <td>{{ $commande->numero }}</td>
                <td>{{ $commande->date_commande }}</td>
                <td>{{ $commande->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
