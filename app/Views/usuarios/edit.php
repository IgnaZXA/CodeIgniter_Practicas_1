<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Editar Usuario</h4>
            </div>

            <div class="card-body">
                <form action="/users/update/<?= $usuario['id'] ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text"
                               class="form-control"
                               name="nombre"
                               value="<?= esc($usuario['nombre']) ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cuenta Usuario</label>
                        <input type="text"
                               class="form-control"
                               name="cuenta_usuario"
                               value="<?= esc($usuario['cuenta_usuario']) ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password"
                               class="form-control"
                               name="contrasenia">
                        <div class="form-text">
                            Déjala vacía si no quieres cambiarla
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rol ID</label>
                        <input type="number"
                               class="form-control"
                               name="role_id"
                               value="<?= esc($usuario['role_id']) ?>"
                               required>
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox"
                               class="form-check-input"
                               id="status"
                               name="status"
                               value="1"
                               <?= esc($usuario['status']) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="status">
                            Activo
                        </label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/users" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Actualizar
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>