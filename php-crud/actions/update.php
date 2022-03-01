<?php
include __DIR__ . '/../partials/header.php';
require(__DIR__ . '/../methods/lists.php');

if (!isset($_GET['id'])) {
  include __DIR__ . '/../partials/err/not_found_query.php';
  exit;
}

$webpageId = $_GET['id'];
$webpage = getWebpageListsById($webpageId);

if (!$webpage) {
  include __DIR__ . '/../partials/err/not_found_info.php';
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  updateWebpageList($_POST, $webpageId);

  /**
   * headerメソッドでrefresh
   */
  header("Location: ../index.php");
}

?>


<?php include __DIR__ . '/../partials/_form.php' ?>

<?php include __DIR__ . '/../partials/footer.php' ?>
