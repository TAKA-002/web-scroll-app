<?php
// 一階層上を指定する書き方
include __DIR__ . '/../partials/header.php';
require(__DIR__ . '/../methods/lists.php');

// $_GET['id']が変数宣言されていなかったらtrueなので、urlパラメータがない場合は「Not Foud」になるということ。
// だた、これだけだと、idがリストに存在しない数値でも宣言されていればfalseになり、なにも記載されないページが表示されてしまう。だから、下で...
if (!isset($_GET['id'])) {
  include __DIR__ . '/../partials/err/not_found_query.php';
  exit;
}
// aタグのhrefのリンクを踏むと$_GETに値が格納される（actionのGETメソッドで送信しなくても。）
$web_page_id = $_GET['id'];

$web_page_data = getWebpageListsById($web_page_id);
// ...getWebpageListsByIdでそのidのページ情報を取得し、データがなければ同じように「Not Found」を表示して終了する。
if (!$web_page_data) {
  include __DIR__ . '/../partials/err/not_found_info.php';
  exit;
}

?>

<?php include __DIR__ . '/../partials/nav.php' ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>View Web Page Infomation ：<b><?php echo $web_page_data['companyName']; ?></b></h3>
    </div>

    <div class="card-body btn__wrap">
      <a class="btn btn-secondary" href="update.php?id=<?php echo $web_page_data['id'] ?>">Update</a>

      <form method="POST" action="delete.php">
        <input type="hidden" name="id" value="<?php echo $web_page_data['id'] ?>">
        <button class="btn btn-danger">Delete</button>
      </form>
    </div>

    <table class="table">

      <tbody>
        <tr>
          <th>ID</th>
          <td><?php echo $web_page_data['id'] ?></td>
        </tr>
        <tr>
          <th>CompanyName</th>
          <td><?php echo $web_page_data['companyName'] ?></td>
        </tr>
        <tr>
          <th>URL</th>
          <td>
            <a href="<?php echo $web_page_data['url'] ?>" target="_blank"><?php echo $web_page_data['url'] ?></a>
          </td>
        </tr>
        <tr>
          <th>ScrollFlag</th>
          <td><?php echo $web_page_data['scrollFlag'] ? 'true' : 'false' ?></td>
        </tr>
      </tbody>
    </table>
  </div>

</div>


<?php include __DIR__ . '/../partials/footer.php' ?>
