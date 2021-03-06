<?php

$bulan = array(
    "01" => "Januari",
    "02" => "Februari",
    "03" => "Maret",
    "04" => "April",
    "05" => "Mei",
    "06" => "Juni",
    "07" => "Juli",
    "08" => "Agustus",
    "09" => "September",
    "10" => "Oktober",
    "11" => "November",
    "12" => "Desember"
);

include "assets/phpqrcode/qrlib.php";

//direktory tempat menyimpan hasil generate qrcode jika folder belum dibuat maka secara otomatis akan membuat terlebih dahulu
$tempdir = "temp/";
if (!file_exists($tempdir))
    mkdir($tempdir);
$text = "ROK Subbag/Seksi/UPT - " . $seksi->nama . ". Dibuat Dengan Aplikasi Si Kupat Dinas Kesehatan Kab. Jepara pada " . date("Y-m-d H:i:s");

//namafile setelah jadi qrcode
$namafile = "ROK - " . date("YmdHis") . ".png";
//kualitas dan ukuran qrcode
$quality = 'H';
$ukuran = 4;
$padding = 0;

QRCode::png($text, $tempdir . $namafile, QR_ECLEVEL_H, $ukuran, $padding);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak ROK</title>
    <link rel="shortcut icon" href="<?php echo base_url(LOGO); ?>" type="image/x-icon">

    <style>
        @media print {
            body {
                margin-top: 0mm;
                margin-bottom: 5mm;
                margin-left: 10mm;
                margin-right: 10mm
            }
        }

        td {
            font-size: 14px
        }

        .head1 {
            font-family: Arial;
            font-size: 14pt
        }

        .head2 {
            font-family: Arial;
            font-size: 18pt
        }

        .head3 {
            font-family: Arial;
            font-size: 12pt
        }
    </style>
</head>

