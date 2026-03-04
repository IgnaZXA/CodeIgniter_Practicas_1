<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Crear Usuario</h4>
            </div>

            <div class="card-body">
                <form action="/users/save" method="post">

                    <div class="mb-3">
                        <label class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cuenta Usuario:</label>
                        <input type="text" class="form-control" name="cuenta_usuario" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" name="contrasenia" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rol ID:</label>
                        <input type="number" class="form-control" name="role_id" required>
                    </div>


                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>
                        <label class="form-check-label" for="status">Activo</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/users" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-success">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>