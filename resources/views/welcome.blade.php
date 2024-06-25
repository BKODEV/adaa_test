<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de candidature</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 2rem;
        }
        .form-label {
            font-weight: 600;
        }
        .btn-submit {
            background-color: #007bff;
            border: none;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="{{asset("image/logo_adaa.png")}}" alt="Logo" width="30" height="30" class="d-inline-block align-top">
                Adaa form
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="">Accueil</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="btn btn-light" href="{{ route('register') }}">Inscription</a>
                        </li> --}}
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="mb-3"><i class="fas fa-briefcase me-2"></i>Postuler à nos offres d'emploi</h2>
                        <p class="mb-0">Bienvenue sur notre plateforme de carrière. Nous sommes ravis de vous offrir la possibilité de rejoindre notre équipe.</p>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="apply" method="post" enctype="multipart/form-data" id="candidatureForm">
                            @csrf
                            <div class="mn-3">
                                <label for="offre" class="form-label">A quelle offre vous postulez?</label>
                                <select class="form-select" aria-label="Selectionner l'offre à laquelle vous postulez" name="offre" id="offre" required {{ old('offre') }}>
                                    <option value="">Selectionner l'offre à laquelle vous postulez</option>
                                    @foreach ($offres as $offre)
                                    <option value="{{$offre->id}}">{{$offre->libelle}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input class="form-control" id="prenom" type="text" name="prenom" placeholder="Ex : Jean Pierre" required {{ old('prenom') }}>
                                </div>
                                <div class="col-md-6">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input class="form-control" id="nom" type="text" name="nom" placeholder="Ex : Kouassi" required value="Kouassi" {{ old('nom') }}>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required value="name@example.com" {{ old('email') }}>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="pays" class="form-label">Pays</label>
                                    <select class="form-select" aria-label="Selection de pays" name="pays" id="pays"  value="1"{{ old('pays') }}>
                                        <option value="">Sélectionnez votre pays</option>
                                        @foreach ($pays as $country)
                                            <option value="{{$country->id}}">{{$country->libelle}}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ville" class="form-label">Ville</label>
                                    <input type="text" class="form-control" id="ville" name="ville" placeholder="Ex : Abidjan" required value="Abidjan" {{ old('ville') }}>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Numéro de téléphone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Ex : +225 01 02 03 04 04" value="+2250102030404" {{ old('phone') }}>
                                </div>
                                <div class="col-md-6">
                                    <label for="whatsapp" class="form-label">Numéro WhatsApp</label>
                                    <input type="tel" class="form-control" id="whatsapp" name="whatsapp" placeholder="Ex : +225 01 02 03 04 04" value="+2250102030404" {{ old('whatsapp') }}>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="cv" class="form-label">Votre CV</label>
                                <input class="form-control" type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required value="" {{ old('cv') }}>
                                <div class="form-text">Formats acceptés : PDF, DOC, DOCX. Taille max : 5 Mo</div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-submit"><i class="fas fa-paper-plane me-2"></i>Soumettre ma candidature</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Vérifiez si un message de succès est présent
        if (document.querySelector('.alert-success')) {
            // Réinitialiser le formulaire
            document.getElementById('candidatureForm').reset();
    
            // Supprimez les anciennes valeurs de la session
            @php
                session()->forget('_old_input');
            @endphp
        }
    </script>
</body>
</html>
