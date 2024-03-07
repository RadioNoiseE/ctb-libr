<?php
//     $target_dir = "/var/www/localhost/htdocs/upload/";
//
//     if (!is_dir($target_dir)) {
//         mkdir($target_dir, 0777, true);
//     }
//
//     foreach ($_FILES["image"]["name"] as $key => $name) {
//         $target_file = $target_dir . basename($name);
//         $tmp_name = $_FILES["image"]["tmp_name"][$key];
//
//         if (move_uploaded_file($tmp_name, $target_file)) {
//             echo "The file " . htmlspecialchars(basename($name)) . " has been uploaded.";
//         #   header('Location: annotate-image.php?image=' . urlencode($target_file));
//         } else {
//             echo "Sorry, there was an error uploading your file: " . htmlspecialchars(basename($name));
//         }
//     }
//
//     $images = glob("uploads/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
//     foreach ($images as $image) {
//         echo "<a href='annotate-image.php?image=" . urlencode($image) . "'>Annotate " . htmlspecialchars(basename($image)) . "</a><br>";
//     }
?>

<a href="annotate-image.php?image=libr.jpg">Annotate</a>
