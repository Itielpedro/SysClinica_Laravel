<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Group</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo-med.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @yield('scripts')
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="nav-link" href="{{route('home')}}"><img src="{{ asset('images/logo-med.png') }}" alt="Sua Logo" style="width: 50px; height: 50px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home')}}">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('especialidades.index')}}">Especialidades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('medicos.index')}}">Médicos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('pacientes.index')}}">Pacientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('funcionarios.index')}}">Funcionários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('procedimentos.index')}}">Procedimentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('agendamentos.index')}}">Agendamentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('consultas.index')}}">Consultas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('prontuarios.index')}}">Prontuários</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-5">
                        @auth
                        <li class="nav-item mr-3">
                            <a class="nav-link btn btn-sm btn-outline-primary text-light" href="{{ route('profile.show') }}"><i class="fa-solid fa-user-pen"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger nav-link text-light"><i class="fa-solid fa-right-from-bracket"></i></button>
                            </form>
                        </li>
                        @endauth
                    </ul>

                </div>
            </div>
        </nav>

    </header>

    <main class="container mt-4">
        @yield('content')
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
