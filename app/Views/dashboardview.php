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

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            No. of Books</div>
                                        <div class="h5 mb-0 font-weight-bold text-black-800" style="color: black;"><?= $countbooks; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-book fa-2x text-black-300" style="color: black;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total no. copy of books</div>
                                        <div class="h5 mb-0 font-weight-bold text-black-800" style="color: black;"><?= $sum; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-book fa-2x text-black-300" style="color: black;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total no. of borrowed books
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-black-800" style="color: black;"><?= $countborrow; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-black-300" style="color: black;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Total no. of E-books</div>
                                        <div class="h5 mb-0 font-weight-bold text-black-800" style="color: black;"><?= $countebooks; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-file fa-2x text-black-300" style="color: black;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->

                <div class="row">
                    <div class="col-xl-4 col-lg-7">
                        <div class="card shadow mb-4">
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">BORROWED BOOKS</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="color: black"><strong>BOOK</strong></th>
                                                <th style="color: black"><strong>DATE BORROW</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($borrowed as $br): ?>
                                                <tr>
                                                    <td style="color: black">
                                                        <?php foreach($acclist as $acl): ?>
                                                            <?php if($acl['accid'] === $br['baccid']): ?>
                                                                <?php foreach($booklist as $bl): ?>
                                                                    <?php if($bl['bookid'] === $acl['accbookid']): ?>
                                                                        <?= $bl['title']; ?>
                                                                        <span style="font-size: 13px; color: red;">|TRN-<?= $br['borrowid']; ?></span>
                                                                    <?php endif;?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td style="color: black"><?php echo $br['borrowdate']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-7">
                        <div class="card shadow mb-4">
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">DUE DATE</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="color: black"><strong>BOOK</strong></th>
                                                <th style="color: black"><strong>DUE DATE</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($borroweddue as $bwd): ?>
                                                <tr>
                                                    <td style="color: black">
                                                        <?php foreach($acclist as $acl): ?>
                                                            <?php if($acl['accid'] === $bwd['baccid']): ?>
                                                                <?php foreach($booklist as $bl): ?>
                                                                    <?php if($bl['bookid'] === $acl['accbookid']): ?>
                                                                        <?= $bl['title']; ?>
                                                                        <span style="font-size: 13px; color: red;">|TRN-<?= $bwd['borrowid']; ?></span>
                                                                    <?php endif;?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td style="color: black"><?php echo $bwd['duedateofreturn']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-7">
                        <div class="card shadow mb-4">
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">OVER DUE BOOKS</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="color: black"><strong>BOOK</strong></th>
                                                <th style="color: black"><strong>DUE DATE</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($borrowedoverdue as $bwod): ?>
                                                <tr>
                                                    <td style="color: black">
                                                        <?php foreach($acclist as $acl): ?>
                                                            <?php if($acl['accid'] === $bwod['baccid']): ?>
                                                                <?php foreach($booklist as $bl): ?>
                                                                    <?php if($bl['bookid'] === $acl['accbookid']): ?>
                                                                        <?= $bl['title']; ?>
                                                                        <span style="font-size: 13px; color: red;">|TRN-<?= $bwod['borrowid']; ?></span>
                                                                    <?php endif;?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td style="color: black"><?php echo $bwod['duedateofreturn']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
    <!-- ----------- FOOTER ------------------ -->
    <?php echo $this->include("partials/footer"); ?>
    <!-- ----------- END OF FOOTER ------------------ -->
    
<?php echo $this->endSection(); ?>
    