<?php
include __DIR__ . '/../partials/header.php';
require(__DIR__ . '/../methods/lists.php');
require(__DIR__ . '/../methods/validation.php');

if (!isset($_GET['id'])) {
  include __DIR__ . '/../partials/err/not_found_query.php';
  exit;
}

/**
 * index.phpのupdateボタンを押したとき、hrefのクエリにidがついている。それを$_GETで取得して$webpageIdにセット。
 */
$web_page_id = $_GET['id'];

/**
 * 該当web_page_idからjsonデータを検索し、decodeして情報を取得
 */
$web_page_data = getWebpageListsById($web_page_id);
if (!$web_page_data) {
  include __DIR__ . '/../partials/err/not_found_info.php';
  exit;
}

/**
 * POSTは_form.phpでsubmitボタンを押したときに、formタグ内容が送られてくる
 * それをもとにjsonデータが更新
 * headerメソッドでrefresh
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $validation = new Validation();

  /**
   * postデータが空ではないかチェックする。
   */
  $empty_check_result = $validation->checkEmptyData($_POST);
  if (!$empty_check_result) {
    include __DIR__ . '/../partials/err/not_found_data.php';
    exit;
  }

  /**
   * postデータのurlが重複していないかチェックする。
   */
  $web_page_all_data = getWebpageLists();
  $duplicate_check_result = $validation->checkDuplicateURLforUpdate($_POST, $web_page_all_data);
  if (!$duplicate_check_result) {
    include __DIR__ . '/../partials/err/not_found_data.php';
    exit;
  }

  updateWebpageList($_POST, $web_page_id);

  header("Location: ../index.php");
}

?>

<?php include __DIR__ . '/../partials/nav.php' ?>

<div class="row m-0">
  <!-- sidebar -->
  <?php include __DIR__ . '/../partials/sidebar.php' ?>

  <?php include __DIR__ . '/../partials/_form.php' ?>
</div>

<?php include __DIR__ . '/../partials/footer.php' ?>
