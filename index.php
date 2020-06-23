<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$search_sql = "SELECT tags.id, tags.tag FROM tags";
$search_params = array();
$search_result = exec_sql_query($db, $search_sql, $search_params);
$tags = $search_result->fetchAll();
const MAX_FILE_SIZE = 10000000;

function get_tag_id($tag_name) {
  global $db;
  global $tags;
  $search_sql = "SELECT tags.id, tags.tag FROM tags";
  $search_params = array();
  $search_result = exec_sql_query($db, $search_sql, $search_params);
  $tags = $search_result->fetchAll();
  foreach($tags as $tag) {
    if ($tag["tag"] == $tag_name) {
      return $tag["id"];
    }
  }
}

function how_many_tagged($tag_id) {
  global $db;
  if ($tag_id == NULL) {
    $count = 0;
    return $count;
  }
  else {
    $check_tag_sql = "SELECT image_tags.image_id FROM image_tags WHERE image_tags.tag_id = ".$tag_id;
    $check_tag_params = array();
    $check_tag_result = exec_sql_query($db, $check_tag_sql, $check_tag_params);
    $count = 0;

    $remaining_tags = $check_tag_result->fetchAll();
    foreach($remaining_tags as $tag) {
      $count = $count + 1;
    }
    return $count;
  }
}

if (isset($_POST["submit-upload"]) && is_user_logged_in()) {
  $upload_info = $_FILES["uploaded_image"];
  $upload_error = $_FILES["uploaded_image"]["error"];
  $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
  if($upload_error == 0) {
    $img_name = basename($upload_info["name"]);
    $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

    $sql = "INSERT INTO images (img_name, ext, description, user_id) VALUES (:img_name, :ext, :description, :user_id);";
    $params = array(':img_name' => $img_name, ':ext' => $ext, ':description' => $description, ':user_id' => $current_user['id']);
    $image_insert_result = exec_sql_query($db, $sql, $params);

    $last_id = $db->lastInsertId("id");
    $new_path = "uploads/images/".$last_id.".".$ext;
    move_uploaded_file($_FILES["uploaded_image"]["tmp_name"], $new_path);
  }
  else {
    array_push($messages, "UPLOAD FAILED, PLEASE TRY AGAIN");
  }
}

if (isset($_POST["delete-image-submit"])) {
  $taker_id = filter_input(INPUT_POST, "taker-id", FILTER_VALIDATE_INT);
  $image_id = filter_input(INPUT_POST, "image-id", FILTER_VALIDATE_INT);
  if (is_user_logged_in()) {
    if ($current_user['id'] == $taker_id) {
      $delete_image_tags_sql = "DELETE FROM image_tags WHERE image_tags.image_id = ".$image_id."";
      $delete_image_tags_params = array();
      $delete_image_tags_result = exec_sql_query($db, $delete_image_tags_sql, $delete_image_tags_params);

      foreach($tags as $tag) {
        if (how_many_tagged($tag["id"]) == 0) {
          $remove_tag_sql = "DELETE FROM tags WHERE tags.id = ".$tag["id"]."";
          $remove_tag_params = array();
          $remove_tag_result = exec_sql_query($db, $remove_tag_sql, $remove_tag_params);
        }
      }

      $search_sql = "SELECT tags.id, tags.tag FROM tags";
      $search_params = array();
      $search_result = exec_sql_query($db, $search_sql, $search_params);
      $tags = $search_result->fetchAll();

      $delete_image_sql = "DELETE FROM images WHERE images.id = ".$image_id."";
      $delete_image_params = array();
      $delete_image_result = exec_sql_query($db, $delete_image_sql, $delete_image_params);
      array_push($messages, "IMAGE DELETED");
    }
    else {
      array_push($messages, "SORRY, YOU CAN'T DELTE THAT IMAGE");
    }
  }
  else {
    array_push($messages, "PLEASE LOG IN TO REMOVE IMAGES");
  }
}

