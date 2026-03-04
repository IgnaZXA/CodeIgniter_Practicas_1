<?= $this->extend('layout') ?>
<?= $this->section('content') ?>


<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-center">Iniciar Sesión</h4>
            </div>

            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>


                <form action="/auth/login" method="post">

                    <div class="mb-3">
                        <label class="form-label">Cuenta Usuario</label>
                        <input type="text"
                            name="cuenta_usuario"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password"
                            name="contrasenia"
                            class="form-control"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Entrar
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
