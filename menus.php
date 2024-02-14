<?php

class menus
{


    public function nav($value, $act)
    {
        $cd = '<div id="header">';
        $cd .= '<div class="shell">';
        // <!-- Logo + Top Nav -->
        $cd .= '<div id="top">';
        $cd .= '<h1><a href="#">Argajaladri</a></h1>';
        $cd .= '<div id="top-navigation"> Welcome <a href="#"><strong>';
        $cd .= $value;
        $cd .= '</strong></a> <span>|</span> <a href="#">Help</a> <span>|</span> <a href="#">Profile';
        $cd .= 'Settings</a> <span>|</span> <a href="logout.php">Log out</a> </div>';
        $cd .= '</div>';
        //<!-- End Logo + Top Nav -->
        //<!-- Main Nav -->
        $cd .= '<div id="navigation">';
        $cd .= '<ul>';
        $cd .= '<li><a href="index.php"';
        if ($act == 'dashboard')
            $cd .= 'class="active"';
        $cd .= '><span>Dashboard</span></a></li>';

        $cd .= '<li><a href="angkatan.php" ';
        if ($act == 'angkatan')
            $cd .= 'class="active"';
        $cd .= '><span>Angkatan</span></a></li>';


        $cd .= '<li><a href="anggota.php"';
        if ($act == 'anggota')
            $cd .= 'class="active"';
        $cd .= '><span>Anggota</span></a></li>';

        $cd .= '<li><a href="#"><span>Galeri</span></a></li>';
        $cd .= '<li><a href="#"><span>Pengurus</span></a></li>';
        $cd .= '<li><a href="#"><span>Program Kerja</span></a></li>';
        $cd .= '</ul>';
        $cd .= '</div>';
        // <!-- End Main Nav -->
        $cd .= '</div>';
        $cd .= '</div>';

        return $cd;
    }

    public function start_container($value)
    {
        $start = '<div id="container">';
        $start .= '<div class="shell">';
        // <!-- Small Nav -->
        $start .= '<div class="small-nav"> <a href="#">' . $value;

        $start .= '</a> <span>&gt;</span> Current Articles </div>';


        // <!-- End Small Nav -->

        // <!-- Main -->
        $start .= '<div id="main">';
        $start .= '<div class="cl">&nbsp;</div>';

        return $start;
    }

    public function end_container()
    {
        $end = '<div class="cl">&nbsp;</div>';
        $end .= '</div>'; // <!-- end Main -->
        $end .= '</div>';
        $end .= '</div>';

        return $end;
    }

    public function footers()
    {
        $f = '<div id="footer">';
        $f .= '<div class="shell">';
        $f .= '<span class="left">&copy; 2020 - Argajaladri V.1</span>';
        $f .= '<span class="right"><a href="https://rahman115.github.io/member.argajaladri.or.id/">PATH</a> </span>';
        $f .= '<span class="right"> | </span>';
        $f .= '<span class="right"> Design by <a href="https://abuduchoy.my.id">abuduchoy.my.id</a> </span>';
        
        $f .= '</div>';
        $f .= '</div>';

        return $f;
    }
}

?>