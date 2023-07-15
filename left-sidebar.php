    <div class="left-side-bar">
		<div class="brand-logo">
			<a href="dashboard.php">
				<img src="images/logowabi.png" alt="" class="dark-logo">
				<img src="images/logowabi.png" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="dashboard.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-home"></span><span class="mtext">Home</span>
						</a>
					</li>
					<?php if ($_SESSION['role'] == 'admin'): ?>
						<!-- Admin -->
						<li>
							<a href="pelatihan.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-open-book"></span><span class="mtext">Pelatihan</span>
							</a>
						</li>
						<li>
							<a href="program.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-analytics-17"></span><span class="mtext">Program</span>
							</a>
						</li>
						<li>
							<a href="#" class="dropdown-toggle no-arrow" data-toggle="modal" data-target="#laporanModal">
								<span class="micon dw dw-analytics1"></span><span class="mtext">Laporan Periode</span>
							</a>
						</li>
						<li>
							<a href="laporan-peserta.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-analytics-10"></span><span class="mtext">Laporan Peserta</span>
							</a>
						</li>
					<?php else: ?>
						<!-- Peserta -->
						<li>
							<a href="pelatihan-peserta.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-open-book"></span><span class="mtext">Pelatihan</span>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>

	<!-- Modal Laporan-->
	<div class="modal fade" id="laporanModal" role="dialog">
        <div class="modal-dialog">
            <form action="laporan-date.php" method="POST">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Laporan</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Tanggal Mulai<span style="color:red;">*</span></label>
							<div class="col-sm-8">
								<input type="date" class="form-control" name="tgl_mulai" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Tanggal Selesai<span style="color:red;">*</span></label>
							<div class="col-sm-8">
								<input type="date" class="form-control" name="tgl_selesai" required>
							</div>
						</div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cek Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>