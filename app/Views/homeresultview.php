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
                                                    <th style="color: black"><strong>COVER</strong></th>
                                                    <th style="color: black"><strong>DETAILS</strong></th>
                                                    <th style="color: black"><strong>COPIES & LOCATION</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($results)): ?>
                                                    <?php foreach($results as $res) : ?>
                                                        <tr>
                                                            <td style="color: black">
                                                                <a href="#" data-toggle="modal" data-target="#viewModal<?= $res['bookid']; ?>" style="color: black; text-decoration: none;">
                                                                    <img src="<?= $res['image']; ?>" alt="bookcover" height="90px">
                                                                </a>
                                                            </td>
                                                            <td style="color: black; text-align: left;">
                                                                <a href="#" data-toggle="modal" data-target="#viewModal<?= $res['bookid']; ?>" style="color: black; text-decoration: none;">
                                                                    <strong><?= $res['title']; ?></strong> - <?= $res['edition']; ?><br>
                                                                    <span><?= $res['authors']; ?></span><br>
                                                                    <span><?= $res['isbn']; ?></span><br>
                                                                    <span>
                                                                    <span style="font-size: 13px;">
                                                                        <?php foreach ($catlist as $catl): ?>
                                                                            <?php $catlid = $catl['catid']; ?>
                                                                            <?php if($catlid == $res['bookcatid']) : ?>
                                                                                <?= $catl['catname']; ?>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    </span><br>
                                                                </a>
                                                            </td>
                                                            <td style="color: black">
                                                                <a href="#" data-toggle="modal" data-target="#viewModal<?= $res['bookid']; ?>" style="color: black; text-decoration: none;">
                                                                    <span><strong>COPIES: </strong></span><?= $res['copies']; ?>pcs <br>
                                                                    <span><strong>LOCATION: </strong>
                                                                        <?php foreach ($catlist as $catl): ?>
                                                                            <?php $catlid = $catl['catid']; ?>
                                                                            <?php if($catlid == $res['bookcatid']) : ?>
                                                                                <?= $catl['catname']; ?>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    </span>
                                                                </a>
                                                            </td>

                                                            <!-- Edit Modal-->
                                                            <div class="modal fade" id="viewModal<?= $res['bookid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel" style="color: black;"><strong>BOOK DETAILS</strong></h5>
                                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true"><strong>×</strong></span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="card-body" style="text-align: left">
                                                                            <?php foreach ($booklist as $books): ?>
                                                                                <?php if($books['bookid'] === $res['bookid']): ?>
                                                                                    <?php $bimage = $books['image']; ?>
                                                                                    <?php $btitle = $books['title']; ?>
                                                                                    <?php $bedition = $books['edition']; ?>
                                                                                    <?php $bauthors = $books['authors']; ?>
                                                                                    <?php $bisbn = $books['isbn']; ?>
                                                                                    <?php $bissn = $books['issn']; ?>
                                                                                    <?php $bcallnumber = $books['callnumber']; ?>
                                                                                    <?php $bpublication = $books['publication']; ?>
                                                                                    <?php $bplaceofpub = $books['placeofpub']; ?>
                                                                                    <?php $bdateofpub = $books['dateofpub']; ?>
                                                                                    <?php $bdescription = $books['description']; ?>
                                                                                    <?php $bsubaddedentry = $books['subaddedentry']; ?>
                                                                                    <?php $bnotes = $books['notes']; ?>
                                                                                    <?php $bcontents = $books['contents']; ?>
                                                                                
                                                                                <div class="row">
                                                                                    <div class="col-lg-5" style="text-align: center">
                                                                                        <img src="<?= $bimage; ?>" alt="bookcover" class="logo">
                                                                                    </div>
                                                                                    <div class="col-lg-7">
                                                                                        <h4 style="color: black"><strong><?= $btitle; ?></strong></h4>
                                                                                        <span style="color: black;"><strong><?= $bedition; ?></strong></span>
                                                                                        <br>
                                                                                        <span style="color: black">AUTHORS: </span><span style="color: black;"><strong><?= $bauthors; ?></strong></span>
                                                                                        <br>
                                                                                        <span style="color: black">ISBN: </span><span style="color: black"><strong><?= $bisbn; ?></strong></span>
                                                                                        <br>
                                                                                        <span style="color: black">ISSN: </span><span style="color: black"><strong><?= $bissn; ?></strong></span>
                                                                                        <br>
                                                                                        <span style="color: black">CALL #: </span><span style="color: black"><strong><?= $bcallnumber; ?></strong></span>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <span style="color: black">PUBLICATION: </span><span style="color: black;"><strong><?= $bpublication; ?></strong></span>
                                                                                <br>
                                                                                <span style="color: black">PLACE OF PUBLICATION: </span><span style="color: black;"><strong><?= $bplaceofpub; ?></strong></span>
                                                                                <br>
                                                                                <span style="color: black">DATE OF PUBLICATION: </span><span style="color: black;"><strong><?= $bdateofpub; ?></strong></span>
                                                                                <br>
                                                                                <br>
                                                                                <span style="color: black">DESCRIPTION: </span><span style="color: black;"><strong><?= $bdescription; ?></strong></span>
                                                                                <br>
                                                                                <br>
                                                                                <span style="color: black">SUBJECT ADDED ENTRY: </span><span style="color: black;"><strong><?= $bsubaddedentry; ?></strong></span>
                                                                                <br>
                                                                                <br>
                                                                                <span style="color: black">NOTES: </span><span style="color: black;"><strong><?= $bnotes; ?></strong></span>
                                                                                <br>
                                                                                <br>
                                                                                <span style="color: black">CONTENTS: </span><span style="color: black;"><strong><?= $bcontents; ?></strong></span>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End of Edit Modal-->

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