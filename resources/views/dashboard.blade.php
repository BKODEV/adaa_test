@extends("layouts.app")

@section("content")

<div class="container">
    <h1 class="mb-4">Liste des postulants</h1>
    <h6>Nombre de postulant : {{$postulants->count()}}</h6>

    @if (session("supression"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('supression') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Offre</th>
                            <th>Date de candidature</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        

                        @foreach ($postulants as $postulant)
                            <tr>
                                <td>{{ $postulant->nom }}</td>
                                <td>{{ $postulant->prenom }}</td>
                                <td>{{ $postulant->email }}</td>
                                <td>{{ $postulant->offre->libelle }}</td>
                                <td>{{ $postulant->created_at->format('d/m/Y H:i') }}</td>
                                {{-- <td>
                                    <a class="btn btn-outline-success" href="{{route("postulants.show", $postulant->id)}}" >voir</a>
                                    <a class="btn btn-outline-danger">Supprimer</a>
                                
                                </td> --}}
                                <td>
                                    <div class="d-flex justify-coontent-center">

                                        <a class="btn btn-outline-success" href="{{route("postulants.show", $postulant->id)}}" >voir</a>
                                        <form method="POST" action="{{route("postulants.destroy", $postulant->id)}}">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-outline-danger ms-2">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>            
            </div>
            {{-- {{ $postulants->links() }} --}}
        </div>
    </div>

    <h3 class="mt-4 mb-4">Nombre de postulant par Offre</h3>
    <div class="card">
        <div class="mt-3">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Libelle</th>
                            <th>Poste souhaité</th>
                            <th>Nombre de postulant</th>
                        </tr>
                    </thead>
                    <tbody>
                        

                        @foreach ($recrutements as $recrutement)
                            <tr>
                                <td>{{ $recrutement->libelle }}</td>
                                <td>{{ $recrutement->poste_disponible }}</td>
                                <td>{{ $recrutement->postulants->count() }}</td>
                                {{-- <td>
                                    <a class="btn btn-outline-success" href="{{route("postulants.show", $recrutement->id)}}" >voir</a>
                                    <a class="btn btn-outline-danger">Supprimer</a>
                                
                                </td> --}}
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>            
            </div>
        </div>

    </div>
</div>
@endsection