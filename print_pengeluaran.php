<?php
include('connect.php');

if (isset($_GET['no']) && $_GET['no'] != "") {
    $no = $_GET['no'];

    $query = mysqli_query($connect, "SELECT * FROM kwitansi_keluar WHERE `no` = '$no'");
    $results = mysqli_fetch_assoc($query);

    $keterangan = $results['keterangan'];
    $nominal = $results['jumlah'];
    $tanggal = $results['tanggal_cetak'];
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
$pdf->Cell(190,7,'KUITANSI PENGELUARAN SUMBANGAN SMKN2 BANDUNG',0,1,'C');
// Mencetak garis
$pdf->Line(10, 18, 200, 18);
$pdf->Ln();
// Mengatur font
$pdf->SetFont('Arial','',12);
// Mencetak data kwitansi
$pdf->Cell(30,7,'No Kwitansi',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(155,7,$no,0,1);
$pdf->Cell(30,7,'Keterangan',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(155,7,$keterangan,0,1); // Mencetak keterangan
$pdf->Cell(30,7,'Jumlah Uang',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(155,7,'Rp. '.$nominal.',-',0,1); // Mencetak nominal
$pdf->Cell(30,7,'Tanggal',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(155,7,$tanggal,0,1);
// Mencetak tanda tangan
$pdf->Ln();
$pdf->Cell(140);
$pdf->Cell(30,6,'Tanda Tangan,',0,1,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(140);
$pdf->Cell(30,6,"Komite",0,1,'C');
// Menyimpan file PDF
$pdf->Output();
?>
