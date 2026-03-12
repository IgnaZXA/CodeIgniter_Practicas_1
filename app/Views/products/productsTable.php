<?= $this->extend('layout') ?>
<?= $this->section('content') ?>


<div class="d-flex mb-4">
    <div class="d-flex gap-2">
        <a href="/products/create" class='btn btn-sm btn-success'>+ Crear un producto</a>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <h1>Productos disponibles.</h1>
        <div class="table-responsive">
            <table id="productsTable" class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Existencias</th>
                        <th>Categoría</th>
                        <th id='actionColumn' class="text-center">Acciones</th>
                    </tr>

                    <tr>
                        <th><input class="filterInput" name="id"    type="text" placeholder="Buscar por ID"></th>
                        <th><input class="filterInput" name="name"  type="text" placeholder="Buscar por nombre"></th>
                        <th><input class="filterInput" name="price" type="text" placeholder="Buscar por precio"></th>
                        <th><input class="filterInput" name="stock" type="text" placeholder="Buscar por existencias"></th>
                        <th>
                            <select id="category_filter" name="category_id" class="form-control">
                                <option value="" disabled selected>Selecciona una categoría</option> <!-- PLACEHOLDER --->
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
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>const userRole = parseInt("<?= session()->get('role_id') ?>");</script>
    <script src='/js/loadProductsTable.js'></script>
<?= $this->endSection() ?>