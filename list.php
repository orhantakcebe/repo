<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
<?php

function getPath($withoutAttempt = false) {
  $path = $_POST["otaFMPath"];
  $attemptOpen = $_POST["attemptOpen"];
  if (!str_ends_with($path, "/")) {
    $path .= "/";
  }
  if (isset($path) == false) {
    $path = __DIR__ . "/../";
  } else {
    if ($withoutAttempt === false) {
      if ($attemptOpen !== "" && (!str_ends_with($attemptOpen, "/"))) {
         $attemptOpen .= "/";
      }
      $path = $path . $attemptOpen;
    }
    ?>
    <script>
      document.getElementsByClassName("filemanager")[<?php echo (!isset($_POST["filemanagerIdNumber"])) ? 0 : $_POST["filemanagerIdNumber"] ?>].dataset.otaFmPath = "<?php echo $path ?>";
    </script>
    <?php
  }
  return $path;
}

$path = getPath();
?>
    <script>
      document.getElementsByClassName("otaFMFilepathInputFilepath")[<?php echo (!isset($_POST["filemanagerIdNumber"])) ? 0 : $_POST["filemanagerIdNumber"] ?>].value = "<?php echo $path ?>";
      </script>
<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_clear_last();
echo $path;
$scandir = scandir($path);
if ($scandir === false) {
  ?>
  <div class="alert alert-info" role="alert">
    <?php
    echo (error_get_last()["message"]);
    ?>
  </div> 
  <?php
    $path = getPath(true);
    $scandir = scandir($path);
    return;
}

$files = array_diff($scandir, array('.'));

foreach ($files as $file) {
  $realpath = realpath($path . DIRECTORY_SEPARATOR . $file);
  if (is_dir($realpath)) {
    //echo "🗀" . $file . "<br>";
    ?>
    <div data-ota-fm-type="fileFolder<?php echo $_POST["filemanagerIdNumber"] . "\" data-ota-fm-fileFolderName=\"" . $file ?>" data-ota-fm-filefolder-type="<?php echo "folder" ?>">
      <img src="../img/folder-icon.jpg" style="height: 30px" class="filefolder">

      <span data-ota-fm-text="">
        <?php
        echo $file . "<br>";
        ?>
      </span>
    </div>
    <?php
  } else if (is_file($realpath)) {
    ?>
    <div data-ota-fm-type="fileFolder<?php echo $_POST["filemanagerIdNumber"] . "\" data-ota-fm-fileFolderName=\"" . $file ?>" data-ota-fm-filefolder-type="<?php echo "file" ?>">
      <img src="../img/file-icon.jpg" style="height: 30px" class="filefolder">
      <span data-ota-fm-text="">
        <?php
        //echo "🗎" . $file . "<br>";
        echo $file . "<br>";
        ?>
      </span>
    </div>
    <?php
  }
}
?>