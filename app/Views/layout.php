<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mi App' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Datatables CSS--->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
</head>

<body>

    <div class="container-fluid mt-1 md-1">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    
    <!-- DataTables columnControl library files --->
    <script src="https://cdn.datatables.net/columncontrol/1.2.0/js/dataTables.columnControl.js"></script>
    <script src="https://cdn.datatables.net/columncontrol/1.2.0/js/columnControl.dataTables.js"></script>


    <!-- SECTION PARA SCRIPTS PROPIOS, dependientes de cada vista --->
    <?= $this->renderSection('scripts') ?>

</body>

</html>