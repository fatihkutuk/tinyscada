<footer class="main-footer">
  <strong>Copyright &copy; 2021-2022 <a href="https://tinyscada.com">KoruYazılım</a>.</strong>
  Tüm Hakları Saklıdır.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0.0
  </div>
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>

<script src="<?= PLUGIN_PATH; ?>/jquery/jquery.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?= PLUGIN_PATH; ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/chart.js/Chart.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/sparklines/sparkline.js"></script>
<script src="<?= PLUGIN_PATH; ?>/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?= PLUGIN_PATH; ?>/jquery-knob/jquery.knob.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/moment/moment.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/daterangepicker/daterangepicker.js"></script>
<script src="<?= PLUGIN_PATH; ?>/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/summernote/summernote-bs4.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= DIST_PATH; ?>/js/adminlte.js"></script>
<script src="<?= DIST_PATH; ?>/js/pages/dashboard.js"></script>
<script src="<?= PLUGIN_PATH; ?>/datatables/jquery.dataTables.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/jszip/jszip.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/pdfmake/pdfmake.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/pdfmake/vfs_fonts.js"></script>
<script src="<?= PLUGIN_PATH; ?>/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= PLUGIN_PATH; ?>/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= DIST_PATH; ?>/js/demo.js"></script>

<script>
if(window.location=="<?=SITE_URL;?>/"){
  $(".main").attr("class","nav-link active")

}
var nodes = <?=json_encode($params['serinolist']);?>;


</script>
<script src="<?= DIST_PATH; ?>/js/tinyscada.js"></script>
<?= helper::flashToastrView("toastr") ?>

</body>

</html>
