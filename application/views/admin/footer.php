<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2019 &copy; SMA 1 NEGERI RAMBATAN.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?=base_url();?>asset/respond.min.js"></script>
<script src="<?=base_url();?>asset/excanvas.min.js"></script> 
<![endif]-->
<script src="<?=base_url();?>asset/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?=base_url();?>asset/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->


<!-- table -->
<script type="text/javascript" src="<?=base_url();?>asset/select2/select2.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url();?>asset/scripts/metronic.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/admin/pages/scripts/table-advanced.js"></script>
<script>
jQuery(document).ready(function() {    
    Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
   TableAdvanced.init();
});
</script>
<script>
    $('.tambah-tarif').click(function (e) { 
        $('#tambah_tarif').modal('show');
    });
</script>
</body>
<!-- END BODY -->
</html>