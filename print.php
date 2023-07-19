<?php
// Memanggil library FPDF
require('fpdf/fpdf.php');
// Membuat objek FPDF
$pdf = new FPDF('L','mm','A5');
// Menambah halaman baru
$pdf->AddPage();
// Mengatur font
$pdf->SetFont('Arial','B',16);
// Mencetak judul
$pdf->Cell(190,7,'KWITANSI SUMBANGAN SMKN2 BANDUNG',0,1,'C');
// Mencetak garis
$pdf->Line(10, 18, 200, 18);
$pdf->Ln();
// Mengatur font
$pdf->SetFont('Arial','',12);
// Mencetak data kwitansi
$pdf->Cell(30,7,'NIS',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(155,7,'123456789',0,1);
$pdf->Cell(30,7,'Nama Siswa',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(155,7,'AKHTAR KOCAK GEMING',0,1);
$pdf->Cell(30,7,'Kelas',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(155,7,'X-PPLG-1',0,1);
$pdf->Cell(30,7,'Jumlah Uang',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(155,7,'Rp. 500.000,-',0,1);
$pdf->Cell(30,7,'Tanggal',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(155,7,'19 Juli 2023',0,1);
// Mencetak tanda tangan
$pdf->Ln();
$pdf->Cell(140);
$pdf->Cell(50,6,'Tanda Tangan,',0,1,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(140);
$pdf->Cell(50,6,'AKHTAR KOCAK GEMING',0,1,'C');
// Menyimpan file PDF
$pdf->Output()
?>
