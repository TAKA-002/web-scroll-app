<div class="container col main">
  <div class="card">
    <div class="card-header">
      <h3>
        <?php if ($web_page_data['companyName']) : ?>
          Update Web Page：<b><?php echo $web_page_data['companyName'] ?></b>

        <?php else : ?>
          Create New Item

        <?php endif ?>
      </h3>
    </div>

    <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group mb-3">

          <!-- 新規（企業名がない場合）はID：自動入力 -->
          <?php if ($web_page_data['companyName'] === '') : ?>
            <label class="form-label">ID：自動入力</label>

          <?php else : ?>
            <label class="form-label">ID</label>

          <?php endif ?>

          <!-- idは作成段階で重複がないかチェックしている -->
          <input name="id" value="<?php echo $web_page_data['id']; ?>" class="form-control" readonly>
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
