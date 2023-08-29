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
                        <?php if(session()->getTempdata('returnsuccess')) :?>
                            <div class="alert alert-success">
                                <?= session()->getTempdata('returnsuccess');?>
                            </div>
                        <?php endif; ?>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="color: black"><strong>COVER</strong></th>
                                        <th style="color: black"><strong>BOOK</strong></th>
                                        <th style="color: black"><strong>BORROWER</strong></th>
                                        <th style="color: black"><strong>BORROWED</strong></th>
                                        <th style="color: black"><strong>DUE DATE</strong></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($borrowlist as $borrow): ?>
                                        <?php foreach ($booklist as $book): ?>
                                            <?php foreach ($accessionlist as $accession): ?>
                                                <?php if($accession['accid'] === $borrow['baccid']) : ?>
                                                    <?php $accbook = $accession['accbookid']; ?>
                                                    <?php $accno = $accession['accno']; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?php if($book['bookid'] === $accbook): ?>
                                                <?php $bookcover = $book['image']; ?>
                                                <?php $booktitle = $book['title']; ?>
                                                <?php $bookedition = $book['edition']; ?>
                                                <?php $bookisbn = $book['isbn']; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td style="color: black; text-align: center;">
                                                <img src="<?= $bookcover; ?>" alt="bookcover" height="50px">
                                            </td>
                                            <td style="color: black">
                                                <strong><?php echo $booktitle; ?> - </strong><?php echo $bookedition; ?>
                                                <br>
                                                <span style="font-size: 13px;"><?php echo $accno; ?></span>
                                            </td>
                                            <td style="color: black">
                                                <strong><?php echo $borrow['name']; ?> - </strong><?php echo $borrow['studentno']; ?>
                                                <br>
                                                <span style="font-size: 13px;"><?php echo $borrow['contactno']; ?> | </span>
                                                <span style="font-size: 13px;"><?php echo $borrow['grade']; ?>-<?php echo $borrow['section']; ?></span>
                                            </td>
                                            <td style="color: black"><?php echo $borrow['borrowdate']; ?></td>
                                            <td style="color: black"><?php echo $borrow['duedateofreturn']; ?></td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-success btn-icon-split btn-sm" title="Return"
                                                    href="#" data-toggle="modal" data-target="#ReturnModal<?= $borrow['borrowid']; ?>">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-fw fa-arrow-left" style="color: white;"></i>
                                                    </span>
                                                    <span class="text">RETURN</span>
                                                </button>
                                                <!-- Delete Modal-->
                                                <div class="modal fade" id="ReturnModal<?= $borrow['borrowid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel" style="color: black;">CONFIRMATION!</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body" style="color: black;">ARE YOU SURE THAT YOU WANT TO RETURN THIS BOOK?</div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary" type="button" data-dismiss="modal">CANCEL</button>
                                                                <a class="btn btn-success" href="<?= base_url(); ?>return/process/<?= $borrow['borrowid']; ?>">RETURN</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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