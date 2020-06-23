<?php
  include("includes/init.php");
  $image_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
  $sql = "SELECT images.img_name, images.ext, images.description, users.fullname, images.user_id FROM images INNER JOIN users ON images.user_id = users.id WHERE images.id = ".$image_id.";";
  $params = array();
  $result = exec_sql_query($db, $sql, $params);
  $fetched_result = $result->fetchAll();
  $image = $fetched_result[0];
  $image_name = htmlspecialchars($image["img_name"]);
  $image_ext = htmlspecialchars($image["ext"]);
  $taker_name = htmlspecialchars($image["fullname"]);
  $taker_id = htmlspecialchars($image["user_id"]);
  $full_path = "uploads/images/".$image_id.".".$image_ext;

  $tags_sql = "SELECT tags.tag, tags.id FROM tags INNER JOIN image_tags ON tags.id = image_tags.tag_id WHERE ".$image_id." = image_tags.image_id";
  $tags_params = array();
  $tags_result = exec_sql_query($db, $tags_sql, $tags_params);
  $tags = $tags_result->fetchAll();

  function print_tags($tag) {
    $tag_text = "".htmlspecialchars($tag["tag"])." | ";
    echo $tag_text;
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all">
  <title>Fullscreen View</title>
</head>

<body>
  <?php include("includes/header.php"); ?>

  <div id="fullscreen">
    <?php foreach ($messages as $message) {
        echo "<p class=\"alert\"><strong>" . htmlspecialchars($message) . "</strong></p>\n";
    } ?>
    <h2>Now viewing: <?php echo $image_name;?></h2>
    <img src=<?php echo $full_path;?> alt=<?php echo $image_name;?>>
    <?php if (isset($image["description"])) { ?>
        <h3>Description: <?php echo htmlspecialchars($image["description"]);?></h3>
    <?php } ?>
    <p class="citation">Image taken by: <?php echo $taker_name;?></p>
    <p>Tags: <?php foreach ($tags as $tag) {
                      print_tags($tag);
                    } ?></p>
    <a href="index.php"><p id="back-button">Back to Gallery</p></a>
  </div>
  <div id="tag-forms">
    <div id="add-tag-form">
      <form action="index.php" method="POST">
        <input type="hidden" id="taker-id-a" name="taker-id-a" value="<?php echo htmlspecialchars($taker_id) ?>">
        <input type="hidden" id="image-id-a" name="image-id-a" value="<?php echo htmlspecialchars($image_id) ?>">

        <label for="add-tag">Add Tag:  </label>
        <input name="add-tag" id="add-tag" type="text">
        <input id="add-tag-submit" type="submit" name="add-tag-submit" value="Add" >
      </form>
    </div>
    <div id="remove-tag-form">
      <form action="index.php" method="POST">
        <input type="hidden" id="taker-id-r" name="taker-id-r" value="<?php echo htmlspecialchars($taker_id) ?>">
        <input type="hidden" id="image-id-r" name="image-id-r" value="<?php echo htmlspecialchars($image_id) ?>">

        <label for="remove-tag">Remove Tag:  </label>
        <select name="remove-tag" id="remove-tag">
          <option selected="selected" disabled="disabled">Choose a tag</option>
          <?php
            foreach ($tags as $tag) { ?>
              <option value="<?php echo $tag["tag"];?>"><?php echo $tag["tag"];?></option>
            <?php  }
          ?>
        </select>
        <input id="remove-tag-submit" type="submit" name="remove-tag-submit" value="Remove" >
      </form>
    </div>
  </div>
  <div id="buttons-form">
    <form action="index.php" method="POST">
      <input type="hidden" id="taker-id" name="taker-id" value="<?php echo htmlspecialchars($taker_id) ?>">
      <input type="hidden" id="image-id" name="image-id" value="<?php echo htmlspecialchars($image_id) ?>">
      <input id="delete-image-submit" type="submit" name="delete-image-submit" value="Delete Image">
    </form>
  </div>
  <?php include("includes/footer.php"); ?>
</body>
</html>
