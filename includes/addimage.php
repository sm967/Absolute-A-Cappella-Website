<?php foreach ($messages as $message) {
  echo "<p class=\"alert\"><strong>" . htmlspecialchars($message) . "</strong></p>\n";
} ?>

<div id="add-image-form">
  <form id="upload-image" action="index.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />

    <label for="uploaded_image">Upload Image:</label>
    <input id="uploaded_image" type="file" name="uploaded_image">

    <label for="image_desc">Description:</label>
    <textarea id="image_desc" name="description"></textarea>

    <button name="submit-upload" type="submit">Upload File</button>
  </form>
</div>

<div id="back-form">
  <a href="index.php"><p id="back-button">Back to Gallery</p></a>
</div>
