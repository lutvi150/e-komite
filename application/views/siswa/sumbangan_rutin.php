
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>Data Sumbangan Rutin Anda</h1>
				</div>
			</div>
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="#">Siswa</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Sumbangan</a>
					<i class="fa fa-circle"></i>
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>Data Sumbangan
							</div>
							<div class="tools">
							</div>
                        </div>
                        
						<div class="portlet-body">
                            

                            <?php if ($this->session->userdata('error')):?>
						<div id="message_error" class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Maaf !</h4>
							<?php echo $this->session->userdata('error');?>
						</div>
						<?php elseif ($this->session->userdata('success')):?>
						<div id="message_success" class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Success !</h4>
							<?php echo $this->session->userdata('success');?>
						</div>
						<?php endif;?>
							<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
							<tr>
								<th style="width: 20px;">
									 No
								</th>
								<th>
									 Nama
								</th>
								<th>
									 NISN
								</th>
								<th>
									 Nama Kelas
								</th>
								<th>Jenis Sumbangan</th>
								<th>Total Sumbangan</th>
								<th>Status </th>
							</tr>
							</thead>
							<tbody>
						<?php if ($status_data=='0'):?>
							padmin<tr>
								<td colspan="20">Tidak Ada Data</td>
							</tr>
<?php elseif ($status_data=='1'):?>
	<?php $no=1; foreach ($sumbangan as $value):?>
<tr>
	<td><?=$no++?></td>
	<td><?=$value['nama_siswa']?></td>
	<td><?=$value['nisn']?></td>l
	<td><?=$value['nama_kelas']?></td>
	<td><?=$value['jenis_sumbangan']?></td>
	<td>Rp. <?=number_format($value['tarif_komite'])?> </td>
	<td>
		<?php  if ($value['status']=='-'):?>
			<a href="#" class="label label-danger"><i class="fa fa-ban"></i>Belum lunas</a>
				<a href="#" class="label label-success bayar-tagihan" data="<?=$value['id_sumbangan']?>"><i class="fa fa-money"></i>Bayar Tagihan</a>
			<?php elseif ($value['status']=='1'):?>
			<a href="#" class="label label-success"><i class="fa fa-check"></i>Lunas</a>
			<?php elseif($value['status']=='3'): ?>
				<a href="#" class="label label-warning"><i class="fa fa-warning"></i>Konfirmasi Admin</a>
				<a href="#" data="<?=$value['id_sumbangan']?>" class="label label-info bukti-bayar"><i class="fa fa-image"></i>Bukti Bayar</a>
			<?php endif; ?>
	</td>
</tr>
	<?php endforeach; ?>
<?php endif; ?>
                            </tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
    <!-- END CONTENT -->
</div>


<!-- Modal -->
<div class="modal fade" id="tambah_keseluruhan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="<?=base_url();?>admin/tambah_sumbangan_k/rutin" method="post">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Sumbangan Rutin</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
				  <label for="">Pilih Bulan</label>
				  <select name="bulan" class="form-control" id="bulan">
					<option value="">Pilih Bulan Tagihan</option>
					<option value="1">Januari</option>
					<option value="2">Februari</option>
					<option value="3">Maret</option>
					<option value="4">April</option>
					<option value="5">Mei</option>
					<option value="6">Juni</option>
					<option value="7">Juli</option>
					<option value="8">Agustus</option>
					<option value="9">September</option>
					<option value="10">Oktober</option>	
					<option value="11">November</option>
					<option value="12">Desember</option>
				</select>
				  <small id="helpId" class="text-muted">Pilih Bulan</small>
				</div>
				<div class="form-group">
				  <label for="">Pilih Tahun</label>
				  <select name="tahun" class="form-control" id="tahun">
					<option value="">Pilih Tahun Tagihan</option>
				<?php for ($i=2018; $i <2050 ; $i++):?>																<option value="<?=$i?>"><?=$i?></option>	
				<?php endfor; ?>
				</select>
				  <small id="helpId" class="text-muted">Pilih Tahun</small>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>


<?php $this->load->view('admin/modal_hapus');
 ?>



<!-- Modal -->
<div class="modal fade" id="bayar_tagihan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="<?=base_url();?>siswa/upload_bukti_bayar" enctype="multipart/form-data" method="post">
			<div class="modal-header">
				<h5 class="modal-title">Bayar Tagihan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id_sumbangan" id="id_sumbangan">
				<div class="form-group">
				  <label for="">Upload Bukti Bayar</label>
				  <input type="file" required name="bukti_bayar" id="bukti_bayar" onchange="loadFile(event)" class="form-control" placeholder="" aria-describedby="helpId">
				  <small id="helpId" class="text-muted">Upload Bukti Bayar</small>
				</div>
				<div class="text-center">
					<img class="image_upload" id="output" src="<?=base_url();?>asset/images/no-image-found-360x260.png" alt="">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>Tidak</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
			</div>
			</form>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_bukti_bayar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Bukti Bayar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				<div class="text-center" id="bukti_bayar_image">
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>