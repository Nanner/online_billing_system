<?php
require_once 'invoice.php';

require_once '../bootstrap.php';
require_once 'authenticationUtilities.php';

if(!comparePermissions(array('read'))) {
	$error = new Error(601, 'Permission denied');
    die( json_encode($error->getInfo()) );
}

$value = NULL;
if ( isset($_GET['InvoiceNo']) && !empty($_GET['InvoiceNo']) ) {
    $value = $_GET['InvoiceNo'];
} else {
    $error = new Error(700, "Expected InvoiceNo parameter");
    die(json_encode($error->getInfo(), JSON_NUMERIC_CHECK));
}

echo json_encode(getInvoice($value));
