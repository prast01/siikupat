<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak RAK</title>
    <link rel="shortcut icon" href="<?php echo base_url(LOGO); ?>" type="image/x-icon">

    <style>
        @media print {
            body {
                margin-top: 0mm;
                margin-bottom: 5mm;
                margin-left: 5mm;
                margin-right: 5mm
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
                    <h2 class="head1" style="margin-bottom:-15px">PEMERINTAH KABUPATEN JEPARA</h2>
                    <h1 class="head2" style="margin-bottom:-15px">DINAS KESEHATAN</h1>
                    <p class="head3" style="margin-bottom:-15px">Jalan Kartini Nomor 44 Telp (0291)591427, 591743 Fax (0291)591427</p>
                    <p class="head3" style="margin-bottom:-15px">E-mail : dinkeskabjepara@yahoo.co.id</p>
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
                    <h1 class="head1" style="margin-top: 0; margin-bottom: 0;">Rencana Anggaran Kas (RAK)</h1>
                </th>
            </tr>
        </thead>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse;" border="1">
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="10%">Nama Sub Kegiatan</th>
                <th>Pelaksana</th>
                <?php foreach ($bln as $row => $val) : ?>
                    <th width="7%"><?= $val; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($sub_kegiatan as $row => $val) : ?>
                <tr>
                    <td align="center"><?= $no++; ?></td>
                    <td><?= $val["nama_sub_kegiatan"]; ?></td>
                    <td><?= $val["nama"]; ?></td>
                    <?php foreach ($bln as $row2 => $val2) : ?>
                        <td align="right"><?= $val[$row2]; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>