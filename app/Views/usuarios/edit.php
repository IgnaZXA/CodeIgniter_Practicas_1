<h1>Editar Usuario</h1>

<form action="/users/update/<?= $usuario['id'] ?>" method="post">
    
    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= esc($usuario['nombre']) ?>"><br><br>

    <label>Cuenta Usuario:</label><br>
    <input type="text" name="cuenta_usuario" value="<?= esc($usuario['cuenta_usuario']) ?>"><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="contrasenia"><br>
    <small>Déjala vacía si no quieres cambiarla</small><br><br>

    <label>Rol ID:</label><br>
    <input type="number" name="role_id" value="<?= esc($usuario['role_id']) ?>"><br><br>

    <label>Activo:</label>
    <input type="checkbox" name="status" value="1" <?= esc($usuario['status']) ? 'checked' : '' ?>><br><br>

    <button type="submit">Actualizar</button>

</form>