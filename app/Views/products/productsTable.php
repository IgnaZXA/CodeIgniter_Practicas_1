<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div>
    <h1>Productos disponibles.</h1>
</div>

<div class="table-responsive">
    <table id="usersTable" class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th id='actionColumn' class="text-center">Acciones</th>
            </tr>

            <tr>
                <th><input class="filterInput" type="text" placeholder="Buscar ID"></th>
                <th><input class="filterInput" type="text" placeholder="Buscar nombre"></th>
                <th>
                    <select id="category_filter" name="category_id" class="form-control">
                        <option value="" disabled selected>Selecciona una categoria</option> <!-- PLACEHOLDER --->
                        <option value="">Todas la categorias</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= esc($category['category_name']) ?>">
                                <?= esc($category['category_name']) ?>
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

<?= $this->endSection() ?>