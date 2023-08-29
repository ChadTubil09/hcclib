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
            <div class="col-lg-6">
                <div class="card border-left-primary shadow">
                    <div class="card-header" style="color: black">
                        BOOK DETAILS
                    </div>
                    <div class="card-body">
                        <?php foreach ($booklist as $books): ?>
                            <div class="row">
                                <div class="col-lg-5" style="text-align: center">
                                    <img src="<?= $books['image']; ?>" alt="bookcover" class="logo">
                                </div>
                                <div class="col-lg-7">
                                    <h4 style="color: black"><strong><?= $books['title']; ?></strong></h4>
                                    <span style="color: black;"><strong><?= $books['edition']; ?></strong></span>
                                    <br>
                                    <span style="color: black">AUTHORS: </span><span style="color: black;"><strong><?= $books['authors']; ?></strong></span>
                                    <br>
                                    <span style="color: black">ISBN: </span><span style="color: black"><strong><?= $books['isbn']; ?></strong></span>
                                    <br>
                                    <span style="color: black">ISSN: </span><span style="color: black"><strong><?= $books['issn']; ?></strong></span>
                                    <br>
                                    <span style="color: black">CALL #: </span><span style="color: black"><strong><?= $books['callnumber']; ?></strong></span>
                                </div>
                            </div>
                            <br>
                            <span style="color: black">PUBLICATION: </span><span style="color: black;"><strong><?= $books['publication']; ?></strong></span>
                            <br>
                            <span style="color: black">PLACE OF PUBLICATION: </span><span style="color: black;"><strong><?= $books['placeofpub']; ?></strong></span>
                            <br>
                            <span style="color: black">DATE OF PUBLICATION: </span><span style="color: black;"><strong><?= $books['dateofpub']; ?></strong></span>
                            <br>
                            <br>
                            <span style="color: black">DESCRIPTION: </span><span style="color: black;"><strong><?= $books['description']; ?></strong></span>
                            <br>
                            <br>
                            <span style="color: black">SUBJECT ADDED ENTRY: </span><span style="color: black;"><strong><?= $books['subaddedentry']; ?></strong></span>
                            <br>
                            <br>
                            <span style="color: black">NOTES: </span><span style="color: black;"><strong><?= $books['notes']; ?></strong></span>
                            <br>
                            <br>
                            <span style="color: black">CONTENTS: </span><span style="color: black;"><strong><?= $books['contents']; ?></strong></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer" style="color: black">
                        <button class="btn btn-danger" title="Delete" style="width: 100%"
                            href="#" data-toggle="modal" data-target="#DeleteModal<?= $books['bookid']; ?>">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash" style="color: white;"></i>
                            </span>
                            <span class="text">DELETE BOOK</span>
                        </button>
                        <!-- Delete Modal-->
                        <div class="modal fade" id="DeleteModal<?= $books['bookid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRMATION!</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">ARE YOU SURE THAT YOU WANT TO DELETE THIS BOOK?</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="button" data-dismiss="modal">CANCEL</button>
                                        <a class="btn btn-danger" href="<?= base_url(); ?>books/delete/<?= $books['bookid']; ?>">DELETE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-left-primary shadow">
                    <div class="card-header" style="color: black">
                        ADD COPY OF BOOK
                    </div>
                    <div class="card-body">
                    <?php if(session()->getTempdata('erroraddaccession')) :?>
                        <div class="alert alert-danger">
                            <?= session()->getTempdata('erroraddaccession');?>
                        </div>
                    <?php endif; ?>
                    <?php if(session()->getTempdata('success')) :?>
                        <div class="alert alert-success">
                            <?= session()->getTempdata('success');?>
                        </div>
                    <?php endif; ?>
                    <?php foreach ($booklist as $books): ?>
                        <?php echo form_open('books/add/'.$books['bookid']); ?>
                            <div class="form-group">
                                <input type="text" name="accno" class="form-control form-control-user"
                                    placeholder="ENTER BOOK ACCESSION NUMBER" style="color: black">
                                    <br>
                                <input type="submit" name="add" value="ADD" class="btn btn-primary btn-user btn-block">
                            </div>
                        <?php echo form_close(); ?>
                    <?php endforeach; ?>
                    </div>
                </div>
                <br>
                <div class="card border-left-primary shadow">
                    <div class="card-header" style="color: black">
                        LIST OF BOOK COPIES
                    </div>
                    <div class="card-body">
                        <?php if(session()->getTempdata('deletesuccess')) :?>
                            <div class="alert alert-success">
                                <?= session()->getTempdata('deletesuccess');?>
                            </div>
                        <?php endif; ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="color: black"><strong>ACC NO.</strong></th>
                                    <th style="color: black"><strong>STATUS</strong></th>
                                    <th style="color: black"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($accessionlist as $accession): ?>
                                    <tr>
                                        <td style="color: black"><?php echo $accession['accno']; ?></td>
                                        <td style="color: black">
                                            <?php if($accession['status'] == 0): ?>
                                                <?= 'Available'; ?>
                                            <?php elseif($accession['status'] == 1): ?>
                                                <?= 'Borrowed'; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: center">
                                            <button class="btn btn-danger btn-icon-split btn-sm" title="Delete"
                                                onclick="window.location.href='<?= base_url(); ?>books/accessiondelete/<?= $accession['accid']; ?>';"
                                                <?php if($accession['status'] == 1){echo 'disabled';}else{}?>>
                                                <span class="icon" style="font-size: 10px">
                                                    <i class="fas fa-trash"></i>
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

        <!-- ----------- END OF NEW CODE HERE! ------------------ -->

    <!-- ----------- FOOTER ------------------ -->
    <?php echo $this->include("partials/footer"); ?>
    <!-- ----------- END OF FOOTER ------------------ -->

<?php echo $this->endSection(); ?>