<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>
    <link rel="icon" href="<?=base_url('assets/sbadmin/img/basscom.png')?>" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="<?=base_url('assets/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css')?>">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?=base_url('assets/sbadmin/css/sb-admin-2.min.css" rel="stylesheet')?>">
    <link rel="stylesheet" href="<?=base_url('assets/sbadmin/vendor/sweetalert2/sweetalert2.min.css')?>">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="<?=base_url('assets/sbadmin/img/basscom.png')?>" width="80" height="90"/>
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="post" action="<?php echo base_url(); ?>index.php/login/proses">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" name="username" aria-describedby="emailHelp"
                                                placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
									<br>
                                    <div class="text-center">
                                        <p class="small">&copy Copyright SINTO . Version 1.0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
</body>

</html>