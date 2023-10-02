<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sewa Stadion</title>
    <link rel="shortcut icon" href="assets/images/pemkab.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/w3.css">
    <link rel="stylesheet" href="assets/css/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Condensed:ital@1&display=swap"
        rel="stylesheet">



    <style>
    body {
        padding-top: 60px;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        font-size: 3px;
        align-items: center;
        margin: 0;
        display: flex;
    }

    .card {
        width: 300px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 10px;
        margin: 0 100px;
        /* Jarak antara kedua card */

    }

    /* Gaya CSS untuk judul card */
    .card h2 {
        font-size: 24px;
        margin: 0;
        color: #333;
    }

    /* Gaya CSS untuk deskripsi card */
    .card p {
        font-size: 16px;
        margin: 10px 0;
        color: #777;
    }

    .card img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .card:hover {
        transform: scale(1.02);
        /* Memperbesar card saat hover */
        box-shadow: 0px 0px 10px rgb(240, 240, 240);
        /* Menambah efek bayangan saat hover */
    }

    .cool-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #3498db;
        color: #fff;
        font-size: 13px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .cool-button:hover {
        background-color: #2980b9;
    }

    .price-list {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .price-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #ccc;
    }

    .garis-lurus {
        border: 1px solid #ccc;
        margin: 10px 0;
    }

    .cool-button {
        padding: 10px 20px;
        background-color: crimson;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .modal-title {
        color: #424e5e;
    }

    a {
        color: #870000;
    }

    /* Add a gray background color and some padding to the footer */
    footer {
        background-color: #f2f2f2;
        padding: 25px;
    }

    .carousel-inner img {
        width: 100%;
        /* Set width to 100% */
        margin: auto;
        min-height: 200px;
    }

    /* Hide the carousel text when the screen is less than 600 pixels wide */
    @media (max-width: 600px) {
        .carousel-caption {
            display: none;
        }
    }
    </style>
</head>

<body>
    <?php 
include "koneksi.php";
$tanggal = date('Y-m-d', time()+60*60*6); //variabel berisi tanggal sekarang
$jam = date('H:i:s', time()+60*60*6); //variabel berisi jam sekarang
$tanggaljam = date('Y-m-d H:i:s', time()+60*60*6); //variabel berisi tanggal dan jam sekarang
//echo $tanggaljam;
//$tanggaljam1 = '2016-12-30 10:00:00';
$tanggal1 = '2017-01-01';
//$jam1 = '10:00:00';
$cektr = mysqli_query($koneksi,"select * from transaksi");
$cek = mysqli_num_rows($cektr);
$les = mysqli_fetch_array($cektr);

if($cek > 0){
//Dibatalkan jika bayar transfer dan telah melewati batas bayar
mysqli_query($koneksi, "update transaksi set status='Dibatalkan' where batas_bayar <= '$tanggaljam' && jenis_bayar = 'transfer' && (status!='Telah Dikonfirmasi' && status!='Selesai')");
//Dibatalkan jika bayar cod , statusnya masih belum transfer dan telah melewati batas bayar
mysqli_query($koneksi, "update transaksi set status='Dibatalkan' where batas_bayar <= '$tanggaljam' && jenis_bayar = 'cod' && (status='Menunggu Pembayaran')");
//Dibatalkan jika bayar off cod(pesan secara langsung ke operator) , statusnya masih belum transfer dan telah melewati batas bayar
mysqli_query($koneksi, "update transaksi set status='Dibatalkan' where batas_bayar <= '$tanggaljam' && jenis_bayar = 'off cod' && (status='Belum Bayar')");
//Selesai jika jam berakhir telah melewati waktu sekarang
mysqli_query($koneksi, "update transaksi set status='Selesai' where ((tgl_main <='$tanggal' && jam_berakhir <='$jam') || (tgl_main <='$tanggal' && jam_berakhir >='$jam')) && (status!='Dibatalkan' && status!='Selesai')");
	}
?>
    <?php
  include "navbar.php";
    include "member_login.php";
    include "opt_login.php";
     ?>

    <!-- Page Container -->


    <?php
		$qry = "select * from lapangan";
		$ck = mysqli_query($koneksi,$qry);
		$cek = mysqli_num_rows($ck);
		
		if($cek <> 0){?>
    <!-- Left Column -->

    <!-- Middle Column -->
    <!-- <div class="w3-col m9" style="margin-top:-10px;"> -->
    <?php
    $batas = 3;
    $pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";

    if ( empty( $pg ) ) {
    $posisi = 0;
    $pg = 1;
    } else {
    $posisi = ( $pg - 1 ) * $batas;
    }

    $sql = mysqli_query($koneksi,"select lapangan.*, operator.alamat_futsal, operator.kota, operator.nama_futsal from lapangan inner join operator on (lapangan.username=operator.username) limit $posisi, $batas");
    $no = 1+$posisi;
    while ( $r = mysqli_fetch_array( $sql ) ) {
    ?>






    <div class="card">
        <img src="operator/assets/foto_lap/<?php echo $r['foto']; ?>">
        <hr class="garis-lurus">
        <form action="transaksi.php" method="post">
            <input type="hidden" name="id_lap" value="<?php echo $r['id_lap']; ?>">

            <i class="fa fa-home" aria-hidden="true"></i>&nbsp;:&nbsp;<?php echo $r['nama_futsal']; ?><br><br>
            <i class="fa fa-location-arrow"
                aria-hidden="true"></i>&nbsp;:&nbsp;<?php echo $r['alamat_futsal']; ?><br><br>
            <!-- <i class="fa fa-list-alt" aria-hidden="true"></i> Sewa Stadion Nomor&nbsp;<?php echo $r['no_lap']; ?><br><br> -->
            <!-- <i class="fa fa-life-ring" aria-hidden="true"></i> Lapangan <?php echo $r['jenis_rumput']; ?><br><br> -->
            <i class="fa fa-tags" aria-hidden="true"></i>&nbsp;: Rp. <?php echo $r['harga']; ?> per 3 jam<br><br>
            <hr class="garis-lurus">
            <button type="submit" class="cool-button"><i class="glyphicon glyphicon-book"></i>  Pesan</button>
            <!-- <div class="w3-right"> -->
        </form>
    </div>
    </div>
    </div>


    <?php
    
    $no++;
    }
    ?>
    <?php
    //hitung jumlah data
    $jml_data = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM lapangan"));
    //Jumlah halaman
    $JmlHalaman = ceil($jml_data/$batas); //ceil digunakan untuk pembulatan keatas

    //Navigasi ke sebelumnya
    // if ( $pg > 1 ) {
    // $link = $pg-1;
    // $prev = "<li><a href='?pg=$link' aria-label='previous'>
    //         <span aria-hidden='true'>&laquo;</span>
    //       </a></li>";
    // } else {
    // $prev = "<li class='disabled'><a href='' aria-label='previous'>
    //         <span aria-hidden='true'>&laquo;</span>
    //       </a></li>";
    // }

    // //Navigasi nomor
    // $nmr = '';
    // for ( $i = 1; $i<= $JmlHalaman; $i++ ){

    // if ( $i == $pg ) {
    // $nmr .= "<li class='active'><a href='#'>$i <span class='sr-only'>(current)</span></a></li>";
    // } else {
    // $nmr .= "<li><a href='?pg=$i'>$i</a></li>";
    // }
    // }

    // //Navigasi ke selanjutnya
    // if ( $pg < $JmlHalaman ) {
    // $link = $pg + 1;
    // $next = "<li><a href='?pg=$link' aria-label='Next'>
    //         <span aria-hidden='true'>&raquo;</span>
    //       </a></li>";
    // } else {
    // $next = "<li class='disabled'><a href='' aria-label='Next'>
    //         <span aria-hidden='true'>&raquo;</span>
    //       </a></li>";
    // }

    //Tampilkan navigasi
    // echo $prev . $nmr . $next;
    ?>
    <!-- <nav class="Page navigation">
      <ul class="pagination">
        <?php echo $prev; ?>
        
         <?php echo $nmr; ?>
       
          <?php echo $next; ?>
        
      </ul>
    </nav> -->

    <?php
		} else {
	 ?>
    <h4 align="center">Tidak Ada Data</h4>
    <?php
		}
		  
	 ?>

    <!-- End Middle Column -->
    </div>

    <!-- End Grid -->
    </div>

    <!-- End Page Container -->
    </div>
    <br>



    </div>
    </div>
    <?php include ("footer.php"); ?>

</body>

</html>