<?php
//  session_start();

//  $level = $this->session->userdata("level");
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'v_data_odp';
 
// Table's primary key
$primaryKey = 'id_laporan';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id_laporan', 'dt' => 0 ),
    array( 'db' => 'tgl_periksa',  'dt' => 1 ),
    array( 'db' => 'nama',   'dt' => 2 ),
    array( 'db' => 'umur',   'dt' => 3 ),
    array( 'db' => 'nama_kecamatan',   'dt' => 4 ),
    array( 'db' => 'nama_kelurahan',   'dt' => 5 ),
    array( 'db' => 'alamat_domisili',   'dt' => 6 ),
    array(
        'db' => 'covid',
        'dt' => 7,
        'formatter' => function($d, $row)
        {
            if ($d == 0) {
                return "MASA PANTAU";
            } else {
                return "SELESAI PANTAU";
            }
            
        }
    ),
    array( 'db' => 'nama_user',   'dt' => 8 ),
    array(
        'db'        => 'id_laporan',
        'dt'        => 9,
        'formatter' => function( $d, $row ) {
            $html = '<button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Aksi <span class="sr-only">Toggle Dropdown</span>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="#" onclick="modal2(\''.$d.'\')"><span class="fa fa-edit"></span> Ubah Data</a>
                            <a class="dropdown-item text-success" href="home/negatif/'.$d.'" onclick="return confirm(\'Yakin Sudah Selesai Pantau?\')"><span class="fa fa-plus"></span> Selesai Pantau</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#" onclick="modal7(\''.$d.'\')"><span class="fa fa-plus"></span> PDP</a>
                        </div>
                    </button>';
            
            return $html;
        }
    )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'tb_lapor',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);