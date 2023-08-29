<?php
    $page_session = \CodeIgniter\Config\Services::session();
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>HCC Library System</title>
        <link href="<?php echo base_url(); ?>/public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="<?php echo base_url(); ?>/public/assets/css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/public/baker/img/librarylogo.png">
    </head>
    <body style="background-image: url(<?php echo base_url(); ?>/public/assets/img/bghcc.jpg)">
        <br>
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0" style="background-color: #263B57">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block">
                                    <img src="<?php echo base_url(); ?>/public/baker/img/librarylogo.png" alt="Logo" class="" style="height:400px; margin-left: 40px">
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <br>
                                        <div class="text-center">
                                            <h4 style="color: white; font-family: arial;"><strong>HOLY CROSS COLLEGE <br> E-LIBRARY</strong></h4>
                                        </div>
                                        <br>
                                        <?php if(isset($validation)): ?>
                                            <div class="alert alert-danger">
                                                <?php echo $validation->listErrors(); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(session()->getTempdata('error')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo session()->getTempdata('error'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php echo form_open(); ?>
                                            <div class="form-group">
                                                <input type="text" name="user" class="form-control" placeholder="Username"
                                                style="color: black">
                                                <!-- <?php if(isset($validation)): ?>
                                                    <?php if($validation->hasError('username')): ?>
                                                        <span style="color: red"><?= $validation->getError('username'); ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>	 -->
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="pass" class="form-control" placeholder="Password"
                                                style="color: black">
                                                <?php if(isset($validation)): ?>
                                                    <?php if($validation->hasError('password')): ?>
                                                        <span style="color: red"><?= $validation->getError('password'); ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <input type="submit" name="login" value="LOGIN" class="btn btn-success btn-user btn-block">
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</html>