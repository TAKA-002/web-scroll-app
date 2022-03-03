<?php
error_reporting(-1);
ini_set('display_errors', 'On');

include __DIR__ . '/../partials/header.php';
require(__DIR__ . '/../methods/lists.php');
require(__DIR__ . '/../methods/validation.php');


$web_page_all_data = getWebpageLists();
$rand_id = createId($web_page_all_data);

/**
 * _form.phpで使用
 * createの場合は、初期表示が空であるかどうかで見出しをだしわける。
 */
$web_page_data = [
  'id' => $rand_id,
  'companyName' => '',
  'url' => '',
  'scrollFlag' => null,
];

/**
 * submitボタンを押したらPOSTでデータが送られてくるはず。
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $validation = new Validation();
  $checkedResult = $validation->checkEmptyData($_POST);
  if (!$checkedResult) {
    include __DIR__ . '/../partials/err/not_found_data.php';
    exit;
  }

  createItem($_POST);

  header('Location: ../index.php');
}

?>

<?php include __DIR__ . '/../partials/_form.php' ?>

<?php include __DIR__ . '/../partials/footer.php' ?>
