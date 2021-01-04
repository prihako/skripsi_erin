<?php 

function UploadGaleri($fupload_name){
   //direktori untuk foto galeri
  $vdir_upload = "foto/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadGaleriV2($fupload_name, $tag_name){
   //direktori untuk foto galeri
  $vdir_upload = "foto/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["$tag_name"]["tmp_name"], $vfile_upload);
}
?>