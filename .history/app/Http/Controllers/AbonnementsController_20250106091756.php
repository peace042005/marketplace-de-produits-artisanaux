<?php

namespace App\Http\Controllers;


use App\Models\Abonnement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Type_abonnement;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class AbonnementsController extends Controller
{
    public function getData(Request $request)
    {
         // Récupérer les abonnements par date de création (exemple)
        $abonnements = Abonnement::selectRaw('DATE(created_at) as date, count(*) as total')
                                 ->groupBy('date')
                                 ->orderBy('date')
                                 ->get();

        // return response()->json($abonnements);
        return view('marcella.ventes.index', compact('abonnements'));
    }
     public function index_admin(Request $request)
    {
        $abonnements = Abonnement::with(['user', 'typeAbonnement'])->get();

        return view('marcella.abonnement.index', compact('abonnements'));
    }

     // Afficher tous les abonnements
     public function index()
    {
         $abonnements = Abonnement::orderBy('created_at', 'desc');
         return view('janvier.abonnements.index', compact('abonnements'));
    }
 
     // Afficher le formulaire pour créer un abonnement
     public function create()
    {
         $typesAbonnement = Type_abonnement::all(); // Récupère tous les types d'abonnement
         return view('janvier.abonnements.create', compact('typesAbonnement'));
    }
 
     // Enregistrer un nouvel abonnement
     public function store(Request $request)
    {
            // Validation des données
        $validator = Validator::make($request->all(), [
            'type_abonnement_id' => 'required|exists:type_abonnements,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('abonnements.create')
                            ->withErrors($validator)
                            ->withInput();
        }

        // Récupérer le type d'abonnement choisi par l'utilisateur
        $typeAbonnement = Type_abonnement::findOrFail($request->type_abonnement_id);

        // Calculer la date de fin de l'abonnement
        $dateFin = Carbon::now()->addDays($typeAbonnement->duree); // Ajouter la durée en jours à la date actuelle

        // Créer l'abonnement
        $abonnement = Abonnement::create([
            'user_id' => Auth::id(),
            'type_abonnement_id' => $request->type_abonnement_id,
            'date_debut' => Carbon::now(),
            'date_fin' => $dateFin,
        ]);

        return redirect()->route('abonnements.index')->with('success', 'Abonnement créé avec succès.');

    }
 
     // Afficher le formulaire pour éditer un abonnement
     public function edit(Abonnement $abonnement)
     {
         $typesAbonnement = Type_abonnement::all();
         return view('abonnements.edit', compact('abonnement', 'typesAbonnement'));
     }
 
     // Mettre à jour un abonnement existant
     public function update(Request $request, Abonnement $abonnement)
     {
         // Validation des données
         $validator = Validator::make($request->all(), [
             'type_abonnement_id' => 'required|exists:type_abonnements,id',
         ]);
 
         if ($validator->fails()) {
             return redirect()->route('abonnements.edit', $abonnement->id)
                              ->withErrors($validator)
                              ->withInput();
         }
 
         // Mettre à jour l'abonnement
         $abonnement->update([
             'type_abonnement_id' => $request->type_abonnement_id,
             'date_debut' => Carbon::now(),
             'date_fin' => Carbon::now()->addMonth(), // Mise à jour de la date de fin
         ]);
 
         return redirect()->route('abonnements.index')->with('success', 'Abonnement mis à jour avec succès.');
     }
 
     // Supprimer un abonnement
     public function destroy(Abonnement $abonnement)
     {
         $abonnement->delete();
         return redirect()->route('abonnements.index')->with('success', 'Abonnement supprimé.');
     }
    
    

}
