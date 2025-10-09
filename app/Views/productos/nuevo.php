<?php echo $this->extend("plantilla/layout") ?>

<?php echo $this->section("content") ?>
<h1>Nuevo Producto</h1>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Nuevo Producto</h5>
                </div>
                <div class="card-body">
                    <?php echo validation_list_errors(); ?>
                    <form action="<?= base_url('productos/guarda') ?>" method="post" autocomplete="off">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control"
                                placeholder="Ingrese el nombre del producto" required
                                value="<?= set_value('nombre') ?>">
                            <?php echo validation_show_error('nombre') ?>
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" id="precio" name="precio" class="form-control"
                                placeholder="Ingrese el precio del producto" step="0.01" required
                                value="<?= set_value('precio') ?>">
                            <?php echo validation_show_error('precio') ?>

                        </div>

                        <div class="mb-3">
                            <label for="tienda" class="form-label">Tienda</label>
                            <input type="number" id="tienda" name="tienda" class="form-control"
                                placeholder="Ingrese el ID de la tienda" required value="<?= set_value('tienda', 1) ?>">
                            <?php echo validation_show_error('tienda') ?>

                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-save me-1"></i> Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php echo $this->endSection() ?>