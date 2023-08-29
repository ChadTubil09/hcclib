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
                        BORROWER DETAILS
                    </div>
                        <?php foreach($accessionlist as $al): ?>
                            <?php if(isset($validation)): ?>
                                <div class="alert alert-danger">
                                        <?php echo $validation->listErrors(); ?>
                                    </div>
                                <?php endif; ?>
                            <?php echo form_open_multipart('books/process/'.$al['accid']); ?>
                                <div class="card-body" style="text-align: left">
                                    
                                    <span style="color: black">ACCESSION NO: </span><span style="color: black"><strong><?= $al['accno']; ?></strong></span>
                                    
                                    <hr>
                                    <div class="form-group">
                                        <span style="color: black;"><strong>NAME OF BORROWER</strong></span>
                                        <input type="text" name="name" class="form-control form-control-user" style="color: black"
                                        value="<?php echo set_value('name'); ?>">
                                        <div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <span style="color: black;"><strong>GRADE</strong></span>
                                                    <input type="text" name="txtgrade" class="form-control form-control-user" style="color: black"
                                                    value="<?php echo set_value('txtgrade'); ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <span style="color: black;"><strong>SECTION</strong></span>
                                                    <input type="text" name="txtsection" class="form-control form-control-user" style="color: black"
                                                    value="<?php echo set_value('txtsection'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <span style="color: black;"><strong>STUD/EMP NO.</strong></span>
                                                <input type="text" name="studentno" class="form-control form-control-user" style="color: black"
                                                value="<?php echo set_value('studentno'); ?>">
                                            </div>
                                            <div class="col-lg-4">
                                                <span style="color: black;"><strong>CONTACT</strong></span>
                                                <input type="text" name="contactno" class="form-control form-control-user" style="color: black"
                                                value="<?php echo set_value('contactno'); ?>">
                                            </div>
                                            <div class="col-lg-4">
                                                <span style="color: black;"><strong>DUE DATE</strong></span>
                                                <input type="date" name="duedateofreturn" class="form-control form-control-user" style="color: black"
                                                value="<?php echo set_value('duedateofreturn'); ?>" min="<?= date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                                        <input type="submit" name="update" value="Save" class="btn btn-primary btn-user">
                                    </div>
                                    
                                </div>
                            <?php echo form_close(); ?>
                        <?php endforeach;?>
                </div>
            </div>
        </div>

        <!-- ----------- END OF NEW CODE HERE! ------------------ -->

    <!-- ----------- FOOTER ------------------ -->
    <?php echo $this->include("partials/footer"); ?>
    <!-- ----------- END OF FOOTER ------------------ -->

<?php echo $this->endSection(); ?>