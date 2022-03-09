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

<?php include './partials/nav.php' ?>

<div class="row m-0">
  <!-- sidebar -->
  <?php include './partials/sidebar.php' ?>

  <!-- main contents -->
  <div class="container col main">
    <p>
      <a href="./actions/create.php" class="btn btn-success">Create New Item</a>
    </p>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Site</th>
          <th>URL / CSS / JS</th>
          <th>DirName</th>
          <th>Flag</th>
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
              <ul>
                <li>
                  <a href="<?php echo $item['url'] ?>" target="_blank"><?php echo $item['url'] ?></a>
                </li>
                <li>
                  <a href="<?php echo $item['css'] ?>" target="_blank"><?php echo $item['css'] ?></a>
                </li>
                <li>
                  <a href="<?php echo $item['js'] ?>" target="_blank"><?php echo $item['js'] ?></a>
                </li>
              </ul>
            </td>
            <td><?php echo $item['dirName'] ?></td>
            <td><?php echo $item['scrollFlag'] ? 'true' : 'false'; ?></td>
            <td class="btn__wrap">
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
</div>

<?php include './partials/footer.php'; ?>
