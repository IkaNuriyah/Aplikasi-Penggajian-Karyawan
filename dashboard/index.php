<?php
include('../_header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <font style="font-family: Algerian" size="7" color="#376E6F">
            <center><b> PT. KIRITO SAN </b></center>
        </font>
        <p style="display:none;">Selamat Datang <?= $_SESSION['user']; ?> </p>
        <p></p><br><br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Ika Nuriyah</h2>
            </div>
            <div class="panel-body">
                <div class="well"><span style="color: #008080; font-weight:bolder;">Aplikasi Prakarya Pemrograman Web Lanjut</span></div>
            </div>
            </div>            
        </div>

        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>

    </div>
</div>

<?php include('../_footer.php'); ?>