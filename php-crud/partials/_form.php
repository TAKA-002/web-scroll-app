<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>
        <?php if ($web_page_data['id']) : ?>
          Update Web Page：<b><?php echo $web_page_data['companyName'] ?></b>
        <?php else : ?>
          Create New Item
        <?php endif ?>
      </h3>
    </div>

    <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group mb-3">
          <label class="form-label">ID</label>
          <input name="id" value="<?php echo $web_page_data['id']; ?>" class="form-control">
        </div>

        <div class="form-group mb-3">
          <label class="form-label">CompanyName</label>
          <input name="companyName" value="<?php echo $web_page_data['companyName']; ?>" class="form-control">
        </div>

        <div class="form-group mb-3">
          <label class="form-label">URL</label>
          <input name="url" value="<?php echo $web_page_data['url']; ?>" class="form-control">
        </div>

        <div class="form-group mb-3">
          <label class="form-label">ScrollFlag：true or false</label>
          <input name="scrollFlag" value="<?php echo $web_page_data['scrollFlag'] ? "true" : "false"; ?>" class="form-control">
        </div>

        <button class="btn btn-success">Submit</button>

      </form>
    </div>

  </div>
</div>
