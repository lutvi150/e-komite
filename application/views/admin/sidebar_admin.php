
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="start active ">
					<a href="<?=base_url();?>admin">
					<i class="icon-home"></i>
					<span class="title">Home</span>
					</a>
				</li>
				
				<li>
					<a href="<?=base_url();?>admin/tarif_komite">
					<i class="icon-rocket"></i>
					<span class="title">Tarif Komite</span>
					</a>
				</li>
				<li>
					<a href="<?=base_url();?>admin/data_kelas">
					<i class="icon-rocket"></i>
					<span class="title">Data Kelas</span>
					</a>
				</li>
				
				<li>
					<a href="<?=base_url();?>admin/data_siswa">
					<i class="icon-rocket"></i>
					<span class="title">Data Siswa</span>
					</a>
				</li>
				<li>
					<a href="<?=base_url();?>admin/tarif_komite">
					<i class="icon-rocket"></i>
					<span class="title">Sumbangan Komite</span>
					</a>
				</li>
				
				<li>
					<a href="javascript:;">
					<i class="icon-basket"></i>
					<span class="title">Keuangan</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="<?=base_url();?>admin/sumbangan_rutin">
							<i class="icon-home"></i>
							Sumbangan Rutin</a>
						</li>
						<li>
							<a href="<?=base_url();?>admin/sumbangan_isi">
							<i class="icon-basket"></i>
							Sumbangan Insidentil</a>
						</li>
						<li>
							<a href="<?=base_url();?>admin/transaksi">
							<i class="icon-tag"></i>
							Transaksi</a>
						</li>
						<!-- <li>
							<a href="ecommerce_products.html">
							<i class="icon-handbag"></i>
							Products</a>
						</li>
						<li>
							<a href="ecommerce_products_edit.html">
							<i class="icon-pencil"></i>
							Product Edit</a>
						</li> -->
					</ul>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->