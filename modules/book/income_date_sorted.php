<?php
include_once '../../config/db_settings.php';
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
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
$date = $_GET['date'];
// DB table to use
$table = 'income';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
        array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row ) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_'.$d;
        }
        ),
        //array( 'db' => 'id', 'dt' => 0 ),
	array( 'db' => 'type', 'dt' => 0 ),
	array( 'db' => 'date', 'dt' => 1 ),
        array( 'db' => 'pay_id', 'dt' => 2 ),
        array( 'db' => 'des', 'dt' => 3 ),
        array( 'db' => 'amount', 'dt' => 4 )
//                ,
//        array( 'db' => 'bloodgroup', 'dt' => 5 ),
//        array( 'db' => 'gender', 'dt' => 6 ),
//        array( 'db' => 'owner', 'dt' => 7 ),
//        array( 'db' => 'married', 'dt' => 8 ),
//        array( 'db' => 'email', 'dt' => 9 ),
//        array( 'db' => 'ward', 'dt' => 10 ),
//        array( 'db' => 'category', 'dt' => 11 ),
//        array( 'db' => 'dis', 'dt' => 12 ),
//        array( 'db' => 'nri', 'dt' => 13 ),
//        array( 'db' => 'mad', 'dt' => 14 ),
//        array( 'db' => 'edu', 'dt' => 15 ),
//        array( 'db' => 'base_mem', 'dt' => 16 )
);

// SQL server connection information
$sql_details = array(
	'user' => "$db_username",
	'pass' => "$db_password",
	'db'   => "$db_name",
	'host' => "$db_server"
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( './core/ssp.class.php' );



echo json_encode(
		SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,"date='$date'")
);

