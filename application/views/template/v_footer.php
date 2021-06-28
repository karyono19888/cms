
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SINTO 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>/login/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url('assets/sbadmin/vendor/jquery/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url('assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url('assets/sbadmin/js/sb-admin-2.min.js')?>"></script>

    <!-- Page level plugins -->
    <script src="<?=base_url('assets/sbadmin/vendor/chart.js/Chart.min.js')?>"></script>
    <!-- Page level plugins -->
    <script src="<?=base_url()?>assets/sbadmin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url()?>assets/sbadmin/js/demo/datatables-demo.js"></script>


    <!-- Page level custom scripts -->
    <script src="<?=base_url('assets/sbadmin/js/demo/chart-area-demo.js')?>"></script>
    <script src="<?=base_url('assets/sbadmin/js/demo/chart-pie-demo.js')?>"></script>
    <script src="<?=base_url('assets/sbadmin/vendor/sweetalert2/sweetalert2.all.min.js')?>"></script>
		<?php if ($this->session->flashdata('success')): ?>
			<script>
				SweetAlert.fire({
					icon: 'success',
					title: 'Success',
					text: '<?php echo $this->session->flashdata('success'); ?>',
					showConfirmButton: false,
					timer: 1500
				})
			</script>
		<?php endif; unset($_SESSION['success']); ?>
		<?php if ($this->session->flashdata('error')): ?>
			<script>
				SweetAlert.fire({
					icon: 'error',
					title: 'Error',
					text: '<?php echo $this->session->flashdata('error'); ?>',
					showConfirmButton: false,
					timer: 1500
				})
			</script>
		<?php endif; unset($_SESSION['error']); ?>
		<?php if ($this->session->flashdata('warning')): ?>
			<script>
				SweetAlert.fire({
					icon: 'warning',
					title: 'Warning !',
					text: '<?php echo $this->session->flashdata('warning'); ?>',
					showConfirmButton: false,
					timer: 1500
				})
			</script>
		<?php endif; unset($_SESSION['warning']); ?>
        <script>
			function Logout(){
				SweetAlert.fire({
					title: 'Are you sure?',
					text: "want to exit the application!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, out it!'
					}).then((result) => {
					if (result.isConfirmed) {
						window.location.assign('<?php echo base_url('Main/logout')?>');
					}
				})
			}
		</script>