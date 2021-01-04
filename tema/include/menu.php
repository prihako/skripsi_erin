

<!--BAGIAN MENU KIRI-->
<div class="container">
<div class="menu-kiri">
<div class="menu-kiri-title">
Menu navigasi
</div>
<div class="menu-kiri-isi"> 
<li><a href="index.php">Home</a></li>
<li><a href="http://localhost/al-ijtihad/index.php?page=panduan">Panduan</a></li>
<li><a href="http://localhost/al-ijtihad/index.php?page=pendaftaran">Registrasi</a></li>
<li><a href="http://localhost/al-ijtihad/index.php?page=informasi">Informasi</a></li>
<li><a href="http://localhost/al-ijtihad/index.php?page=erinabelajar">erinabelajar</a></li>
<li><a href="http://localhost/al-ijtihad/index.php?page=data-pendaftar">Data Pendaftar</a></li>
 
 </div> 
 
<div class="menu-kiri-title">
Menu Login
</div>
<div class="menu-kiri-isi">
<form action="<?php echo $loginFormAction; ?>" method="POST">
<input name="Username" type="text" placeholder="Username" />
<input name="Password" type="password" placeholder="Password" />
<input name="Login" type="submit" value="Login" class="btn btn-home" />
</form> 
<div class="clear">
</div>
</div>
</div>