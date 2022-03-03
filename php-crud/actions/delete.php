<?php
include __DIR__ . '/../partials/header.php';
require(__DIR__ . '/../methods/lists.php');

if (!isset($_POST['id'])) {
  include __DIR__ . '/../partials/err/not_found_query.php';
  exit;
}
$web_page_id = $_POST['id'];

deleteWebpageList($web_page_id);

header("Location: ../index.php");