<body onload="window.print()">
    <table border="0" style="border-collapse:collapse; border-bottom:3px solid" width="100%">
        <thead>
            <tr>
                <th width="20%">
                    <img src="<?php echo base_url(LOGO_JEPARA); ?>" width="85px" style="padding: 5px 5px 5px 5px; border: 0px solid">
                </th>
                <td align="center">
                    <h2 class="head1" style="margin-bottom:-10px">PEMERINTAH KABUPATEN JEPARA</h2>
                    <h1 class="head2" style="margin-bottom:-10px">DINAS KESEHATAN</h1>
                    <p class="head3" style="margin-bottom:-10px">Jalan Kartini Nomor 44 Telp (0291)591427, 591743 Fax (0291)591427</p>
                    <p class="head3" style="margin-bottom:-10px">E-mail : dinkeskabjepara@yahoo.co.id</p>
                    <p class="head3">JEPARA Kode Pos 59411</p>
                </td>
            </tr>
        </thead>
    </table>
    <br>
    <table border="0" width="100%">
        <thead>
            <tr>
                <th>
                    <h1 class="head1" style="margin-top: 0; margin-bottom: 0;">Rencana Operasional Kegiatan (ROK)</h1>
                </th>
            </tr>
        </thead>
    </table>
    <br>
    <table style="border-collapse:collapse;" border="1" width="100%">
        <tr>
            <td width="20%" valign="top">Kegiatan</td>
            <td valign="top"><?= $kegiatan->kode_kegiatan . " - " . $kegiatan->nama_kegiatan; ?></td>
            <td width="30%" rowspan="6" align="center" valign="middle">
                <img src="<?= site_url("../temp/" . $namafile); ?>" width="80px" style="padding: 5px 5px 5px 5px; border: 1px solid">
            </td>
        </tr>
        <tr>
            <td valign="top">Sub Kegiatan</td>
            <td valign="top"><?= $kegiatan->kode_sub_kegiatan . " - " . $kegiatan->nama_sub_kegiatan; ?></td>
        </tr>
        <tr>
            <td valign="top">Subbag/ Seksi/ UPT</td>
            <td valign="top"><?= $seksi->nama; ?></td>
        </tr>
        <tr>
            <td valign="top">Bulan</td>
            <td valign="top"><b><?= $bulan[$bln]; ?></b></td>
        </tr>
        <tr>
            <td valign="top">Pagu Sub Kegiatan</td>
            <td valign="top"><b><?= number_format($rincian["pagu"], 0, ",", "."); ?></b></td>
        </tr>
        <tr>
            <td valign="top">RAK s.d. TW <?= $rincian["rak_tw"]["tw"]; ?></td>
            <td valign="top"><b><?= number_format($rincian["rak_tw"]["nominal"], 0, ",", "."); ?></b></td>
        </tr>
    </table>
    <br>
    <table style="border-collapse:collapse;" border="1" width="100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Uraian Kegiatan</th>
                <th width="15%">Nominal</th>
                <th width="15%">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($rok as $row => $val) : ?>
                <?php $total = $total + $val["total_rok"]; ?>
                <tr style="background-color: lightgrey;">
                    <td colspan="2">
                        <b><?= $val["kode_rekening"] . " - " . $val["nama_rekening"]; ?></b>
                    </td>
                    <td></td>
                    <td align="right">
                        <b><?= number_format($val["total_rok"], 0, ",", "."); ?></b>
                    </td>
                </tr>
                <?php if ($val["rok"] != "") : ?>
                    <?php $no = 1; ?>
                    <?php foreach ($val["rok"] as $row2) : ?>
                        <tr>
                            <td valign="top"><?= $no++; ?></td>
                            <td valign="top">
                                <?= $row2->uraian; ?>
                                <p style="margin-top: 0; margin-bottom: 0;"><?= $row2->keterangan; ?></p>
                            </td>
                            <td align="right" valign="top"><?= number_format($row2->nominal, 0, ",", "."); ?></td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr style="background-color: lightgrey;">
                <td colspan="3" align="right">
                    <b>TOTAL ROK</b>
                </td>
                <td align="right">
                    <b><?= number_format($total, 0, ",", "."); ?></b>
                </td>
            </tr>
        </tbody>
    </table>
    <?php if ($kegiatan->bagi != 1) : ?>
        <!-- <br>
        <table style="border-collapse:collapse;" border="1" width="50%">
            <tbody>
                <tr>
                    <td align="center" width="50%">RAK Bulan ini :</td>
                    <td align="center">Sisa ROK Bulan Kemarin :</td>
                </tr>
                <tr>
                    <td align="center"><b><?= $rak; ?></b></td>
                    <td align="center"><b><?= $sisa; ?></b></td>
                </tr>
            </tbody>
        </table> -->
    <?php endif; ?>
    <br>
    <table border="0" style="border-collapse: collapse;" width="100%">
        <tr>
            <td width="45%" style="vertical-align: top;">
                <table style="border-collapse: collapse;" border="0" width="100%">
                    <tr>
                        <td width="59%">Target s.d. bulan ini</td>
                        <td width="1%">:</td>
                        <td align="right"><b><?= number_format($rincian["rak_bln_ini"], 0, ",", "."); ?></b></td>
                    </tr>
                    <tr>
                        <td>Realisasi s.d. bulan lalu</td>
                        <td>:</td>
                        <td align="right"><b><?= number_format($rincian["realisasi"], 0, ",", "."); ?></b></td>
                    </tr>
                    <tr>
                        <td valign="top">Persen s.d. bulan lalu</td>
                        <td valign="top">:</td>
                        <td valign="top"><b><?= number_format($rincian["persen"], 2, ",", "."); ?>%</b><br>(Target 100%)</td>
                    </tr>
                </table>
            </td>
            <td></td>
            <td width="45%" style="vertical-align: top;">
                <table style="border-collapse: collapse;" border="0" width="100%">
                    <tr>
                        <td width="59%">Sisa ROK bulan kemarin</td>
                        <td width="1%">:</td>
                        <td align="right"><b><?= number_format($sisa, 0, ",", "."); ?></b></td>
                    </tr>
                    <tr>
                        <td>RAK bulan ini</td>
                        <td>:</td>
                        <td align="right"><b style="text-decoration: underline;"><?= number_format($rak, 0, ",", "."); ?></b></td>
                    </tr>
                    <?php
                    $jml_a = $rak + $sisa;
                    ?>
                    <tr>
                        <td align="right"><b>Jumlah (a)</b></td>
                        <td></td>
                        <td align="right"><b><?= number_format($jml_a, 0, ",", "."); ?></b></td>
                    </tr>
                    <tr>
                        <td>ROK bulan ini (b)</td>
                        <td>:</td>
                        <td align="right"><b><?= number_format($total, 0, ",", "."); ?></b></td>
                    </tr>
                    <?php $persen = ($jml_a > 0) ? ($jml_a / $total) * 100 : 0; ?>
                    <tr>
                        <td valign="top">Persentase (a dan b)</td>
                        <td valign="top">:</td>
                        <td valign="top"><b><?= number_format($persen, 2, ",", "."); ?>%</b><br>(Target 100%)</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table border="0" width="100%">
        <tr>
            <td width="40%">
                <table border="1" style="border-collapse:collapse;" width="100%">
                    <tr>
                        <td align="center" colspan="4"><b>PERSETUJUAN</b></td>
                    </tr>
                    <tr>
                        <td width="10%" align="center"><b>No</b></td>
                        <td width="75%" align="center"><b>JABATAN</b></td>
                        <td align="center"><b>PARAF</b></td>
                    </tr>
                    <tr>
                        <td align="center">1</td>
                        <td>Sekretaris Dinas</td>
                        <td width="15%"></td>
                    </tr>
                    <tr>
                        <td align="center">2</td>
                        <td>PPTK</td>
                        <td width="15%"></td>
                    </tr>
                    <tr>
                        <td align="center">3</td>
                        <td>PPK</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="center">4</td>
                        <td>Ka. Subbag/ Seksi/ UPT ...................</td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td></td>
            <td width="40%" style="vertical-align: top;">
                <p style="margin-bottom:-10px; margin-top: 0;">Jepara, <?php echo date("d-m-Y"); ?></p>
                <p style="margin-bottom:-10px">Kepala Dinas Kesehatan</p>
                <p>Kabupaten Jepara</p>
                <br><br>
                <p style="margin-bottom:-10px; text-decoration: underline">MUDRIKATUN, S.SiT, SKM, MM.Kes, MH</p>
                <p>NIP. 19690610 199003 2 010</p>
            </td>
        </tr>
    </table>
</body>

</html>