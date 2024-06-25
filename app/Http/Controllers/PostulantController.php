<?php

namespace App\Http\Controllers;

use App\Models\Postulant;
use App\Models\Recrutement;
use Illuminate\Http\Request;

class PostulantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postulants = Postulant::with('offre')->get();
        $recrutements = Recrutement::with('postulants')->get();

        return view("dashboard", ["postulants" => $postulants, "recrutements" => $recrutements]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "prenom" => ["required", "string", "max:100"],
            "nom" => ["required", "string", "max:50"],
            "email" => ["required", "email"],
            "pays" => ["required", "numeric", "exists:pays,id"],
            "offre" => ["required", "numeric", "exists:recrutements,id"],
            "ville" => ["required", "string", "max:75"],
            "phone" => ["required", "regex:/^(\+\d{1,3}[- ]?)?\d{10}$/"],
            "whatsapp" => ["required", "regex:/^(\+\d{1,3}[- ]?)?\d{10}$/"],
            "cv" => ["required"],
        ],
        [
            "prenom.required" => "Le prénom est obligatoire.",
            "prenom.max" => "Le prénom ne doit pas dépasser 100 caractères.",
            "nom.required" => "Le nom est obligatoire.",
            "nom.max" => "Le nom ne doit pas dépasser 50 caractères.",
            "pays.required" => "Veuillez sélectionner un pays.",
            "pays.exists" => "Le pays sélectionné n'est pas valide.",
            "offre.required" => "Veuillez sélectionner une offre.",
            "offre.exists" => "L'offre sélectionnée n'est pas valide.",
            "ville.required" => "La ville est obligatoire.",
            "ville.max" => "Le nom de la ville ne doit pas dépasser 75 caractères.",
            "phone.required" => "Le numéro de téléphone est obligatoire.",
            "phone.regex" => "Le format du numéro de téléphone n'est pas valide. Utilisez le format +XXX XXXXXXXXXX.",
            "whatsapp.required" => "Le numéro WhatsApp est obligatoire.",
            "whatsapp.regex" => "Le format du numéro WhatsApp n'est pas valide. Utilisez le format +XXX XXXXXXXXXX.",
            "cv.required" => "Veuillez télécharger votre cv",
            "cv.file" => "Le CV doit être un fichier valide.",
            "cv.mimes" => "Le CV doit être au format PDF, DOC ou DOCX.",
            "cv.max" => "La taille du CV ne doit pas dépasser 5 Mo.",
        ]);

        $postulant = New Postulant();
        $postulant->prenom = $request->prenom;
        $postulant->nom = $request->nom;
        $postulant->email = $request->email;
        $postulant->pays_id = $request->pays;
        $postulant->recrutement_id = $request->offre;
        $postulant->ville = $request->ville;
        $postulant->phone = $request->phone;
        $postulant->whatsapp = $request->whatsapp;
        $postulant->cv  = $request->file('cv')->store('cv_list', "public");
        $postulant->save();

        return redirect("/")->with('success', 'Votre candidature a été soumise avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Postulant $postulant)
    {   
        $postulant->load("offre");
        // dd($postulant);
        return view("postulant", ["postulant" => $postulant]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Postulant $postulant)
    {
        $postulant->delete();
        return redirect("/dashboard")->with("supression", $postulant->prenom." à été supprimé");
    }
}
