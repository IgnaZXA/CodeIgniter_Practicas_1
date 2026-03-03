<h1>Crear Usuario</h1>

<form action="/users/save" method="post">
    
    <label>Nombre:</label><br>
    <input type="text" name="nombre"><br><br>

    <label>Cuenta Usuario:</label><br>
    <input type="text" name="cuenta_usuario"><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="contrasenia"><br><br>

    <label>Rol ID:</label><br>
    <input type="number" name="role_id"><br><br>

    <label>Activo:</label>
    <input type="checkbox" name="status" value="1" checked><br><br>

    <button type="submit">Guardar</button>

</form>