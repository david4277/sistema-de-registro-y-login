<?php
require_once __DIR__ . '/helpers/auth.php';
require_once __DIR__ . '/config/database.php';

/**
 * Verificar si el usuario esta logeado
 */
if (is_logged_in()) {
    header('location: /');
}

/**
 * Conectarse a la base de datos
 */
$connection = connect_database();

$email = '';
$password = '';

$errors = [];

/**
 * Comprobar si se envio el formulario
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Filtra y guarda los datos enviados por el usuario
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    // Validar los datos enviados por el usuario
    if ($email === '') {
        $errors['email'] = 'Ingrese un email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'El email no es valido';
    }

    if ($password === '') {
        $errors['password'] = 'Ingrese una contraseña';
    }

    // Comprobar si no hay errores y continuar con la autenticacion
    if (count($errors) < 1) {
        // Comprobar que el email exista
        $stmt = $connection->prepare('SELECT * FROM users WHERE email=:email');

        $stmt->bindValue('email', $email);

        $stmt->execute();

        // verificar la contraseña si el usuario existe
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            if (password_verify($password, $user['password'])) {
                // logear al usuario
                login($user['user_id']);
                header('location: /');
            } else {
                error_login();
            }
        } else {
            error_login();
        }
    }
}

$title = 'Iniciar sesion';
$page_active = 'login';
include_once __DIR__ . '/includes/header.php';
?>
<div class="col-12 col-md-6 col-xl-4">
    <!-- Comprobar si hay un mensaje de alerta -->
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['message']['type']; ?> alert-dismissible" role="alert">
            <?= $_SESSION['message']['content']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif;
    unset($_SESSION['message']); ?>
    <!-- Comprobar si hay un mensaje de alerta -->
    <div class="card">
        <div class="card-header">
            <h1 class="h1 mb-0 text-center">Iniciar Sesion</h1>
        </div>
        <div class="card-body">
            <form action="login.php" method="post" id="form-login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" placeholder="Ingrese su email" class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>" id="email" value="<?= $email; ?>">
                    <?php if (isset($errors['email'])) : ?>
                        <div class="invalid-feedback"><?= $errors['email']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" placeholder="Ingrese su contraseña" class="form-control<?= isset($errors['password']) ? ' is-invalid' : '' ?>" id="password">
                    <?php if (isset($errors['password'])) : ?>
                        <div class="invalid-feedback"><?= $errors['password']; ?></div>
                    <?php endif; ?>
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