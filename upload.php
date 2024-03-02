# <?php
# $target_dir = "/var/www/localhost/htdocs/upload/";
# $target_file = $target_dir . basename($_FILES["image"]["name"]);
#
# if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
#     echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
#     header('Location: annotate-image.php?image=' . urlencode($target_file));
#     exit;
# } else {
#     echo "Sorry, there was an error uploading your file.";
# }
# ?>

<?php
# $target_dir = "/var/www/localhost/htdocs/upload/";

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

foreach ($_FILES["image"]["name"] as $key => $name) {
    $target_file = $target_dir . basename($name);
    $tmp_name = $_FILES["image"]["tmp_name"][$key];

    if (move_uploaded_file($tmp_name, $target_file)) {
        echo "The file " . htmlspecialchars(basename($name)) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file: " . htmlspecialchars(basename($name));
    }
}
?>
