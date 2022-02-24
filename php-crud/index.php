<?php

require('./list/lists.php');
$webPageLists = getWebpageLists();


// 共通ヘッダーとフッターは、別ファイルにしてincludeを使うことでSSR可能
include './partials/header.php'
?>

<div class="container">
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
        foreachで配列webPageListsの要素をitemごとに表示
        ボタンのhrefにはそれぞれパラメータとしてitemのidを付与し、各phpファイルへデータを送付
       -->
      <?php foreach ($webPageLists as $item) : ?>
        <tr>
          <td><?php echo $item['id'] ?></td>
          <td><?php echo $item['companyName'] ?></td>
          <td>
            <a href="<?php echo $item['url'] ?>" target="_blank"><?php echo $item['url'] ?></a>
          </td>
          <td><?php echo $item['scrollFlag'] ? 'true' : 'false'; ?></td>
          <td>
            <a href="./actions/view.php?id=<?php echo $item['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
            <a href="./actions/update.php?id=<?php echo $item['id'] ?>" class="btn btn-sm btn-outline-info">Update</a>
            <a href="./actions/delete.php?id=<?php echo $item['id'] ?>" class="btn btn-sm btn-outline-info">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include './partials/footer.php'; ?>
