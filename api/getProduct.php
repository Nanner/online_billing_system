<?php
include_once 'utilities.php';
include_once 'search.php';

$value = NULL;
if ( isset($_GET['ProductCode']) && !empty($_GET['ProductCode']) ) {
    $value = $_GET['ProductCode'];
} else {
    $error = new Error(700, "Expected ProductCode parameter");
    die(json_encode($error->getInfo(), JSON_NUMERIC_CHECK));
}

// Fetch the product we are looking for
$table = 'Product';
$field = 'productCode';
$values = array($value);
$rows = array('productCode','productDescription', 'unitPrice', 'unitOfMeasure');
$joins = array();

$search = new EqualSearch($table, $field, $values, $rows, $joins);
$result = $search->getResults();

if (!$result) {
    $error = new Error(404, "Product not found");
    die(json_encode($error->getInfo(), JSON_NUMERIC_CHECK));
}

$result = $result[0];

roundProductTotals($result);

echo json_encode($result, JSON_NUMERIC_CHECK);