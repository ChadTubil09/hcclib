<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- LOGO - Dashboard -->
    <li class="nav-item active">
        <a class="sidebar-brand align-items-center justify-content-center" href="<?= base_url()?>dashboard">
            <div class="sidebar-brand-icon">
                <img src="<?php echo base_url(); ?>/public/baker/img/librarylogo.png" alt="logo" 
                class="logo">
                <p>HOLY CROSS COLLEGE<br>LIBRARY SYSTEM</p>
            </div>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url()?>dashboard">
            <i class="fas fa-fw fa-tachometer-alt" style="font-size: 20px;"></i>
            <span style="font-size: 18px;">DASHBOARD</span>
        </a>
    </li>
    <?php foreach($usersaccess as $usera): ?>
        <?php if($usera['acbooks'] == 1): ?>
            <?= '<li class="nav-item">
                    <a class="nav-link" href="'. base_url(); ?>.<?='/books">
                        <i class="fas fa-fw fa-book" style="font-size: 20px;"></i>
                        <span style="font-size: 18px;">BOOKS</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="'. base_url(); ?>.<?='/ebooks">
                        <i class="fas fa-fw fa-file" style="font-size: 20px;"></i>
                        <span style="font-size: 18px;">E-BOOKS</span>
                    </a>
                </li>' ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php foreach($usersaccess as $usera): ?>
        <?php if($usera['acborrow'] == 1): ?>
            <?= '<li class="nav-item">
                    <a class="nav-link" href="'. base_url(); ?>.<?='/borrow">
                        <i class="fas fa-fw fa-arrow-right" style="font-size: 20px;"></i>
                        <span style="font-size: 18px;">BORROW</span>
                    </a>
                </li>' ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php foreach($usersaccess as $usera): ?>
        <?php if($usera['acreturn'] == 1): ?>
            <?= '<li class="nav-item">
                    <a class="nav-link" href="'. base_url(); ?>.<?='/return">
                        <i class="fas fa-fw fa-arrow-left" style="font-size: 20px;"></i>
                        <span style="font-size: 18px;">RETURN</span>
                    </a>
                </li>' ?>
        <?php endif; ?>
    <?php endforeach; ?>
    
    <?php foreach($usersaccess as $usera): ?>
        <?php if($usera['aclogs'] == 1): ?>
            <?= '<li class="nav-item">
                    <a class="nav-link" href="'. base_url(); ?>.<?='/logs">
                        <i class="fas fa-fw fa-list" style="font-size: 20px;"></i>
                        <span style="font-size: 18px;">LOGS</span>
                    </a>
                </li>' ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php foreach($usersaccess as $usera): ?>
        <?php if($usera['acsystem'] == 1): ?>
            <?= '<!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    SYSTEM
                </div>

                <li class="nav-item">
                    <a class="nav-link" href="'. base_url(); ?>.<?='/users">
                        <i class="fas fa-fw fa-user" style="font-size: 20px;"></i>
                        <span style="font-size: 18px;">USERS</span>
                    </a>
                </li>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-cog" style="font-size: 20px;"></i>
                        <span style="font-size: 18px;">SETTINGS</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="'. base_url(); ?>.<?='/categories">BOOK CATEGORY</a>
                            <a class="collapse-item" href="'. base_url(); ?>.<?='/position">POSITION</a>
                            <div class="collapse-divider"></div>
                            <h6 class="collapse-header">Other Pages:</h6>
                            <a class="collapse-item" href="'. base_url(); ?>.<?='/archives">ARCHIVES</a>
                            <a class="collapse-item" href="'. base_url(); ?>.<?='/audit">AUDIT TRAIL</a>
                            <a class="collapse-item" href="'. base_url(); ?>.<?='/broken">BROKEN BOOKS</a>
                        </div>
                    </div>
                </li>' 
            ?>
        <?php endif; ?>
    <?php endforeach; ?>

    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->