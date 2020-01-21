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
<script src="<?=base_url();?>asset/jquery.min.js"></script>
<script src="<?=base_url();?>asset/jquery-migrate.min.js"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?=base_url();?>asset/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url();?>asset/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>asset/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js">
</script>
<script src="<?=base_url();?>asset/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url();?>asset/jquery.blockui.min.js"></script>
<script src="<?=base_url();?>asset/jquery.cokie.min.js"></script>
<script src="<?=base_url();?>asset/uniform/jquery.uniform.min.js"></script>
<script src="<?=base_url();?>asset/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- END CORE PLUGINS -->


<!-- table -->
<script src="<?=base_url();?>asset/select2/select2.min.js"></script>
<script src="<?=base_url();?>asset/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>asset/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?=base_url();?>asset/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?=base_url();?>asset/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script src="<?=base_url();?>asset/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="<?=base_url();?>asset/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?=base_url();?>asset/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?=base_url();?>asset/clockface/js/clockface.js"></script>
<script src="<?=base_url();?>asset/bootstrap-daterangepicker/moment.min.js"></script>
<script src="<?=base_url();?>asset/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url();?>asset/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="<?=base_url();?>asset/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url();?>asset/scripts/metronic.js"></script>
<script src="<?=base_url();?>asset/admin/layout4/scripts/layout.js"></script>
<script src="<?=base_url();?>asset/admin/layout4/scripts/demo.js"></script>
<script src="<?=base_url();?>asset/admin/pages/scripts/table-advanced.js"></script>
<script src="<?=base_url();?>asset/admin/pages/scripts/components-pickers.js"></script>
<script>
	jQuery(document).ready(function () {
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		Demo.init(); // init demo features
		TableAdvanced.init();
		ComponentsPickers.init();
	});

</script>
<script>
	// bukti bayara
	$(".bukti-bayar").click(function (e) { 
		let id=$(this).attr('data');
		$.ajax({
			type: "GET",
			url: "<?=base_url();?>siswa/bukti_bayar",
			data: {"id":id},
			dataType: "JSON",
			success: function (response) {
				console.log(response);
				$("#bukti_bayar_image").html(`<img class="image_upload"  src="<?=base_url();?>`+response.bukti_bayar+`" alt="">`)
				$("#modal_bukti_bayar").modal("show");
			}
		});
	});
	$(".bayar-tagihan").click(function (e) { 
		let id=$(this).attr("data");
		$("#id_sumbangan").val(id);
		$("#bayar_tagihan").modal("show");
	});
	function loadFile(event) {
			var reader = new FileReader();
			reader.onload = function () {
				var output = document.getElementById('output');
				output.src = reader.result;
			};
			reader.readAsDataURL(event.target.files[0]);
		};
</script>
</body>
<!-- END BODY -->

</html>
