<?php
// 保存批注数据到一个 JSON 文件中
$data = json_decode(file_get_contents('php://input'), true);
$image = $data['image'];
$annotations = $data['annotations'];

if (!is_dir('/var/www/localhost/htdocs/annotations/')) {
    mkdir($target_dir, 0777, true);
}

// 基于图片文件名创建批注数据文件名
$annotationsFile = '/var/www/localhost/htdocs/annotations/' . basename($image) . '.json';
file_put_contents($annotationsFile, json_encode($annotations));
?>
