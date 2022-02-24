<?php
// 一階層上を指定する書き方
include __DIR__ . '/../partials/header.php';
require(__DIR__ . '/../list/lists.php');

// $webpageId = $_GET;
// getだけだと以下のvar_dumpになる
// array(1) {
//   ["id"]=>
//   string(1) "1"
// }

// 変数宣言がされているか。nullとは異なっているか検査している。
// $_GET['id']が変数宣言されていなかったらtrueなので、urlパラメータがない場合は「Not Foud」になるということ。
// だた、これだけだと、idがリストに存在しない数値でも宣言されていればfalseになり、なにも記載されないページが表示されてしまう。だから、下で...
if (!isset($_GET['id'])) {
  // echo 'Not Found...';
  include __DIR__ . '/../partials/err/not_found_query.php';
  exit;
}

// aタグのhrefのリンクを踏むと$_GETに値が格納される（actionのGETメソッドで送信しなくても。）
$webpageId = $_GET['id'];
$webpage = getWebpageListsById($webpageId);

// ...getWebpageListsByIdでそのidのページ情報を取得し、データがなければ同じように「Not Found」を表示して終了する。
if (!$webpage) {
  // echo "Not Found...";
  include __DIR__ . '/../partials/err/not_found_info.php';
  exit;
}

?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>View Web Page Infomation ：<b><?php echo $webpage['companyName']; ?></b></h3>
    </div>
    <table class="table">

      <tbody>
        <tr>
          <th>ID</th>
          <td><?php echo $webpage['id'] ?></td>
        </tr>
        <tr>
          <th>CompanyName</th>
          <td><?php echo $webpage['companyName'] ?></td>
        </tr>
        <tr>
          <th>URL</th>
          <td>
            <a href="<?php echo $webpage['url'] ?>" target="_blank"><?php echo $webpage['url'] ?></a>
          </td>
        </tr>
        <tr>
          <th>ScrollFlag</th>
          <td><?php echo $webpage['scrollFlag'] ? 'true' : 'false' ?></td>
        </tr>
      </tbody>
    </table>
  </div>

</div>


<?php include __DIR__ . '/../partials/footer.php' ?>
