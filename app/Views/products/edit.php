<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <?= view('errors/validation_error') ?>


        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Editar Producto</h4>
            </div>

            <div class="card-body">
                <form action="/products/update/<?= $product['id'] ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            value="<?= esc(old("name", $product['name'])) ?>"
                            required>
                        </div>

                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number"
                            class="form-control"
                            name="price"
                            value="<?= esc(old("price", $product['price'])) ?>"
                            required>
                        </div>

                    <div class="mb-3">
                        <label class="form-label">Existancias</label>
                        <input type="number"
                            class="form-control"
                            name="stock"
                            value=<?= esc(old("stock", $product['stock'])) ?>
                            >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select name="category_id" class="form-control">
                            <option value="" disabled selected>Selecciona una categoría</option> <!-- PLACEHOLDER --->
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= $product['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                    <?= esc($category['category_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/product" class="btn btn-secondary">
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