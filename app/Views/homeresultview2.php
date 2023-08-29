<?php $this->extend("layouts/opac"); ?>

<?php $this->section("title"); ?>
    <?php echo $page_title; ?>
<?php $this->endSection(); ?>

<?php echo $this->section('content'); ?>

<!-- <body style="background-image: url(<?php echo base_url(); ?>/public/assets/img/hccnewlypainted2.jpg)"> -->
<body style="background-color: #263B57">
    <div class="card o-hidden shadow-lg my-3" style="margin-left: 1%; margin-right: 1%;">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12 d-lg-block" style="text-align: center;">
                    <img src="<?php echo base_url(); ?>/public/baker/img/librarybanner.png" alt="Logo" width="70%">
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-lg-12 d-lg-block" style="text-align: center;">
                                <?php echo form_open('result'); ?>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <select name="book" class="form-control bg-light border-0 small" style="color: black;">
                                                <option value="books"><strong>BOOK</strong></option>
                                                <option value="ebooks"><strong>E-BOOK</strong></option>
                                            </select>
                                        </div>
                                        &nbsp
                                        <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..."
                                        aria-label="Search" aria-describedby="basic-addon2" style="color: black;">
                                        <div class="input-group-append">
                                            <input type="submit" name="login" value="SEARCH" class="btn btn-success btn-user btn-block">
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-lg-12 d-lg-block" style="text-align: center;">
                                
                                <div class="card">
                                    <div class="card-header" style="color: black">
                                        <strong>SEARCH RESULT</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="color: black"><strong>DETAILS</strong></th>
                                                    <th style="color: black"><strong>LINK</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($results)): ?>
                                                    <?php foreach($results as $res) : ?>
                                                        <tr>
                                                            <td style="color: black; text-align: left;">
                                                                <strong><?= $res['ebtitle']; ?></strong><br>
                                                                <span><?= $res['ebauthors']; ?></span><br>
                                                            </td>
                                                            <td style="color: black; text-align: left;">
                                                                <strong><a href="<?= $res['eblink']; ?>" target="blank"><?= $res['eblink']; ?></a></strong>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php echo $this->endSection(); ?>