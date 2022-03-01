<?php
include __DIR__ . '/../partials/header.php';
require(__DIR__ . '/../methods/lists.php');

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
  updateWebpageList($_POST, $web_page_id);

  header("Location: ../index.php");
}

?>


<?php include __DIR__ . '/../partials/_form.php' ?>

<?php include __DIR__ . '/../partials/footer.php' ?>
