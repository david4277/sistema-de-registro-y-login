<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de registro y login | <?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body class="bg-body-secondary">
    <header class="bg-white">
        <nav class="navbar navbar-expand-lg">
            <div class="container-md">
                <a class="navbar-brand" href="/">Sistema de registro y login</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if (is_logged_in()) : ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="logout.php">Cerrar sesion</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link<?= $page_active === 'login' ? ' active' : ''; ?>" aria-current="page" href="login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= $page_active === 'register' ? ' active' : ''; ?>" href="register.php">Registrarse</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-md">
        <div class="row justify-content-center">