<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Listado de Usuarios</h2>

    <div class="d-flex gap-2">

        <span class="align-self-center">
            Bienvenido, <strong><?= session()->get('nombre') ?></strong>
        </span>

        <a href="/auth/logout" class="btn btn-danger">
            Cerrar sesión
        </a>

        <a href="/users/create" class="btn btn-success">
            + Crear nuevo usuario
        </a>

    </div>
</div>

<div class="card shadow">
    <div class="card-body">

        <h1>Bienvenido a tu zona.</h1>
        <div class="table-responsive">
            <table id="usersTable" class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cuenta</th>
                        <th>Rol</th>
                        <th>Contraseña Hasheada</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['id'] ?></td>
                            <td><?= esc($usuario['nombre']) ?></td>
                            <td><?= esc($usuario['cuenta_usuario']) ?></td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    <?= esc($usuario['role_id']) ?>
                                </span>
                            </td>
                            <td>
                                <p><?= $usuario['contrasenia'] ?></p>
                            </td>
                            <td class="text-center">
                                <a href="/users/edit/<?= $usuario['id'] ?>"
                                    class="btn btn-sm btn-primary">
                                    Editar
                                </a>

                                <a href="/users/delete/<?= $usuario['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script src="/js/loadIndexTable.js"></script>
<?= $this->endSection() ?>