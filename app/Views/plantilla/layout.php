<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App used to Learn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

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

<?php echo $this->include("plantilla/menu"); ?>

<body>

    <?php echo $this->renderSection("content"); ?>

   <div
style="height: 60px; background-color: #f5f5f5; text-align: center; padding-top: 20px; position: relative; bottom: 0; width: 100%;">
    <footer class="footer">
        <p><?php echo date('Y'); ?></p>
    </footer>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>