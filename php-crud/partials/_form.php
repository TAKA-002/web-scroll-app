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

        <div class="form-group mb-5">

          <!-- 新規（企業名がない場合）はID：自動入力 -->
          <?php if ($web_page_data['companyName'] === '') : ?>
            <label class="form-label">ID：自動入力</label>

          <?php else : ?>
            <label class="form-label">ID</label>

          <?php endif ?>

          <!-- idは作成段階で重複がないかチェックしている -->
          <input name="id" value="<?php echo $web_page_data['id']; ?>" class="form-control" readonly>
        </div>

        <div class="form-group mb-5">
          <label class="form-label">SITE（日本語可）</label>
          <input name="companyName" value="<?php echo $web_page_data['companyName']; ?>" class="form-control">
        </div>

        <div class="form-group mb-5">
          <label class="form-label">PAGE URL</label>
          <input name="url" value="<?php echo $web_page_data['url']; ?>" class="form-control">
        </div>

        <div class="form-group mb-5">
          <label class="form-label">CSS URL</label>
          <input name="css" value="<?php echo $web_page_data['css']; ?>" class="form-control">
        </div>

        <div class="form-group mb-5">
          <label class="form-label">JS URL</label>
          <input name="js" value="<?php echo $web_page_data['js']; ?>" class="form-control">
        </div>

        <div class="form-group mb-5">
          <?php if ($web_page_data['companyName'] === "") : ?>
            <label class="form-label">DIRECTORY：すべて半角英数字（推奨：サイト名と同じ　　例：NHK選挙WEB => nhksenkyo）</label>
            <input name="dirName" value="<?php echo $web_page_data['dirName'] ?>" class="form-control">

          <?php else : ?>
            <label class="form-label">DIRECTORY</label>
            <input type="hidden" name="dirName" value="<?php echo $web_page_data['dirName'] ?>" class="form-control">
            <p>/web-scroll-app/output/<span class="fw-bolder text-primary"><?php echo $web_page_data['id'] . "_" . $web_page_data['dirName'] ?></span></p>

          <?php endif ?>
        </div>

        <div class="form-group mb-5">
          <label class="form-label">SCROLL FLAG：スクロール切替</label>

          <!-- scrollFlagがtrueで青。falseで赤 -->
          <?php if ($web_page_data['scrollFlag']) : ?>
            <p>現在：<span class="fw-bolder text-primary"><?php echo "スクロール実行中"; ?></span></p>

          <?php else : ?>
            <p>現在：<span class="fw-bolder text-danger"><?php echo "スクロール停止中"; ?></span></p>

          <?php endif ?>


          <select name="scrollFlag" class="form-control">

            <!-- scrollFlagがtrueかflaseで初期値を変更 -->
            <?php if ($web_page_data['scrollFlag'] === true) : ?>
              <option value="true" selected>スクロール実行</option>
              <option value="false">スクロール停止</option>

            <?php else : ?>
              <option value="true">スクロール実行</option>
              <option value="false" selected>スクロール停止</option>

            <?php endif ?>
          </select>

        </div>

        <button class="btn btn-success">Submit</button>

      </form>
    </div>

  </div>
</div>