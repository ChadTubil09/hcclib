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
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">BROKEN OR LOST BOOKS</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php if(session()->getTempdata('bookdeletesuccess')) :?>
                                <div class="alert alert-success">
                                    <?= session()->getTempdata('bookdeletesuccess');?>
                                </div>
                            <?php endif; ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="color: black"><strong>ID</strong></th>
                                            <th style="color: black"><strong>ACCESSION #</strong></th>
                                            <th style="color: black"><strong>BOOK TITLE</strong></th>
                                            <th style="color: black"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($accessionlist as $al): ?>
                                            <tr>
                                                <td style="color: black"><?php echo $al['accid']; ?></td>
                                                <td style="color: black"><?php echo $al['accno']; ?></td>
                                                <td style="color: black">
                                                    <?php foreach($accbooklist as $abl): ?>
                                                        <?php if($abl['bookid'] == $al['accbookid']): ?>
                                                            <?= $abl['title']; ?>
                                                        <?php endif;?>
                                                    <?php endforeach;?>
                                                </td>
                                                <td style="text-align: center">
                                                    <button class="btn btn-primary btn-icon-split btn-sm" title="Restore"
                                                        onclick="window.location.href='<?= base_url(); ?>broken/restore/<?= $al['accid']; ?>';">
                                                        <span class="icon" style="font-size: 10px">
                                                            <i class="fas fa-recycle"></i>
                                                        </span>
                                                    </button>
                                                </td>
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