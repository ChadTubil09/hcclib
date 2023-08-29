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
        <?php if(session()->getTempdata('imageerror')) :?>
            <div class="alert alert-danger">
                <?= session()->getTempdata('imageerror');?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-4">
                <div class="card border-left-primary shadow">
                    <div class="card-header" style="color: black">
                        ADD BOOK
                    </div>
                    <div class="card-body">
                    <?php if(session()->getTempdata('success')) :?>
                        <div class="alert alert-success">
                            <?= session()->getTempdata('success');?>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?php echo $validation->listErrors(); ?>
                        </div>
                    <?php endif; ?>
                    <?php echo form_open(); ?>
                        <div class="form-group">
                            <input type="text" name="ebtitle" class="form-control form-control-user"
                                placeholder="ENTER E-BOOK TITLE" style="color: black">
                        </div>
                        <div class="form-group">
                            <input type="text" name="ebauthors" class="form-control form-control-user"
                            placeholder="ENTER E-BOOK AUTHORS" style="color: black">                                
                        </div>
                        <div class="form-group">
                            <input type="text" name="eblink" class="form-control form-control-user"
                            placeholder="ENTER E-BOOK LINK" style="color: black">                              
                        </div>
                        <input type="submit" name="login" value="ADD" class="btn btn-primary btn-user btn-block">
                    <?php echo form_close();?>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <!-- DataTales Example -->
                <div class="card border-left-primary shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                        <?php if(session()->getTempdata('deletesuccess')) :?>
                            <div class="alert alert-success">
                                <?= session()->getTempdata('deletesuccess');?>
                            </div>
                        <?php endif; ?>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="color: black"><strong>ID</strong></th>
                                        <th style="color: black"><strong>TITLE</strong></th>
                                        <th style="color: black"><strong>AUTHORS</strong></th>
                                        <th style="color: black"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ebooklist as $ebooks): ?>
                                        <tr>
                                            <td style="color: black">EB-<?php echo $ebooks['ebid']; ?></td>
                                            <td style="color: black">
                                                <strong><?php echo $ebooks['ebtitle']; ?></strong>
                                            </td>
                                            <td style="color: black"><?php echo $ebooks['ebauthors']; ?>pcs</td>
                                            <td style="text-align: center">
                                                <button class="btn btn-info btn-icon-split btn-sm" title="Edit"
                                                    href="#" data-toggle="modal" data-target="#editModal<?= $ebooks['ebid']; ?>">
                                                    <span class="icon" style="font-size: 10px">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </button>
                                                <!-- Edit Modal-->
                                                <div class="modal fade" id="editModal<?= $ebooks['ebid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel" style="color: black;"><strong>Edit E-Book</strong></h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><strong>×</strong></span>
                                                                </button>
                                                            </div>
                                                            <?php echo form_open('ebooks/update/'.$ebooks['ebid']); ?>
                                                            <div class="modal-body" style="text-align: left">
                                                                <div class="form-group">
                                                                    <span style="color: black;"><strong>Book Title</strong></span>
                                                                    <input type="text" name="ebtitle" class="form-control form-control-user"
                                                                        value="<?php echo $ebooks['ebtitle']; ?>" style="color: black">
                                                                    <span style="color: black;"><strong>Authors</strong></span>
                                                                    <input type="text" name="ebauthors" class="form-control form-control-user"
                                                                        value="<?php echo $ebooks['ebauthors']; ?>" style="color: black">
                                                                    <span style="color: black;"><strong>Links</strong></span>
                                                                    <input type="text" name="eblink" class="form-control form-control-user"
                                                                        value="<?php echo $ebooks['eblink']; ?>" style="color: black">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                                                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-user">
                                                                </div>
                                                            <?php echo form_close(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of Edit Modal-->
                                                <button class="btn btn-danger btn-icon-split btn-sm" title="Delete"
                                                    onclick="window.location.href='<?= base_url(); ?>ebooks/delete/<?= $ebooks['ebid']; ?>';">
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
            
        </div>


        <!-- ----------- END OF NEW CODE HERE! ------------------ -->

    <!-- ----------- FOOTER ------------------ -->
    <?php echo $this->include("partials/footer"); ?>
    <!-- ----------- END OF FOOTER ------------------ -->

<?php echo $this->endSection(); ?>