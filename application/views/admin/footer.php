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
// nonaktifkan
$(".nonaktifkan-user").click(function (e) { 
	let id=$(this).attr("data");
	$('#judul_aktifkan').text('Konfirmasi');
	$('#isi_aktifkan').text('Yakin akan nonaktifkan user ini ? ');
	$('#form_aktifkan').attr('action',id);
	$('#aktifkan_user').modal('show');
});
// konfirmasi tagihan
$(".konfirmasi-tagihan").click(function (e) { 
	let id=$(this).attr("data");
	$("#id_sumbangan_konfirmasi").val(id);
	$("#modal_konfirmasi_tagihan").modal("show");
});
// alasan penolakan
$(".bukti-tolak").click(function (e) { 
	let id=$(this).attr("data");
	$.ajax({
		type: "GET",
		url: "<?=base_url();?>admin/bukti_bayar",
		data: {"id":id},
		dataType: "JSON",
		success: function (response) {
			console.log(id);
	$("#alasan").text(response.keterangan);
	$("#alasan_penolakan").modal("show");
		}
	});
});
// tolak tagihan
$(".tolak-tagihan").click(function (e) {
	let id=$(this).attr("data");
	$("#id_sumbangan").val(id); 
	$("#tolak_tagihan").modal("show");
});
// bukti bayara
$(".bukti-bayar").click(function (e) { 
		let id=$(this).attr('data');
		$.ajax({
			type: "GET",
			url: "<?=base_url();?>admin/bukti_bayar",
			data: {"id":id},
			dataType: "JSON",
			success: function (response) {
				console.log(response);
				$("#bukti_bayar_image").html(`<img class="image_upload"  src="<?=base_url();?>`+response.bukti_bayar+`" alt="">`)
				$("#modal_bukti_bayar").modal("show");
			}
		});
	});
// detail siswa
$(".detail-siswa").click(function (e) { 
	let id=$(this).attr("data");
	$.ajax({
		type: "GET",
		url: "<?=base_url();?>admin/data_siswa_json",
		data: {"id":id},
		dataType: "JSON",
		success: function (response) {
			console.log(response);
			
		}
	});
});
// edit siswa
$(".edit-siswa").click(function (e) { 
	let id=$(this).attr("data");
	$.ajax({
		type: "GET",
		url: "<?=base_url();?>admin/data_siswa_json",
		data: {"id":id},
		dataType: "JSON",
		success: function (response) {
			console.log(response);
			$("#form_siswa").attr("action","<?=base_url();?>admin/crud_siswa/edit/"+id);
			$("#isi_nisn").html(`<div class="form-group">
					<label for="">NISN</label>
					<input type="text" name="nisn" value="`+response.data_siswa.nisn+`" readonly required id="nisn" class="form-control" placeholder="NISN" aria-describedby="helpId">
					<small id="helpId" class="text-muted"></small>
				  </div>`)
			$("#nama_siswa").val(response.data_siswa.nama_siswa);
			$("#tanggal_lahir").val(response.data_siswa.tanggal_lahir);
			$("#tempat_lahir").val(response.data_siswa.tempat_lahir);
			$("#alamat").val(response.data_siswa.alamat);
			$("#no_hp").val(response.data_siswa.no_hp);

			$("#tambah_siswa").modal("show");
		}
	});
});
// konfirmasi bayar
$(".konfirmasi-bayar").click(function (e) { 
	let id=$(this).attr("data");
	$("#form_konfirmasi_bayar").attr("action",id);
	$("#bayar_konfirmasi").modal("show");
});
// cari data siswa
$("#nisn").keyup(function (e) { 
	let id=$(this).val();
	$.ajax({
		 type: "GET",
		 url: "<?=base_url();?>admin/data_siswa_json",
		 data: {"id":id},
		 dataType: "JSON",
		 success: function (response) {
			 console.log(response);
			 $("#nama").val(response.data_siswa.nama_siswa);
			 $("#golongan").val(response.tarif.golongan_komite);
			 $("#jumlah").val(response.tarif.tarif_komite);
		 }
	 });
});
// tambah persiswa
$(".tambah-sumbangan").click(function (e) { 
	$("#tambah_persiswa").modal("show");

});
// tambang sumbangan
	$('.cetak-laporan-rutin').click(function (e) { 
		$('#cetak_laporan').modal('show');
	});
	// tambah keseluruah
	$('.tambah-keseluruhan').click(function (e) { 
		$('#tambah_keseluruhan').modal('show');
	});
	// aktifkan user
	$('.aktifkan-user').click(function (e) { 
	let id=$(this).attr('data');
	$('#judul_aktifkan').text('Konfirmasi');
	$('#isi_aktifkan').text('Yakin akan aktifkan user ini ? Username User akan otomatis di buat berdasarkan NISN');
	$('#form_aktifkan').attr('action',id);
	$('#aktifkan_user').modal('show');
	});
