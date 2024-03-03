<?php
    $data = json_decode(file_get_contents('php://input'), true);
    $image = $data['image'];
    $annotations = $data['annotations'];

    if (!is_dir('annotations/')) {
        mkdir($target_dir, 0777, true);
    }

    $annotationsFile = 'annotations/' . basename($image) . '.json';
    file_put_contents($annotationsFile, json_encode($annotations));
?>
