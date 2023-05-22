<?php
$title = 'Iniciar sesion';
include_once __DIR__ . '/includes/header.php';
?>
<div class="col-12 col-md-6 col-xl-4">
    <div class="card">
        <div class="card-header">
            <h1 class="h1 mb-0 text-center">Iniciar Sesion</h1>
        </div>
        <div class="card-body">
            <form action="login.php" method="post" id="form-login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" placeholder="Ingrese su email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" placeholder="Ingrese su contraseña" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Iniciar sesion</button>
            </form>
        </div>
        <div class="card-footer">
            <a href="register.php" class="link-primary text-decoration-none">¿No tienes cuenta? Crea una</a>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/includes/footer.php';
?>