<?php
error_reporting(-1);
ini_set('display_errors', 'On');

include __DIR__ . '/../partials/header.php';
require(__DIR__ . '/../methods/lists.php');

$web_page_all_data = getWebpageLists();
$rand_id = createId($web_page_all_data);

/**
 * 新規IDの作成
 */
function createId($web_page_all_data)
{
  $random_number = random_int(1000, 2000);

  // 重複チェック
  foreach ($web_page_all_data as $item) {
    if ($item['id'] !== $random_number) {
      continue;
    };
    if ($item['id'] === $random_number) {
      return createId($web_page_all_data);
    }
  };

  return $random_number;
}

/**
 * _form.phpで使用
 * createの場合は、初期表示が空であるかどうかで
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
  createItem($_POST);

  header('Location: ../index.php');
}

?>

<?php include __DIR__ . '/../partials/_form.php' ?>

<?php include __DIR__ . '/../partials/footer.php' ?>
