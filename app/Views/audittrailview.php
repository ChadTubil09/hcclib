<?php $this->extend("layouts/base"); ?>

<?php $this->section("title"); ?>
    <?php echo $page_title; ?>
<?php $this->endSection(); ?>

<?php $this->section("page_heading"); ?>
    <?php echo $page_heading; ?>
<?php $this->endSection(); ?>

<?php echo $this->section('content'); ?>
    <!-- ----------- SIDEBAR ------------------ -->
    <?php echo $this->include("partials/sidebar"); ?>  
    <!-- ----------- END OF SIDEBAR ------------------ --> 
    <!-- ----------- TOPBAR ------------------ -->
    <?php echo $this->include("partials/topbar"); ?>
    <!-- ----------- END OF TOPBAR ------------------ -->
     <!-- Begin Page Content -->
     <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0" style="color: black;"><strong><?php $this->renderSection("page_heading"); ?></strong></h1>
        </div>
        

        <!-- ----------- START OF NEW CODE HERE! ------------------ --> 
        <div class="row">
            <div class="col-lg-12">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="color: black"><strong>ACTION</strong></th>
                                        <th style="color: black"><strong>USER</strong></th>
                                        <th style="color: black"><strong>DETAILS</strong></th>
                                        <th style="color: black"><strong>DATE</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($at as $att): ?>
                                        <tr>
                                            <td style="color: black"><?php echo $att['ataction']; ?></td>
                                            <td style="color: black">
                                                <?php foreach ($userslist as $getuser): ?>
                                                    <?php $getusername = $getuser['uid']; ?>
                                                    <?php if($getusername == $att['atuid']) : ?>
                                                        <?= $getuser['name']; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td style="color: black"><?php echo $att['atmessage']; ?></td>
                                            <td style="color: black"><?php echo $att['atdatetime']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- ----------- END OF NEW CODE HERE! ------------------ -->

    <!-- ----------- FOOTER ------------------ -->
    <?php echo $this->include("partials/footer"); ?>
    <!-- ----------- END OF FOOTER ------------------ -->
<?php echo $this->endSection(); ?>