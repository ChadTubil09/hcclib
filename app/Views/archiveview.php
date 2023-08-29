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
                            <h6 class="m-0 font-weight-bold text-primary">BOOKS ARCHIVE</h6>
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
                                            <th style="color: black"><strong>BOOK TITLE</strong></th>
                                            <th style="color: black"><strong>AUTHORS</strong></th>
                                            <th style="color: black"><strong>CATEGORY</strong></th>
                                            <th style="color: black"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($booklist as $books): ?>
                                            <tr>
                                                <td style="color: black"><?php echo $books['title']; ?></td>
                                                <td style="color: black"><?php echo $books['authors']; ?></td>
                                                <td style="color: black">
                                                    <?php foreach ($catlist as $catl): ?>
                                                        <?php $catlid = $catl['catid']; ?>
                                                        <?php if($catlid == $books['bookcatid']) : ?>
                                                            <?= $catl['catname']; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td style="text-align: center">
                                                    <button class="btn btn-primary btn-icon-split btn-sm" title="Restore"
                                                        onclick="window.location.href='<?= base_url(); ?>archives/books/<?= $books['bookid']; ?>';">
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
            <div class="row">
                <div class="col-lg-12">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">USERS ARCHIVE</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php if(session()->getTempdata('usersdeletesuccess')) :?>
                                <div class="alert alert-success">
                                    <?= session()->getTempdata('usersdeletesuccess');?>
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
                                                    <button class="btn btn-primary btn-icon-split btn-sm" title="Restore"
                                                        onclick="window.location.href='<?= base_url(); ?>archives/users/<?= $users['uid']; ?>';">
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
            <div class="row">
                <div class="col-lg-6">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">POSITIONS ARCHIVE</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php if(session()->getTempdata('positiondeletesuccess')) :?>
                                <div class="alert alert-success">
                                    <?= session()->getTempdata('positiondeletesuccess');?>
                                </div>
                            <?php endif; ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="color: black"><strong>ID</strong></th>
                                            <th style="color: black"><strong>POSITION</strong></th>
                                            <th style="color: black"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($posdata as $positiondata): ?>
                                            <tr>
                                                <td style="color: black">U-<?php echo $positiondata['posid']; ?></td>
                                                <td style="color: black"><?php echo $positiondata['posname']; ?></td>
                                                <td style="text-align: center">
                                                    <button class="btn btn-parimary btn-icon-split btn-sm" title="Restore"
                                                        onclick="window.location.href='<?= base_url(); ?>archives/position/<?= $positiondata['posid']; ?>';">
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
                <div class="col-lg-6">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">CATEGORIES ARCHIVE</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php if(session()->getTempdata('categorydeletesuccess')) :?>
                                <div class="alert alert-success">
                                    <?= session()->getTempdata('categorydeletesuccess');?>
                                </div>
                            <?php endif; ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="color: black"><strong>ID</strong></th>
                                            <th style="color: black"><strong>CATEGORY</strong></th>
                                            <th style="color: black"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cat as $catt): ?>
                                            <tr>
                                                <td style="color: black">U-<?php echo $catt['catid']; ?></td>
                                                <td style="color: black"><?php echo $catt['catname']; ?></td>
                                                <td style="text-align: center">
                                                    <button class="btn btn-primary btn-icon-split btn-sm" title="Restore"
                                                        onclick="window.location.href='<?= base_url(); ?>archives/category/<?= $catt['catid']; ?>';">
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