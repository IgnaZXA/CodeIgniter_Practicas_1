<h1>Listado de Usuarios</h1>

<a href="/users/create">Crear nuevo usuario</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Cuenta</th>
        <th>Rol</th>
        <th>Contraseña</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= $usuario['id'] ?></td>
            <td><?= esc($usuario['nombre']) ?></td>
            <td><?= esc($usuario['cuenta_usuario']) ?></td>
            <td><?= esc($usuario['role_id']) ?></td>
            <td><?= esc($usuario['contrasenia']) ?></td>
            <td>
                <a href="/users/edit/<?= $usuario['id'] ?>">Editar</a>
                <a href="/users/delete/<?= $usuario['id'] ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>