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
            <div class="col-lg-4">
                <div class="card border-left-primary shadow">
                    <div class="card-header" style="color: black">
                        ADD USER
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
                            <input type="text" name="name" class="form-control form-control-user"
                                placeholder="ENTER FULL NAME" style="color: black">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control form-control-user"
                                placeholder="ENTER EMAIL ADDRESS" style="color: black">
                        </div>
                        <div class="form-group">
                            <input type="text" name="mobile" class="form-control form-control-user"
                                placeholder="ENTER CONTACT NUMBER" style="color: black">
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control form-control-user"
                                placeholder="ENTER USERNAME" style="color: black">
                        </div>
                        <div class="form-group">
                            <input type="text" name="password" class="form-control form-control-user"
                                placeholder="ENTER PASSWORD" style="color: black">
                        </div>
                        <input type="submit" name="login" value="ADD" class="btn btn-primary btn-user btn-block">
                    <?php echo form_close();?>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
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
                                        <th style="color: black"><strong>NAME</strong></th>
                                        <th style="color: black"><strong>POSITION</strong></th>
                                        <th style="color: black"><strong>USERNAME</strong></th>
                                        <th style="color: black"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($userslist as $users): ?>
                                        <tr>
                                            <td style="color: black">U-<?php echo $users['uid']; ?></td>
                                            <td style="color: black"><?php echo $users['name']; ?></td>
                                            <td style="color: black">
                                                <?php foreach ($poslist as $pos): ?>
                                                    <?php $pospos = $pos['posid']; ?>
                                                    <?php if($pospos == $users['userposid']) : ?>
                                                        <?= $pos['posname']; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td style="color: black"><?php echo $users['username']; ?></td>
                                            <td style="text-align: center">
                                                <button class="btn btn-info btn-icon-split btn-sm" title="Edit"
                                                    href="#" data-toggle="modal" data-target="#editModal<?= $users['uid']; ?>">
                                                    <span class="icon" style="font-size: 10px">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </button>
                                                <!-- Edit Modal-->
                                                <div class="modal fade" id="editModal<?= $users['uid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel" style="color: black;"><strong>Edit User</strong></h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><strong>×</strong></span>
                                                                </button>
                                                            </div>
                                                            <?php echo form_open('users/update/'.$users['uid']); ?>
                                                            <div class="modal-body" style="text-align: left">
                                                                <div class="form-group">
                                                                    <input type="text" name="name" class="form-control form-control-user"
                                                                        value="<?php echo $users['name']; ?>" style="color: black">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" name="email" class="form-control form-control-user"
                                                                        value="<?php echo $users['email']; ?>" style="color: black">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" name="mobile" class="form-control form-control-user"
                                                                        value="<?php echo $users['mobile']; ?>" style="color: black">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" name="username" class="form-control form-control-user"
                                                                        value="<?php echo $users['username']; ?>" style="color: black">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" name="password" class="form-control form-control-user"
                                                                        value="<?php echo $users['password']; ?>" style="color: black">
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
                                                <button class="btn btn-warning btn-icon-split btn-sm" title="Access"
                                                    href="#" data-toggle="modal" data-target="#accessModal<?= $users['uid']; ?>">
                                                    <span class="icon" style="font-size: 10px">
                                                        <i class="fas fa-key"></i>
                                                    </span>
                                                </button>
                                                <!-- Access Modal-->
                                                <div class="modal fade" id="accessModal<?= $users['uid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel" style="color: black;"><strong>Give access?</strong></h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><strong>×</strong></span>
                                                                </button>
                                                            </div>
                                                            <?php echo form_open('users/access/'.$users['uid']); ?>
                                                                <div class="modal-body" style="text-align: left">
                                                                    <h5 style="color:black;">User: <strong><?php echo $users['name']; ?></strong></h5>
                                                                    <div class="form-group">
                                                                        <span for="position" style="color:black;">Choose a position:</span>
                                                                            <select name="selposition" id="position" class="form-control form-control-user" style="color:black;">
                                                                                <option value="<?php echo $users['userposid']; ?>">
                                                                                    <?php foreach ($poslist as $pos): ?>
                                                                                        <?php $pospos = $pos['posid']; ?>
                                                                                        <?php if($pospos == $users['userposid']) : ?>
                                                                                            <?= $pos['posname']; ?>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </option>
                                                                                <optgroup label="Choose a position">
                                                                                    <?php foreach ($poslist as $pos): ?>
                                                                                    <option value="<?php echo $pos['posid']; ?>"><?php echo $pos['posname']; ?></option>
                                                                                    <?php endforeach; ?>
                                                                                    </optgroup>
                                                                            </select>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group">
                                                                        <span for="position" style="color:black;">Choose a access:</span>
                                                                        <div class="row">
                                                                            <div class="col-lg-4" 
                                                                                <?php if($users['acbooks'] == 1): ?>
                                                                                    <?= 'style="background-color: green; text-align: center;"';?>
                                                                                <?php else : ?>
                                                                                    <?= 'style="background-color: red; text-align: center;"';?>
                                                                                <?php endif; ?>
                                                                            >
                                                                                <span style="color: white"><strong>Book Acess</strong></span>
                                                                            </div>
                                                                            <div class="col-lg-4" >
                                                                                <select name="acbooks" class="form-control form-control-user" style="color:black;">
                                                                                    <option value="<?= $users['acbooks']; ?>">
                                                                                        <?php if($users['acbooks'] == 1): ?>
                                                                                            <?= 'Allowed';?>
                                                                                        <?php else : ?>
                                                                                            <?= 'Denied';?>
                                                                                        <?php endif; ?>
                                                                                    </option>
                                                                                    <optgroup label="">
                                                                                        <option value="1">Allow</option>
                                                                                        <option value="0">Deny</option>
                                                                                    </optgroup>    
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-lg-4" 
                                                                                <?php if($users['acborrow'] == 1): ?>
                                                                                    <?= 'style="background-color: green; text-align: center;"';?>
                                                                                <?php else : ?>
                                                                                    <?= 'style="background-color: red; text-align: center;"';?>
                                                                                <?php endif; ?>
                                                                            >
                                                                                <span style="color: white"><strong>Borrow Acess</strong></span>
                                                                            </div>
                                                                            <div class="col-lg-4" >
                                                                                <select name="acborrow" class="form-control form-control-user" style="color:black;">
                                                                                    <option value="<?= $users['acborrow']; ?>">
                                                                                        <?php if($users['acborrow'] == 1): ?>
                                                                                            <?= 'Allowed';?>
                                                                                        <?php else : ?>
                                                                                            <?= 'Denied';?>
                                                                                        <?php endif; ?>
                                                                                    </option>
                                                                                    <optgroup label="">
                                                                                        <option value="1">Allow</option>
                                                                                        <option value="0">Deny</option>
                                                                                    </optgroup>    
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-lg-4" 
                                                                                <?php if($users['acreturn'] == 1): ?>
                                                                                    <?= 'style="background-color: green; text-align: center;"';?>
                                                                                <?php else : ?>
                                                                                    <?= 'style="background-color: red; text-align: center;"';?>
                                                                                <?php endif; ?>
                                                                            >
                                                                                <span style="color: white"><strong>Return Acess</strong></span>
                                                                            </div>
                                                                            <div class="col-lg-4" >
                                                                                <select name="acreturn" class="form-control form-control-user" style="color:black;">
                                                                                    <option value="<?= $users['acreturn']; ?>">
                                                                                        <?php if($users['acreturn'] == 1): ?>
                                                                                            <?= 'Allowed';?>
                                                                                        <?php else : ?>
                                                                                            <?= 'Denied';?>
                                                                                        <?php endif; ?>
                                                                                    </option>
                                                                                    <optgroup label="">
                                                                                        <option value="1">Allow</option>
                                                                                        <option value="0">Deny</option>
                                                                                    </optgroup>    
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-lg-4" 
                                                                                <?php if($users['aclogs'] == 1): ?>
                                                                                    <?= 'style="background-color: green; text-align: center;"';?>
                                                                                <?php else : ?>
                                                                                    <?= 'style="background-color: red; text-align: center;"';?>
                                                                                <?php endif; ?>
                                                                            >
                                                                                <span style="color: white"><strong>Logs Access</strong></span>
                                                                            </div>
                                                                            <div class="col-lg-4" >
                                                                                <select name="aclogs" class="form-control form-control-user" style="color:black;">
                                                                                    <option value="<?= $users['aclogs']; ?>">
                                                                                        <?php if($users['aclogs'] == 1): ?>
                                                                                            <?= 'Allowed';?>
                                                                                        <?php else : ?>
                                                                                            <?= 'Denied';?>
                                                                                        <?php endif; ?>
                                                                                    </option>
                                                                                    <optgroup label="">
                                                                                        <option value="1">Allow</option>
                                                                                        <option value="0">Deny</option>
                                                                                    </optgroup>    
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-lg-4" 
                                                                                <?php if($users['acsystem'] == 1): ?>
                                                                                    <?= 'style="background-color: green; text-align: center;"';?>
                                                                                <?php else : ?>
                                                                                    <?= 'style="background-color: red; text-align: center;"';?>
                                                                                <?php endif; ?>
                                                                            >
                                                                                <span style="color: white"><strong>System Access</strong></span>
                                                                            </div>
                                                                            <div class="col-lg-4" >
                                                                                <select name="acsystem" class="form-control form-control-user" style="color:black;">
                                                                                    <option value="<?= $users['acsystem']; ?>">
                                                                                        <?php if($users['acsystem'] == 1): ?>
                                                                                            <?= 'Allowed';?>
                                                                                        <?php else : ?>
                                                                                            <?= 'Denied';?>
                                                                                        <?php endif; ?>
                                                                                    </option>
                                                                                    <optgroup label="">
                                                                                        <option value="1">Allow</option>
                                                                                        <option value="0">Deny</option>
                                                                                    </optgroup>    
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                                                                    <input type="submit" name="save" value="Save" class="btn btn-primary">
                                                                </div>
                                                            <?php echo form_close(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of Access Modal-->
                                                <button class="btn btn-danger btn-icon-split btn-sm" title="Delete"
                                                    onclick="window.location.href='<?= base_url(); ?>users/delete/<?= $users['uid']; ?>';">
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