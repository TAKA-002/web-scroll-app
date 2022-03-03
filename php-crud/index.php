<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require('./methods/lists.php');

/**
 * jsonデータを情報をすべてデコードして取得
 */
$web_page_all_data = getWebpageLists();

include './partials/header.php'
?>

<div class="container">
  <p>
    <a href="./actions/create.php" class="btn btn-success">Create New Item</a>
  </p>

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>CompanyName</th>
        <th>URL</th>
        <th>ScrollFlag</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- 
        foreachで配列web_page_all_dataの要素をitemごとに表示
        ボタンのhrefにはそれぞれパラメータとしてitemのidを付与し、各phpファイルへデータを送付
      -->
      <?php foreach ($web_page_all_data as $item) : ?>
        <tr>
          <td><?php echo $item['id'] ?></td>
          <td><?php echo $item['companyName'] ?></td>
          <td>
            <a href="<?php echo $item['url'] ?>" target="_blank"><?php echo $item['url'] ?></a>
          </td>
          <td><?php echo $item['scrollFlag'] ? 'true' : 'false'; ?></td>
          <td>
            <a href="./actions/view.php?id=<?php echo $item['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
            <a href="./actions/update.php?id=<?php echo $item['id'] ?>" class="btn btn-sm btn-outline-success">Update</a>
            <form method="POST" action="actions/delete.php">
              <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
              <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include './partials/footer.php'; ?>
