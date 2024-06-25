@extends("layouts.app")

@section("content")

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Détails du postulant</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nom :</strong> {{ $postulant->nom }}</p>
                        <p><strong>Prénom :</strong> {{ $postulant->prenom }}</p>
                        <p><strong>Email :</strong> {{ $postulant->email }}</p>
                        <p><strong>Candidature à l'offre  :</strong> {{ $postulant->offre->libelle }}</p>
                        
                        <p><strong>Date de candidature :</strong> {{ $postulant->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>CV :</strong> <a href="{{ asset('storage/' . $postulant->cv) }}" target="_blank" class="btn btn-outline-primary">Voir le CV</a></p>
                        {{-- <p><strong>Lettre de motivation :</strong> <a href="{{ asset('storage/' . $postulant->lettre_motivation_path) }}" target="_blank" class="btn btn-outline-primary">Voir la lettre de motivation</a></p> --}}
                    </div>
                </div>
                <div class="mt-4">
                    <h4>Informations supplémentaires</h4>
                    <p>{{ $postulant->informations_supplementaires }}</p>
                </div>
                <div class="mt-4 d-flex justify-coontent-start">

                    <a href="{{ route('postulants.index') }}" class="btn btn-outline-secondary">Retour à la liste</a>
                    <form method="POST" action="{{route("postulants.destroy", $postulant->id)}}">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-outline-danger ms-2">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
</html>

@endsection