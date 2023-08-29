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
                        <?php if(session()->getTempdata('errorborrow')) :?>
                            <div class="alert alert-danger">
                                <?= session()->getTempdata('errorborrow');?>
                            </div>
                        <?php endif; ?>
                        <?php if(session()->getTempdata('successborrow')) :?>
                            <div class="alert alert-success">
                                <?= session()->getTempdata('successborrow');?>
                            </div>
                        <?php endif; ?>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="color: black"><strong>COVER</strong></th>
                                        <th style="color: black"><strong>BOOK</strong></th>
                                        <th style="color: black"><strong>PUBLICATION</strong></th>
                                        <th style="color: black"><strong>COPIES</strong></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($booklist as $books): ?>
                                        <tr>
                                            <td style="color: black; text-align: center;"><img src="<?= $books['image']; ?>" alt="bookcover" height="50px"></td>
                                            <td style="color: black">
                                                <strong><?php echo $books['title']; ?> - </strong><?php echo $books['edition']; ?>
                                                <br>
                                                <span style="font-size: 13px;">
                                                    <?php foreach ($catlist as $catl): ?>
                                                        <?php $catlid = $catl['catid']; ?>
                                                        <?php if($catlid == $books['bookid']) : ?>
                                                            <?= $catl['catname']; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </span>
                                                <span style="display: none;"><?php echo $books['isbn'];?></span>
                                                <span style="display: none;"><?php echo $books['authors'];?></span>
                                                <span style="display: none;"><?php echo $books['issn'];?></span>
                                                <span style="display: none;"><?php echo $books['callnumber'];?></span>
                                            </td>
                                            <td style="color: black">
                                                <strong><?php echo $books['publication']; ?> - </strong><?php echo $books['dateofpub']; ?>
                                                <br>
                                                <span style="font-size: 13px;">
                                                    <?php echo $books['placeofpub']; ?>
                                                </span>
                                            </td>
                                            <td style="color: black">
                                                <strong><?php echo $books['copies']; ?> pcs</strong>
                                                <br>
                                                <span>Available</span>
                                            </td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-primary btn-icon-split btn-sm" title="Borrow"
                                                    onclick="window.location.href='<?= base_url(); ?>borrow/view/<?= $books['bookid']; ?>';">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-fw fa-eye" style="color: white;"></i>
                                                    </span>
                                                    <span class="text">VIEW</span>
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