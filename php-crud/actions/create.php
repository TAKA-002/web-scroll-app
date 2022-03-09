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
  'dirName' => '',
  'url' => '',
  'css' => '',
  'js' => '',
  'scrollFlag' => null,
];

/**
 * submitボタンを押したらPOSTでデータが送られてくるはず。
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $validation = new Validation();
  $checkedResult = $validation->checkEmptyData($_POST);

  if ($checkedResult === false) {
    include __DIR__ . '/../partials/err/not_found_data.php';
    exit;
  }

  /**
   * postデータのurlが重複していないかチェックする。
   */
  $web_page_all_data = getWebpageLists();
  $duplicate_check_result = $validation->checkDuplicateURLforCreate($_POST, $web_page_all_data);
  if ($duplicate_check_result === false) {
    include __DIR__ . '/../partials/err/not_found_data.php';
    exit;
  }

  /**
   * postデータのdirNameがすべて半角英数字かチェック。
   */
  $str_check_result = $validation->checkStrings($_POST['dirName']);
  if ($str_check_result === false) {
    include __DIR__ . '/../partials/err/invalid_dirName.php';
    exit;
  }


  createItem($_POST);

  header('Location: ../index.php');
}

?>

<?php include __DIR__ . '/../partials/nav.php' ?>

<div class="row m-0">
  <!-- sidebar -->
  <?php include __DIR__ . '/../partials/sidebar.php' ?>

  <?php include __DIR__ . '/../partials/_form.php' ?>
</div>

<?php include __DIR__ . '/../partials/footer.php' ?>
