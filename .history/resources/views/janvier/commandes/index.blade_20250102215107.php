@if($commandes->isEmpty())
    <p>Aucune commande reçue pour le moment.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Numéro de commande</th>
                <th>Date de la commande</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commandes as $commande)
                <tr>
                    <td>{{ $commande->numero }}</td>
                    <td>{{ $commande->date_commande }}</td>
                    <td>{{ $commande->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
