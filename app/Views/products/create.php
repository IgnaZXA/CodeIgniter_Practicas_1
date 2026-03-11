<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php endif; ?>

        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Crear un Producto</h4>
            </div>

            <div class="card-body">
                <form action="/products/save" method="post">

                    <div class="mb-3">
                        <label class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="name" value="<?= esc(old("name")) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Precio:</label>
                        <input type="number" class="form-control" name="price" value="<?= esc(old("price")) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Existencias:</label>
                        <input type="numer" class="form-control" name="stock" value="<?= esc(old("stock")) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Categoría:</label>
                        <select name="category_id" class="form-control">
                            <option value="" disabled selected>Selecciona una categoría</option> <!-- PLACEHOLDER --->
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>">
                                    <?= esc($category['category_name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                    <div class="d-flex justify-content-between">
                        <a href="/products" class="btn btn-secondary">
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