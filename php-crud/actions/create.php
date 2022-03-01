<?php
include __DIR__ . '/../partials/header.php';
require(__DIR__ . '/../methods/lists.php');


$item = [
  'id' => 1,
  'companyName' => '',
  'url' => '',
  'scrollFlag' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $item = createItem($_POST);

  header('Location: ../index.php');
}

?>

<?php include __DIR__ . '/../partials/_form.php' ?>

<?php include __DIR__ . '/../partials/footer.php' ?>
