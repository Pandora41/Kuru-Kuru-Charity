<?php


include('connect.php');

if (isset($_GET['no']) && $_GET['no'] != "" ) {
$no = $_GET['no'];

$query = mysqli_query($connect, "SELECT * FROM kwitansi_masuk WHERE `no` = '$no'");
$results = mysqli_fetch_all ($query, MYSQLI_ASSOC); 

$nama = $results[0]['nama'];
$kelas = $results[0]['kelas'];
$nominal = $results[0]['jumlah_bayar'];
$tanggal = $results[0]['tanggal_cetak'];
$nis = $results[0]['nis'];
} else {
    $nis = $_GET['nis'];
    $bulan = strtolower($_GET['bulan']); 
    $query = mysqli_query($connect, "SELECT * FROM pemasukan WHERE nis='$nis' LIMIT 1");
    $results = mysqli_fetch_all ($query, MYSQLI_ASSOC);
    $nama = $results[0]['nama'];
    $kelas = $results[0]['kelas'];
    $nominal = $results[0][$bulan];
    $tanggal = $results[0]['tanggal_'. $bulan];
}



// Memanggil library FPDF
require('fpdf/fpdf.php');
// Membuat objek FPDF
$pdf = new FPDF('L','mm','A5');
// Menambah halaman baru
$pdf->AddPage();
// Mengatur font
$pdf->SetFont('Arial','B',16);
// Mencetak judul
$pdf->Cell(190,7,'KUITANSI SUMBANGAN SMKN2 BANDUNG',0,1,'C');
// Mencetak garis
$pdf->Line(10, 18, 200, 18);
$pdf->Ln();
// Mengatur font
$pdf->SetFont('Arial','',12);
// Mencetak data kwitansi
$pdf->Cell(30,7,'No Kwitansi',0,0);
$pdf->Cell(5,7,':',0,0);
// Mengambil data nis dari form sebelumnya
$pdf->Cell(155,7,$no,0,1);
$pdf->Cell(30,7,'NIS',0,0);
$pdf->Cell(5,7,':',0,0);
// Mengambil data nis dari form sebelumnya
$pdf->Cell(155,7,$nis,0,1);
$pdf->Cell(30,7,'Nama Siswa',0,0);
$pdf->Cell(5,7,':',0,0);
// Mengambil data nama dari form sebelumnya
$pdf->Cell(155,7,$nama,0,1);
$pdf->Cell(30,7,'Kelas',0,0);
$pdf->Cell(5,7,':',0,0);
// Mengambil data kelas dari form sebelumnya
$pdf->Cell(155,7,$kelas,0,1);
$pdf->Cell(30,7,'Jumlah Uang',0,0);
$pdf->Cell(5,7,':',0,0);
// Mengambil data nominal dari form sebelumnya
$pdf->Cell(155,7,'Rp. '.$nominal.',-',0,1);
$pdf->Cell(30,7,'Tanggal',0,0);
$pdf->Cell(5,7,':',0,0);
// Mengambil data tanggal dari form sebelumnya
$pdf->Cell(155,7,$tanggal,0,1);
// Mencetak tanda tangan
$pdf->Ln();
$pdf->Cell(140);
$pdf->Cell(30,6,'Tanda Tangan,',0,1,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(140);
$pdf->Cell(30,6,$nama,0,1,'C');
// Menyimpan file PDF
$pdf->Output()
?>
