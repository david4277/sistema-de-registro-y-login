<?php
require_once __DIR__ . '/config/database.php';
$connection = connect_database();
$title = 'Registrarse';
include_once __DIR__ . '/includes/header.php';
?>
<div class="col-12 col-md-6 col-xl-4">
    <div class="card">
        <div class="card-header">
            <h1 class="h1 mb-0 text-center">Crear Cuenta</h1>
        </div>
        <div class="card-body">
            <form action="register.php" method="post" id="form-register">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="name" name="name" placeholder="Ingrese un nombre" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" placeholder="Ingrese un email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" placeholder="Ingrese una contraseña" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Crear cuenta</button>
            </form>
        </div>
        <div class="card-footer">
            <a href="login.php" class="link-primary text-decoration-none">¿Ya tienes cuenta? Inicia sesion</a>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/includes/footer.php';
?>