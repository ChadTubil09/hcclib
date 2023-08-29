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
            <div class="col-lg-5">
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
                            <input type="text" name="title" class="form-control form-control-user"
                                placeholder="ENTER BOOK TITLE" style="color: black" value="<?php echo set_value('title'); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="isbn" class="form-control form-control-user"
                                placeholder="ENTER BOOK ISBN" style="color: black" value="<?php echo set_value('isbn'); ?>">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="issn" class="form-control form-control-user"
                                    placeholder="ENTER BOOK ISSN" style="color: black" value="<?php echo set_value('issn'); ?>">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="callnum" class="form-control form-control-user"
                                    placeholder="ENTER BOOK CALL NUMBER" style="color: black" value="<?php echo set_value('callnum'); ?>">
                                </div>
                            </div>
                                
                        </div>
                        <div class="form-group">
                            <input type="text" name="authors" class="form-control form-control-user"
                                placeholder="ENTER AUTHORS" style="color: black" value="<?php echo set_value('authors'); ?>">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="edition" class="form-control form-control-user"
                                    placeholder="ENTER BOOK EDITION" style="color: black" value="<?php echo set_value('edition'); ?>">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="publication" class="form-control form-control-user"
                                    placeholder="ENTER PUBLISHER" style="color: black" value="<?php echo set_value('publication'); ?>">
                                </div>
                            </div>
                                
                        </div>
                        <div class="form-group">
                            <input type="text" name="placeofpub" class="form-control form-control-user"
                            placeholder="PLACE OF PUBLICATION" style="color: black" value="<?php echo set_value('placeofpub'); ?>">                                
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-7">
                                    <!-- <input type="text" name="category" class="form-control form-control-user"
                                    placeholder="Category" style="color: black"> -->
                                    <select name="selbook" id="position" class="form-control form-control-user" style="color:black;">
                                        <option>BOOK CATEGORY</option>
                                        <optgroup label="Book Categories">
                                            <?php foreach ($catlist as $catl): ?>
                                            <option value="<?php echo $catl['catid']; ?>"><?php echo $catl['catname']; ?></option>
                                            <?php endforeach; ?>
                                            </optgroup>    
                                    </select>
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" name="dateofpub" class="form-control form-control-user"
                                    placeholder="YEAR OF PUBLICATION" style="color: black" value="<?php echo set_value('dateofpub'); ?>">
                                </div>
                            </div>
                                
                        </div>
                        <div class="form-group">
                            <textarea name="description" rows="2" placeholder="BOOK DESCRIPTION"
                                class="form-control form-control-user" style="color: black"><?php echo set_value('description'); ?></textarea>
                        </div>
                        <div class="form-group">
                            <textarea name="subaddedentry" rows="2" placeholder="SUBJECT ADDED ENTRY"
                                class="form-control form-control-user" style="color: black"><?php echo set_value('subaddedentry'); ?></textarea>
                        </div>
                        <div class="form-group">
                            <textarea name="notes" rows="2" placeholder="NOTES"
                                class="form-control form-control-user" style="color: black"><?php echo set_value('notes'); ?></textarea>
                        </div>
                        <div class="form-group">
                            <textarea name="contents" rows="2" placeholder="CONTENTS"
                                class="form-control form-control-user" style="color: black"><?php echo set_value('contents'); ?></textarea>
                        </div>
                        <input type="submit" name="login" value="ADD" class="btn btn-primary btn-user btn-block">
                    <?php echo form_close();?>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
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
                                        <th style="color: black"><strong>TITLE</strong></th>
                                        <th style="color: black"><strong>CATEGORY</strong></th>
                                        <th style="color: black"><strong>COPIES</strong></th>
                                        <th style="color: black"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($booklist as $books): ?>
                                        <tr>
                                            <td style="color: black">
                                                <span><strong><?php echo $books['title']; ?></strong></span><br>
                                                <span><?php echo $books['isbn'];?></span>
                                                <span style="display: none;"><?php echo $books['authors'];?></span>
                                                <span style="display: none;"><?php echo $books['issn'];?></span>
                                                <span style="display: none;"><?php echo $books['callnumber'];?></span>
                                                <span style="display: none;"><?php echo $books['publication'];?></span>
                                                <span style="display: none;"><?php echo $books['placeofpub'];?></span>
                                                <span style="display: none;"><?php echo $books['dateofpub'];?></span>
                                            </td>
                                            <td style="color: black">
                                                <?php foreach ($catlist as $catl): ?>
                                                    <?php $catlid = $catl['catid']; ?>
                                                    <?php if($catlid == $books['bookcatid']) : ?>
                                                        <?= $catl['catname']; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td style="color: black"><?php echo $books['copies']; ?>pcs</td>
                                            <td style="text-align: center">
                                                <button class="btn btn-primary btn-icon-split btn-sm" title="View"
                                                    onclick="window.location.href='<?= base_url(); ?>books/view/<?= $books['bookid']; ?>';">
                                                    <span class="icon" style="font-size: 10px">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </button>
                                                <button class="btn btn-info btn-icon-split btn-sm" title="Edit"
                                                    href="#" data-toggle="modal" data-target="#editModal<?= $books['bookid']; ?>">
                                                    <span class="icon" style="font-size: 10px">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </button>
                                                <!-- Edit Modal-->
                                                <div class="modal fade" id="editModal<?= $books['bookid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel" style="color: black;"><strong>EDIT BOOK</strong></h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><strong>×</strong></span>
                                                                </button>
                                                            </div>
                                                            <?php echo form_open_multipart('books/update/'.$books['bookid']); ?>
                                                            <div class="modal-body" style="text-align: left">
                                                                <div class="form-group" style="text-align: center;">
                                                                    <img src="<?= $books['image']; ?>" alt="bookcover" class="logo" style="height: 150px; width: 150px;">
                                                                </div>
                                                                <div class="form-group">
                                                                    <span style="color: black;"><strong>BOOK COVER</strong></span>
                                                                    <input type="file" name="bookcover" class="form-control form-control-user"
                                                                    value="<?php echo $books['image']; ?>">
                                                                </div>
                                                                <hr>
                                                                <div class="form-group">
                                                                    <span style="color: black;"><strong>BOOK TITLE</strong></span>
                                                                    <input type="text" name="title" class="form-control form-control-user"
                                                                        value="<?php echo $books['title']; ?>" style="color: black">
                                                                    <span style="color: black;"><strong>BOOK ISBN</strong></span>
                                                                    <input type="text" name="isbn" class="form-control form-control-user"
                                                                        value="<?php echo $books['isbn']; ?>" style="color: black">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <span style="color: black;"><strong>BOOK ISSN</strong></span>
                                                                            <input type="text" name="issn" class="form-control form-control-user"
                                                                                value="<?php echo $books['issn']; ?>" style="color: black">
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <span style="color: black;"><strong>BOOK CALL NUMBER</strong></span>
                                                                            <input type="text" name="callnum" class="form-control form-control-user"
                                                                                value="<?php echo $books['callnumber']; ?>" style="color: black">
                                                                        </div>
                                                                    </div>
                                                                    <span style="color: black;"><strong>AUTHORS</strong></span>
                                                                    <input type="text" name="authors" class="form-control form-control-user"
                                                                        value="<?php echo $books['authors']; ?>" style="color: black">
                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <span style="color: black;"><strong>BOOK EDITION</strong></span>
                                                                            <input type="text" name="edition" class="form-control form-control-user"
                                                                                value="<?php echo $books['edition']; ?>" style="color: black">
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            <span style="color: black;"><strong>BOOK PUBLISHER</strong></span>
                                                                            <input type="text" name="publication" class="form-control form-control-user"
                                                                                value="<?php echo $books['publication']; ?>" style="color: black">
                                                                        </div>
                                                                    </div>
                                                                    <span style="color: black;"><strong>PLACE OF PUBLICATION</strong></span>
                                                                    <input type="text" name="placeofpub" class="form-control form-control-user"
                                                                        value="<?php echo $books['placeofpub']; ?>" style="color: black">
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            <span style="color: black;"><strong>DATE</strong></span>
                                                                            <input type="text" name="dateofpub" class="form-control form-control-user"
                                                                                value="<?php echo $books['dateofpub']; ?>" style="color: black">
                                                                        </div>
                                                                        <div class="col-lg-8">
                                                                            <span style="color: black;"><strong>CATEGORY</strong></span>
                                                                            <select name="selbook" id="position" class="form-control form-control-user" style="color:black;">
                                                                                <option value="<?php echo $books['bookcatid']; ?>">
                                                                                    <?php foreach ($catlist as $cat): ?>
                                                                                        <?php if($cat['catid'] === $books['bookcatid']): ?>
                                                                                            <?php echo $cat['catname']; ?>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </option>
                                                                                <optgroup label="Book Categories">
                                                                                    <?php foreach ($catlist as $catl): ?>
                                                                                    <option value="<?php echo $catl['catid']; ?>"><?php echo $catl['catname']; ?></option>
                                                                                    <?php endforeach; ?>
                                                                                    </optgroup>    
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <span style="color: black;"><strong>BOOK DESCRIPTION</strong></span>
                                                                    <textarea name="description" class="form-control form-control-user" 
                                                                        style="color: black"><?php echo $books['description']; ?></textarea>
                                                                    <span style="color: black;"><strong>SUBJECT ADDED ENTRY</strong></span>
                                                                    <textarea name="subaddedentry" rows="2" class="form-control form-control-user" 
                                                                        style="color: black"><?php echo $books['subaddedentry']; ?></textarea>
                                                                    <span style="color: black;"><strong>NOTES</strong></span>
                                                                    <textarea name="notes" rows="2" class="form-control form-control-user" 
                                                                        style="color: black"><?php echo $books['notes']; ?></textarea>
                                                                    <span style="color: black;"><strong>CONTENTS</strong></span>
                                                                    <textarea name="contents" rows="2" class="form-control form-control-user" 
                                                                        style="color: black"><?php echo $books['contents']; ?></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-danger" type="button" data-dismiss="modal">CANCEL</button>
                                                                    <input type="submit" name="update" value="UPDATE" class="btn btn-primary btn-user">
                                                                </div>
                                                            <?php echo form_close(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of Edit Modal-->
                                                <!-- <button class="btn btn-danger btn-icon-split btn-sm" title="Delete"
                                                    onclick="window.location.href='<?= base_url(); ?>books/delete/<?= $books['bookid']; ?>';">
                                                    <span class="icon" style="font-size: 10px">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </button> -->
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