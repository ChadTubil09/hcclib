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
                            <span style="color: black">SUBJECT ADDED ENTRY: </span><span style="color: black;"><strong><?= $books['description']; ?></strong></span>
                            <br>
                            <br>
                            <span style="color: black">NOTES: </span><span style="color: black;"><strong><?= $books['notes']; ?></strong></span>
                            <br>
                            <br>
                            <span style="color: black">CONTENTS: </span><span style="color: black;"><strong><?= $books['contents']; ?></strong></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-left-primary shadow">
                    <div class="card-header" style="color: black">
                        LIST OF BOOK COPIES
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="color: black"><strong>ACC NO.</strong></th>
                                    <th style="color: black"><strong>STATUS</strong></th>
                                    <th style="color: black"></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="color: black"><strong>ACC NO.</strong></th>
                                    <th style="color: black"><strong>STATUS</strong></th>
                                    <th style="color: black"></th>
                                </tr>
                            </tfoot>
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
                                            <button class="btn btn-primary btn-icon-split btn-sm" title="Borrow"
                                                onclick="window.location.href='<?= base_url(); ?>borrow/view/set/<?= $accession['accid']; ?>'"
                                                <?php if($accession['status'] == 1){echo 'disabled';}else{}?>>
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-fw fa-arrow-right" style="color: white;"></i>
                                                </span>
                                                <span class="text">BORROW</span>
                                            </button>
                                            <!-- Edit Modal-->
                                            <div class="modal fade" id="borrowModal<?= $accession['accid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel" style="color: black;"><strong>Borrow Book</strong></h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"><strong>×</strong></span>
                                                            </button>
                                                        </div>
                                                        <?php echo form_open_multipart('books/process/'.$accession['accid']); ?>
                                                            <div class="modal-body" style="text-align: left">
                                                                <span style="color: black">ACC #: </span><span style="color: black"><strong><?= $accession['accno']; ?></strong></span>
                                                                <br>
                                                                <span><strong style="color: black; font-size: 25px"><?php echo $books['title']; ?></strong>
                                                                <br>
                                                                <span style="color: black;"><strong><?= $books['edition']; ?></strong></span>
                                                                <br>
                                                                <span style="color: black">AUTHORS: </span><span style="color: black;"><strong><?= $books['authors']; ?></strong></span>
                                                                <br>
                                                                <span style="color: black">ISBN: </span><span style="color: black"><strong><?= $books['isbn']; ?></strong></span>
                                                                <br>
                                                                <span style="color: black">ISSN: </span><span style="color: black"><strong><?= $books['issn']; ?></strong></span>
                                                                <br>
                                                                <span style="color: black">CALL #: </span><span style="color: black"><strong><?= $books['callnumber']; ?></strong></span>
                                                                <hr>
                                                                <div class="form-group">
                                                                    <span style="color: black;"><strong>Name of borrower</strong></span>
                                                                    <input type="text" name="name" class="form-control form-control-user" style="color: black">
                                                                    <div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <span style="color: black;"><strong>Grade</strong></span>
                                                                                <input type="text" name="txtgrade" class="form-control form-control-user" style="color: black">
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <span style="color: black;"><strong>Section</strong></span>
                                                                                <input type="text" name="txtsection" class="form-control form-control-user" style="color: black">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            <span style="color: black;"><strong>Stud/Emp No.</strong></span>
                                                                            <input type="text" name="studentno" class="form-control form-control-user" style="color: black">
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <span style="color: black;"><strong>Contact</strong></span>
                                                                            <input type="text" name="contactno" class="form-control form-control-user" style="color: black">
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <span style="color: black;"><strong>Due date</strong></span>
                                                                            <input type="date" name="duedateofreturn" class="form-control form-control-user" style="color: black">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                                                                    <input type="submit" name="update" value="Save" class="btn btn-primary btn-user">
                                                                </div>
                                                                
                                                            </div>
                                                        <?php echo form_close(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End of Edit Modal-->      
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