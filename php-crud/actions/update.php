<?php
include __DIR__ . '/../partials/header.php';
require(__DIR__ . '/../list/lists.php');

if (!isset($_GET['id'])) {
  include __DIR__ . '/../partials/err/not_found_query.php';
  exit;
}

$webpageId = $_GET['id'];
$webpage = getWebpageListsById($webpageId);

if (!$webpage) {
  include __DIR__ . '/../partials/err/not_found_info.php';
  exit;
}

echo '<pre>';
var_dump($_SERVER);
echo '</pre>';


?>


<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Update Web Page：<b><?php echo $webpage['companyName'] ?></b></h3>
    </div>
    <div class="card-body">

      <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group mb-3">
          <label class="form-label">ID</label>
          <input name="id" value="<?php echo $webpage['id']; ?>" class="form-control">
        </div>
        <div class="form-group mb-3">
          <label class="form-label">CompanyName</label>
          <input name="companyName" value="<?php echo $webpage['companyName']; ?>" class="form-control">
        </div>
        <div class="form-group mb-3">
          <label class="form-label">URL</label>
          <input name="url" value="<?php echo $webpage['url']; ?>" class="form-control">
        </div>
        <div class="form-group mb-3">
          <label class="form-label">ScrollFlag</label>
          <input name="scrollFlag" value="<?php echo $webpage['scrollFlag']; ?>" class="form-control">
        </div>

        <button class="btn btn-success">Submit</button>
      </form>

    </div>
  </div>
</div>

<?php include __DIR__ . '/../partials/footer.php' ?>