// tambah siswa
$('.tambah-siswa').click(function (e) { 
	$("#form_siswa").attr('action','<?=base_url();?>admin/crud_siswa/simpan/i');
	$("#isi_nisn").html(`<div class="form-group">
					<label for="">NISN</label>
					<input type="text" name="nisn" value=""  required id="nisn" class="form-control" placeholder="NISN" aria-describedby="helpId">
					<small id="helpId" class="text-muted"></small>
				  </div>`)
	$("#nama_siswa").val("");
	$("#tanggal_lahir").val("");
	$("#tempat_lahir").val("");
	$("#alamat").val("");
	$("#no_hp").val("");
	$('#tambah_siswa').modal('show');
});
	$('#tanggal_lahir').datepicker
	({
		format:'dd-mm-yyyy'
	});
	// edit kelas
	$('.edit-kelas').click(function (e) {
		let id = $(this).attr('data');
		$.ajax({
			type: "GET",
			url: "<?=base_url();?>admin/detail_json/tb_kelas/id_kelas",
			data: {
				"id": id
			},
			dataType: "JSON",
			success: function (response) {
				console.log(response);
				$('#form_kelas').attr('action', "<?=base_url();?>admin/simpan_kelas/edit/"+id);
				$('#judul_kelas').text('Edit Kelas');
				$('#nama_kelas').val(response.nama_kelas);
				$('#data_kelas').modal('show');
			}
		});
	});
	// simpan kelas
	$('.tambah-kelas').click(function (e) {
		$('#form_kelas').attr('action', "<?=base_url();?>admin/simpan_kelas/simpan/i");
		$('#judul_kelas').text('Tambah Kelas');
		$('#nama_kelas').val('');
		$('#data_kelas').modal('show');
	});
	// edit tarif
	$('.edit-tarif').click(function (e) {
		let id = $(this).attr('data');
		$.ajax({
			type: "GET",
			url: "<?=base_url();?>admin/detail_tarif",
			data: {
				"id": id
			},
			dataType: "JSON",
			success: function (response) {
				console.log(response);
				$('#form_tarif').attr('action', "<?=base_url();?>admin/simpan_tarif_komite/edit/" +
					id);
				$('#judul_tarif').text('Edit Tarif');
				$('#golongan_komite').val(response.golongan_komite);
				$('#keterangan_komite').val(response.keterangan_komite);
				$('#tarif_komite').val(response.tarif_komite);
				$('#tambah_tarif').modal('show');
			}
		});
	});
	// konifirmasi hapus
	$('.modal-hapus').click(function (e) {
		let id = $(this).attr('data');
		$('#form_modal_hapus').attr('action', id);
		$('#modal_hapus').modal('show');
	});
	window.setTimeout(function () {
		$("#message_error").fadeTo(1000, 0).slideUp(500, function () {
			$(this).remove();
		});
	}, 6000);
	window.setTimeout(function () {
		$("#message_success").fadeTo(1000, 0).slideUp(500, function () {
			$(this).remove();
		});
	}, 6000);
	$('.tambah-tarif').click(function (e) {
		$('#form_tarif').attr('action', "<?=base_url();?>admin/simpan_tarif_komite/simpan/i");
		$('#judul_tarif').text('Tambah Tarif');
		$('#golongan_komite').val('');
		$('#keterangan_komite').val('');
		$('#tarif_komite').val('');
		$('#tambah_tarif').modal('show');
	});

</script>
</body>
<!-- END BODY -->

</html>
