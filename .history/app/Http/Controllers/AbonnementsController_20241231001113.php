<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Type_abonnement;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbonnementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abonnements = Abonnement::with(['user', 'typeAbonnement'])->get();

        return view('marcella.abonnement.index', compact('abonnements'));
    }

    public function tyabonnements()
    {
        $type_abonnements = Type_abonnement::all();

        return view('janvier.abonnement.index', compact('type_abonnements'));
    }


    // public function abonnementsData(Request $request)
    // {
    //      // Données communes pour les deux vues
    //      $abonnementsParMois = DB::table('abonnements')
    //      ->select(DB::raw('MONTH(created_at) as mois, COUNT(*) as total'))
    //      ->groupBy('mois')
    //      ->orderBy('mois', 'asc')
    //      ->get();

    //     $abonnementsParAnnee = DB::table('abonnements')
    //         ->select(DB::raw('YEAR(created_at) as annee, COUNT(*) as total'))
    //         ->groupBy('annee')
    //         ->orderBy('annee', 'asc')
    //         ->get();

    //     $abonnementsDetails = DB::table('abonnements')->get();

    //     // Vérifiez le type de vue demandé (via une query string ou une route dédiée)
    //     $viewType = $request->input('view', 'graph'); // Par défaut, "graph"


    // }

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
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("abonnements.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Abonnement::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $abonnement = Abonnement::find($id);
        return view("abonnements.show", compact("abonnement"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $abonnement = Abonnement::find($id);
        return view("abonnements.edit", compact("abonnement"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $abonnement = Abonnement::find($id);
        $abonnement->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $typeAbonnement = Type_abonnement::find($id);
        if ($typeAbonnement) {
            $typeAbonnement->delete();
            return redirect()->route('type_abonnements.index')->with('success', 'Abonnement supprimé.');
        } else {
            return redirect()->route('type_abonnements.index')->with('error', 'Abonnement introuvable.');
        }
    }

    public function subscribe(Type_abonnement $typeAbonnement)
    {
        // Vérifier si l'utilisateur est connecté
        $user = Auth::user();

        // Calculer la date de fin de l'abonnement (ici, exemple d'ajout d'un mois)
        $dateFin = Carbon::now()->addMonth(); // Ajoute 1 mois par défaut

        // Enregistrer l'abonnement dans la base de données
        Abonnement::create([
            'user_id' => $user->id,
            'type_abonnement_id' => $typeAbonnement->id,
            'date_debut' => Carbon::now(),
            'date_fin' => $dateFin,
        ]);

        // Retourner un message de succès et rediriger vers la page des abonnements
        return redirect()->route('janvier.abonnement.index')->with('success', 'Abonnement effectué avec succès!');
    }

}
