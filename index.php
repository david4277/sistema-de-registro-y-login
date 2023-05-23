<?php
require_once __DIR__ . '/helpers/auth.php';
require_once __DIR__ . '/config/database.php';

if (!is_logged_in()) {
    header('location: login.php');
}

$connection = connect_database();

// Obtener informacion del usuario
$stmt = $connection->prepare('SELECT name, email FROM users WHERE user_id=:user_id');

$stmt->bindValue('user_id', $_SESSION['user_id']);

$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$title = 'Inicio';
include_once __DIR__ . '/includes/header.php';
?>

<div class="col-12 col-md-6">

    <div class="card">
        <div class="card-header">
            <h1 class="h1 mb-0">Bienvenido <?= $user['name']; ?></h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>nombre</th>
                        <th>email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
include_once __DIR__ . '/includes/footer.php';
?>