
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
					<h1>Data Siswa SMA Negeri 1 Rambatan</h1>
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
					<a href="#">Data</a>
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
								<i class="fa fa-globe"></i>Data Siswa
							</div>
							<div class="tools">
							</div>
                        </div>
                        
						<div class="portlet-body">
                            
                            <a href="#" class="btn btn-success btn-sm tambah-tarif"><i class="fa fa-plus"></i>Tambah Siswa</a>
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
									 Status Akun
								</th>
								<th style="width: 120px;">
									 Action
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$no=1; 
							foreach ($siswa as$value):?>
                               <tr>
                                   <td><?=$no++?></td>
                                   <td><?=$value['nama_siswa']?></td>
                                   <td><?=$value['nisn']?></td>
                                   <td>
                                       <a href="#" class="label label-danger"><i class="fa fa-ban"></i>Tidak Aktif</a>
                                       <a href="#" class="label label-success"><i class="fa fa-check"></i>Aktif</a>
                                   </td>
                                   <td>
                                   <a href="#" data="<?=base_url();?>admin/crud_siswa/hapus/<?=$value['id_siswa']?>" class="btn btn-danger btn-sm modal-hapus" ><i class="fa fa-trash"></i></a>
                                   <a href="#" data="" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                   <a href="#" data="" class="btn btn-info btn-sm "><i class="fa fa-search"></i></a>
                                   </td>
                               </tr>
							<?php endforeach;?>
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
<div class="modal fade" id="tambah_tarif" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?=base_url();?>admin/simpan_data_siswa" enctype="multipart/form-data" method="post">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                 <label for="">NISN</label>
                 <input type="text" name="nisn" required id="nisn" class="form-control" placeholder="NISN" aria-describedby="helpId">
                 <small id="helpId" class="text-muted"></small>
               </div>
               <div class="form-group">
                 <label for="">Nama Siswa</label>
                <input type="text" name="nama_siswa" class="form-control" id="nama_siswa" required placeholder="Nama Siswa">
               </div>
               <div class="form-group">
                 <label for="">Tanggal Lahir</label>
                 <input type="text" name="tanggal_lahir" required id="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" aria-describedby="helpId">
                 <small id="helpId" class="text-muted"></small>
               </div>
               <div class="form-group">
                <label for="">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" required id="tempat_lahir" class="form-control" placeholder="Tempat Lahir" aria-describedby="helpId">
                <small id="helpId" class="text-muted"></small>
              </div>
              <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" id="laki" value="L" >
                    Laki-Laki
                    <input type="radio" class="form-check-input" name="jenis_kelamin" id="perempuan" value="P" >
                    Perempuan
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="">Alamat</label>
              <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3" required></textarea>
                <small id="helpId" class="text-muted"></small>
              </div>
              <div class="form-group">
                <label for="">Kelas</label>
              <select name="id_kelas" class="form-control"  id="id_kelas">
				  <option value="">Pilih Kelas</option>
				  <?php foreach ($kelas as  $value):?>
				  <option value="<?=$value['id_kelas']?>"><?=$value['nama_kelas']?></option>
				  <?php endforeach; ?>
              </select>
                <small id="helpId" class="text-muted"></small>
              </div>
              <div class="form-group">
                <label for="">Golongan Sumbangan Rutin</label>
                <select name="id_golongan" class="form-control"  id="id_golongan">
					<option value="">Pilih Golongan</option>
				  <?php foreach ($golongan as  $value):?>
				  <option value="<?=$value['id_tarif']?>"><?=$value['golongan_komite']?></option>
				  <?php endforeach; ?>
                </select>
                <small id="helpId" class="text-muted"></small>
              </div>
              <!-- kshusus upload -->
              <div class="form-group">
                <label for="">Foto Siswa</label>
                <input type="file" class="form-control" name="foto_diri" id="foto_diri">
                <small id="helpId" class="text-muted"></small>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>

<?php $this->load->view('admin/modal_hapus');
 ?>