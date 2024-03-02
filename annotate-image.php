<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Annotate Image</title>
    <style>
        image-container {
            position: relative;
            display: inline-block;
        }
        .annotation {
            position: absolute;
            color: red;
            font-size: 20px;
            font-weight: bold;
            pointer-events: none;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php
        $image = $_GET['image'] ?? ''; // 确保进行适当的验证和清洗
        if ($image) {
            echo '<img src="'.htmlspecialchars($image).'" id="imageToAnnotate" style="max-width: 100%; height: auto;">';
            // 实现可以在图片上标注点的JavaScript逻辑。
        }
    ?>
    <script>
        const imageContainer = document.getElementById('image-container');
        let count = 0;

        function addAnnotation(event) {
            // Calculate the position of the annotation
            const rect = event.target.getBoundingClientRect();
            const posX = event.clientX - rect.left;
            const posY = event.clientY - rect.top;

            // Create and position the annotation element
            const annotation = document.createElement('div');
            annotation.classList.add('annotation');
            annotation.style.left = `${posX}px`;
            annotation.style.top = `${posY}px`;
            annotation.innerText = ++count; // Increment the count and display as the annotation text

            // Append the annotation to the image container
            imageContainer.appendChild(annotation);

            // Prevent further event propagation
            event.preventDefault();
        }

        // Add click event listener to the image container
        document.getElementById('imageToAnnotate').addEventListener('click', addAnnotation);

        function saveAnnotations(image, annotations) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'save-annotations.php');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify({ image, annotations }));
            xhr.onload = function() {
                if (xhr.status == 200) {
                    alert('Annotations saved!');
                }
            };
        }

        document.getElementById('saveAnnotationsBtn').addEventListener('click', function() {
            const imageSrc = document.getElementById('imageToAnnotate').getAttribute('src');
            const annotations = []; // Store all annotation data.

            // 获取所有的批注元素（annotation），并且提取其数据。
            document.querySelectorAll('.annotation').forEach(function(annotation) {
                annotations.push({
                    left: annotation.style.left,
                    top: annotation.style.top,
                    text: annotation.textContent
                });
            });

            saveAnnotations(imageSrc, annotations);
        });
    </script>
    <button id="saveAnnotationsBtn">Save Annotations</button>
</body>
</html>
