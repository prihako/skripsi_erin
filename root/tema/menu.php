
<!--BAGIAN MENU KIRI-->
<div class="container">
<div class="menu-kiri">
<div class="menu-kiri-title">
Menu navigasi
</div>
<div class="menu-kiri-isi"> 
<li><a href="index.php">Home</a></li>
<li><?php echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad' target='_blank'>Lihat Web</a>" ?></li>
<li><?php echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=admin'>Manajemen Admin</a>" ?></li>
<li><?php echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=mata-pelajaran'>Manajement Mata Pelajaran</a>" ?></li>
<li><?php echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=waktutes'>Waktu Test</a>" ?></li>
<li><?php echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=verifikasi-pemb'>Verifikasi Pembayaran</a>" ?></li>
<li><?php echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=verifikasi-berkas'>Verifikasi Berkas</a>" ?></li>
<li><?php echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=siswa'>Cek Pendaftaran</a>" ?></li>
<li><?php echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=input-nilai'>Input Nilai Test</a>" ?></li>
<!--<li><?php echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=cetak-pendaftaran'>Cetak Pendaftaran</a>" ?></li>-->
<li><?php echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/hasil_psb/cetak-psb.php'>Cetak Hasil PSB</a>" ?></li>
<li><?php echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=pengumuman'>Pengumuman</a>" ?></li>
<li><a href="<?php echo $logoutAction ?>">Keluar</a></li>
 
 </div> 
<div class="clear">
</div>
</div>
</div>