if (isset($_POST["add-tag-submit"])) {
  $user_tag = trim(filter_input(INPUT_POST, "add-tag", FILTER_SANITIZE_STRING));
  $taker_id = filter_input(INPUT_POST, "taker-id-a", FILTER_VALIDATE_INT);
  $image_id = filter_input(INPUT_POST, "image-id-a", FILTER_VALIDATE_INT);
  if ($user_tag != '') {
    if (how_many_tagged(get_tag_id($user_tag)) == 0) {
      $add_tag_sql = "INSERT INTO tags (tag) VALUES (:tag)";
      $add_tag_params = array(':tag' => $user_tag);
      $add_tag_result = exec_sql_query($db, $add_tag_sql, $add_tag_params);
      $search_sql = "SELECT tags.id, tags.tag FROM tags";
      $search_params = array();
      $search_result = exec_sql_query($db, $search_sql, $search_params);
      $tags = $search_result->fetchAll();
    }

    $dup_check_tag_sql = "SELECT image_tags.image_id FROM image_tags WHERE image_tags.tag_id = ".get_tag_id($user_tag);
    $dup_check_tag_params = array();
    $dup_check_tag_result = exec_sql_query($db, $dup_check_tag_sql, $dup_check_tag_params);
    $image_ids = $dup_check_tag_result->fetchAll();
    $not_dup = TRUE;
    foreach ($image_ids as $im_id) {
      if ($im_id["image_id"] == $image_id) {
        $not_dup = FALSE;
      }
    }

    if ($not_dup) {
      $add_image_tag_sql = "INSERT INTO image_tags (tag_id, image_id) VALUES (:tag_id, :image_id)";
      $add_image_tag_params = array(':tag_id' => get_tag_id($user_tag), ':image_id' => $image_id);
      $add_image_tag_result = exec_sql_query($db, $add_image_tag_sql, $add_image_tag_params);
      array_push($messages, "TAG ADDED");
    }
    else {
      array_push($messages, "PLEASE DONT ADD DUPLICATE TAGS");
    }
  }
  else {
    array_push($messages, "PLEASE INPUT THE TAG YOU WISH TO ADD");
  }
}

if (isset($_POST["remove-tag-submit"])) {
  $user_r_tag = filter_input(INPUT_POST, "remove-tag", FILTER_SANITIZE_STRING);
  $taker_id = filter_input(INPUT_POST, "taker-id-r", FILTER_VALIDATE_INT);
  $image_id = filter_input(INPUT_POST, "image-id-r", FILTER_VALIDATE_INT);
  $tag_id = get_tag_id($user_r_tag);
  if (is_user_logged_in()) {
    if ($user_r_tag != '') {
      if ($current_user['id'] == $taker_id) {
        $remove_image_tags_sql = "DELETE FROM image_tags WHERE image_tags.image_id = ".$image_id." AND image_tags.tag_id = ".$tag_id."";
        $remove_image_tags_params = array();
        $remove_image_tags_result = exec_sql_query($db, $remove_image_tags_sql, $remove_image_tags_params);

        if (how_many_tagged($tag_id) == 0) {
          $remove_tag_sql = "DELETE FROM tags WHERE tags.id = ".$tag_id."";
          $remove_tag_params = array();
          $remove_tag_result = exec_sql_query($db, $remove_tag_sql, $remove_tag_params);
          $search_sql = "SELECT tags.id, tags.tag FROM tags";
          $search_params = array();
          $search_result = exec_sql_query($db, $search_sql, $search_params);
          $tags = $search_result->fetchAll();
        }
        array_push($messages, "TAG REMOVED");
      }
      else {
        array_push($messages, "SORRY, YOU CAN'T REMOVE TAGS ON THAT IMAGE");
      }
    }
    else {
      array_push($messages, "PLEASE CHOOSE A TAG TO REMOVE");
    }
  }
  else {
    array_push($messages, "PLEASE LOG IN TO REMOVE TAGS");
  }
}

