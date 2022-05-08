<?php
include_once('components/db.php');
$basket = [
    'funds' => 0,
    'items' => []
];
// echo json_encode($basket);
$db = new Database();
// var_dump(count(json_decode($db->getBasket(829349149)['basket'], true)['items']));
var_dump(json_encode($basket));
// var_dump(json_decode('{"cash":"0","basket":{"funds":0,"items":[{"id":"2","brand_id":"1","product_id":"1"}]}}'));
?>