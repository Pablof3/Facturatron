</div>
    </main>
    <script src="<?= RUTA_URL;?>/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/Chart.bundle.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/chartjs-plugin-datalabels.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/moment.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/fullcalendar.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/datatables.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/perfect-scrollbar.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/owl.carousel.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/progressbar.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/jquery.barrating.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/select2.full.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/nouislider.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/bootstrap-datepicker.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/Sortable.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/mousetrap.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/dore.script.js"></script>
    <script src="<?= RUTA_URL;?>/js/scripts.js"></script>
<?php if(isset($libs)): ?>
<?php foreach ($libs as $lib): ?>
    <script src="<?=RUTA_URL?>/js/Facturatron/<?=$lib?>.js"></script>
<?php endforeach; ?>
<?php endif;?>
    </body>
</html>