<?php echo $this->extend("plantilla/layout") ?>

<?php echo $this->section("content") ?>
<h1>Productos</h1>
<hr>
<table>
    <thead>
        <th style="width:40%">Nombre</th>
        <th style="width:50%">Descripción</th>
        <th>Precio</th>
    </thead>
    <tbody>
        <tr>
            <td style="text-align:left">Prosche 911 GT3 RS</td>
            <td style="text-align:left">Superdeportivo de alto rendimiento</td>
            <td style="text-align:left">$231,000</td>
        </tr>
    </tbody>
</table>
<?php echo $this->endSection() ?>