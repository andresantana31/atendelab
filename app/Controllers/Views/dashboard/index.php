<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - AtendLab</title>

    <link href="https://cdn.jsdelivr.net/npm;bostrap@5.3.3/dist/css/boostrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">AtendLab</span>

        <a class="btn btn-outline-light btn-sm"
            href="?controller=auth&action=logout">
            Sair
        </a>
    </div>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card=body">
            <h1 class="h4">Area restrita</h1>

            <p class="mb-1">
                Bem-vindo,
                <strong>
                    <?= htmlspecialchars{
                        $usuario['nome'],
                        ENT_QUOTES,
                        'UTF-8'
                    }?>
                </strong>
            </p>
            <p class="text-muted">
                Perfil:
                    <?= htmlspecialchars{
                        $usuario['nome'],
                        ENT_QUOTES,
                        'UTF-8'
                    }?>
            </p>

            <a class="btn btn-primary"
            href="?controller=usuario&action=listar">
                Testar rota protegida de usuarios
            </a>
        </div>
    </div>
</div>
</nav>
</body>
</html>