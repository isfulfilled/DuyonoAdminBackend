<?php

include '../header.php';
include_once '../writer_classes/writer.php';

$data = json_decode(file_get_contents('php://input'));
$writer = new writer();
switch ($request_method) {
  case 'POST':
    // Insert User
    $writer->setEmail("".$data->email."");
    $writer->setPassword("".$data->password."");
    $writer->login();



    break;
  default:
    // Invalid Request Method
    header('HTTP/1.0 405 Method Not Allowed');
    break;
}