if (isset($_GET["search-submit"]) & isset($_GET['search_tag'])) {
  $complete_search = TRUE;

  $user_search_tag = filter_input(INPUT_GET, 'search_tag', FILTER_SANITIZE_STRING);
  $tag_check = FALSE;
  foreach ($tags as $tag) {
    if ($tag["tag"] == $user_search_tag) {
      $tag_check = TRUE;
    }
  }
  if ($tag_check == TRUE) {
    $user_tag = $user_search_tag;
  }
  else {
    array_push($messages, "INVALID TAG");
    $complete_search = FALSE;
  }
}
else if (isset($_GET["search-submit"])) {
  if (!isset($_GET['search_tag'])) {
    array_push($messages, "PLEASE CHOOSE A SEARCH CATEGORY");
  }
}

if (isset($_GET["search-submit"]) && $complete_search == TRUE) {
  $sql = "SELECT DISTINCT images.id, images.img_name, images.ext, users.fullname FROM images INNER JOIN users ON images.user_id = users.id INNER JOIN image_tags ON images.id = image_tags.image_id INNER JOIN tags ON image_tags.tag_id = tags.id WHERE tags.tag LIKE '%'||:tag||'%';";
  $params = array(':tag' => $user_tag);
  $result = exec_sql_query($db, $sql, $params);
  array_push($messages, "SHOWING RESULTS FOR \"".$user_tag."\" TAG:");
}
else {
  $sql = "SELECT images.id, images.img_name, images.ext, images.description, users.fullname FROM images INNER JOIN users ON images.user_id = users.id;";
  $params = array();
  $result = exec_sql_query($db, $sql, $params);
}

function print_image($image) {
  $fileid = htmlspecialchars($image["id"]);
  $filename = htmlspecialchars($image["img_name"]);
  $fileext = htmlspecialchars($image["ext"]);
  $fullpath = "uploads/images/".$fileid.".".$fileext;
  $fullname = htmlspecialchars($image["fullname"]);
  ?>
    <div class="image-content">
      <figure>
        <!-- This image is was taken by <?php echo $fullname;?> for Absolute A Cappella -->
        <?php echo '<a href="fullview.php?'.http_build_query(array('id' => $fileid)).'"'?>><img src=<?php echo $fullpath;?> alt=<?php echo $filename;?>></a>
        <figcaption><?php echo $fileid;?>. Image taken by <?php echo $fullname;?></figcaption>
      </figure>
      <?php if (isset($image["description"])) { ?>
        <p class="desc"><?php echo htmlspecialchars($image["description"]); ?></p>
      <?php } ?>
    </div>
    <?php
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all">
  <title>Image Gallery</title>
</head>

<body>
  <?php include("includes/header.php");

  if (isset($_GET["show-add-image-submit"]) && is_user_logged_in()) {
      include("includes/addimage.php");
  }
  else {
    if (isset($_GET["show-add-image-submit"]) && !is_user_logged_in()) {
      array_push($messages, "PLEASE LOG IN TO ADD IMAGE");
    } ?>
  <div id="page-content">
    <?php foreach ($messages as $message) {
        echo "<p class=\"alert\"><strong>" . htmlspecialchars($message) . "</strong></p>\n";
    } ?>
    <h1>Gallery</h1>
    <div id="search-form">
      <form action="index.php" method="GET">
        <label for="search_tag">Search by Tag:  </label>
        <select name="search_tag" id="search_tag">
          <option selected="selected" disabled="disabled">Choose a tag</option>
          <?php
            foreach ($tags as $tag) { ?>
              <option value="<?php echo $tag["tag"];?>"><?php echo $tag["tag"];?></option>
            <?php  }
          ?>
        </select>
        <input id="submit" type="submit" name="search-submit" value="Search" >
      </form>
    </div>

    <div id="images-container">
      <?php
      $images = $result->fetchAll();
      foreach ($images as $image) {
        print_image($image);
      } ?>
    </div>
  </div>
  <div id="buttons-form">
    <form action="index.php" method="GET">
      <input id="show-add-image-submit" type="submit" name="show-add-image-submit" value="Add Image">
    </form>
  </div>
  <?php } ?>

  <?php include("includes/footer.php"); ?>
</body>
</html>
