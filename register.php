<?php
session_start();
require_once __DIR__ . '/config/database.php';
$connection = connect_database();

$name = '';
$email = '';
$password = '';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = ucfirst(strtolower(trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS))));
    $email = filter_input(INPUT_POST,'email', FILTER_SANITIZE_EMAIL);
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    if ($name === '') {
        $errors['name'] = 'Ingrese un nombre';
    }elseif (!preg_match('/^[A-Z][a-z]+(\s[A-Z][a-z]+)*$/', $name)) {
        $errors['name'] = 'El nombre no es valido';
    }

    if ($email === '') {
        $errors['email'] = 'Ingrese un email';
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'El email no es valido';
    }else{

        $stmt = $connection->prepare('SELECT email FROM users WHERE email=:email');

        $stmt->bindValue('email', $email);

        $stmt->execute();

        if ($stmt->rowCount()) {
            $errors['email'] = 'El email ya esta registrado';
        }

    }

    if ($password === '') {
        $errors['password'] = 'Ingrese una contraseña';
    }elseif (strlen($password) < 8) {
        $errors['password'] = 'La contraseña debe contener al menos 8 caracteres';
    }

    if (count($errors) < 1) {

        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $connection->prepare('INSERT INTO users (name,email,password) VALUES (:name,:email,:password)');

        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);

        if ($stmt->execute()) {
            $_SESSION['message'] = [
                'type' => 'success',
                'content' => 'Registro completado con exito'
            ];
            header('location: login.php');
        }

    }

}


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
                    <input 
                    type="name" 
                    name="name" 
                    placeholder="Ingrese un nombre" 
                    class="form-control<?= isset($errors['name']) ? ' is-invalid' : '' ?>" 
                    id="name"
                    value="<?= $name; ?>">
                    <?php if(isset($errors['name'])) : ?>
                        <div class="invalid-feedback"><?= $errors['name']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                    type="email" 
                    name="email" 
                    placeholder="Ingrese un email" 
                    class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>" 
                    id="email"
                    value="<?= $email; ?>">
                    <?php if(isset($errors['email'])) : ?>
                        <div class="invalid-feedback"><?= $errors['email']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input 
                    type="password" 
                    name="password" 
                    placeholder="Ingrese una contraseña" 
                    class="form-control<?= isset($errors['password']) ? ' is-invalid' : '' ?>" 
                    id="password">
                    <?php if(isset($errors['password'])) : ?>
                        <div class="invalid-feedback"><?= $errors['password']; ?></div>
                    <?php endif; ?>
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