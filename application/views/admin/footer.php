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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=base_url();?>asset/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/morris/morris.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url();?>asset/scripts/metronic.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/admin/pages/scripts/index3.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Demo.init(); // init demo features 
    Index.init(); // init index page
 Tasks.initDashboardWidget(); // init tash dashboard widget  
});
</script>
</body>
<!-- END BODY -->
</html>