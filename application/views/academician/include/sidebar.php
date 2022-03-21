<ul
    class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
    id="accordionSidebar"
    >
    <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="#"
    >
        <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
        </div>
        <?php $info = $this->session->userdata("info"); ?>
        <div class="sidebar-brand-text mx-3">Hoşgeldin <sup style="font-size:8px"><?php echo $info->email; ?></sup></div>
    </a>
    <hr class="sidebar-divider" />
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url("academician/academicianPanel/lessons/$info->teacherNumber") ?>">
        <span>Derslerim</span></a
        >
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url("academician/academician/logOut") ?>">
            <span>Çıkış Yap</span>
        </a>
    </li>
</ul>