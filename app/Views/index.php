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
                        <th id='actionColumn' class="text-center">Acciones</th>
                    </tr>

                    <tr>
                        <th><input class="filterInput" type="text" placeholder="Buscar ID"></th>
                        <th><input class="filterInput" type="text" placeholder="Buscar nombre"></th>
                        <th><input class="filterInput" type="text" placeholder="Buscar cuenta"></th>
                        <th>
                            <select id="rol_filter" name="role_id" class="form-control">
                                <option value="" disabled selected>Selecciona un rol</option> <!-- PLACEHOLDER --->
                                <option value="">Todos los roles</option>
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?= esc($rol['rol']) ?>">
                                        <?= esc($rol['rol']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div>
          <a href="/prducts/" class="btn btn-success">
            + Crear nuevo usuario
        </a>  
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/js/loadIndexTable.js"></script>
<?= $this->endSection() ?>