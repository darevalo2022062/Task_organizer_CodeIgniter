<?php echo $this->extend("plantilla/layout") ?>

<?php echo $this->section("content") ?>
<style>
    body {
        padding-top: 5rem;
        padding-bottom: 3rem;
        background-color: #f5f5f5
    }

    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px;
        line-height: 60px;
        background-color: #f5f5f5
    }

    .container {
        max-width: 960px
    }

    .container .text-muted {
        margin: 20px 0
    }
</style>
<div class="container" style="
    padding: 20px;
    background-color: white;
    border-radius: 5px;
">
    <h1>Productos</h1>
    <hr>
    <table>
        <thead style="border-bottom: 2px solid #000;">
            <th style="text-align: center; width: 15%;">ID</th>
            <th style="text-align: center; width: 90%;">Nombre Producto</th>
            <th style="text-align: center; width: 15%;">Precio GTQ</th>
        </thead>
        <tbody>

            <?php foreach ($productos as $producto): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="text-align:center; color: rgba(255, 0, 0, 0.5); font-weight: bold;">
                        <?php echo $producto->id_producto; ?>
                    </td>
                    <td style="text-align:center"><?php echo $producto->nombre_producto; ?></td>
                    <td style="text-align:center"><?php echo $producto->precio_producto; ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<div
    style="max-width: 100%; margin-top: 20px; padding: 20px; background-color: white; border-radius: 5px; align-items: center; justify-content: space-between;">
    <br>
    <div>
        <h4>Buscar Producto</h4>
        <input style="width: 25%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" type="number"
            placeholder="Buscar producto por ID">
        <button
            style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Buscar</button>
    </div>
</div>

<?php echo $this->endSection() ?>