
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
					<h1>Data Keuangan SMA Negeri 1 Rambatan</h1>
				</div>
			</div>
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="#">Data</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Transaksi</a>
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
								<i class="fa fa-globe"></i>Data Keuangan
							</div>
							<div class="tools">
							</div>
                        </div>
                        
						<div class="portlet-body">
                            
                            <a href="#" class="btn btn-success btn-sm tambah-tarif"><i class="fa fa-plus"></i>Tambah Transaksi</a>
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
									 Tangggal 
								</th>
								<th>
									 Keterangan
								</th>
								<th>
									 Debit
								</th>
								<th>
									 Kredit
								</th>

								<th style="width: 80px;">
									 Action
								</th>
							</tr>
							</thead>
							<tbody>
                              
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
            <form id="form_tarif" action="<?=base_url();?>admin/simpan_tarif_komite" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="judul_tarif">Tambah Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
              
               <div class="form-group">
                 <label for="">Keterangan</label>
                <textarea required name="keterangan" class="form-control" id="keterangan_komite" cols="30" rows="3"></textarea>
                 <small id="helpId" class="text-muted">Tambah Keterangan tentang tarif</small>
               </div>
               <div class="form-group">
                 <label for="">Nomimal</label>
                 <input type="text" name="nominal" required id="nominal" class="form-control" placeholder="" aria-describedby="helpId">
                 <small id="helpId" class="text-muted"></small>
               </div>
			   <div class="form-group">
				 <label for="">Jenis</label>
				 <select name="jenis" class="form-control" id="">
					 <option value="">Debit</option>
					 <option value="">Kredit</option>
				 </select>
				 <small id="helpId" class="text-muted">Help text</small>
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

