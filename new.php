<?php

require_once('initialize.php');
require_once('query_functions.php');
//  $id = $_POST['searchTerm'];
//  $result=find_book($id);
?>

<form method="post" action='search.php'  id="searchform" class="form-group>
  <dl>
    <dt>Menu Name</dt>
    <dd><input type="text" name="menu_name" value="Hello Minh" /></dd>
  </dl>
  <dl>
    <dt>Position</dt>
    <dd>
      <select name="position">
        <?php
          for($i=1; $i <= $page_count; $i++) {
            echo "<option value=\"{$i}\"";
            if($page["position"] == $i) {
              echo " selected";
            }
            echo ">{$i}</option>";
          }
        ?>
      </select>
    </dd>
  </dl>
  <dl>
    <dt>Visible</dt>
    <dd>
      <input type="hidden" name="visible" value="0" />
      <input type="checkbox" name="visible" value="1"<?php if($page['subject_id'] == "1") { echo " checked"; } ?> />
    </dd>
  </dl>
  <dl>
    <dt>Content</dt>
    <dd>
      <textarea name="content" cols="60" rows="10"><?php echo h($page['content']); ?></textarea>
    </dd>
  </dl>
  <div id="operations">
    <input type="submit" value="Create Page" />
  </div>
</form>
