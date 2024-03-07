<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Annotate Image</title>
    <style>
        #image-container {
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
    <div id="image-container">
        <img src="libr.jpg" id="imageToAnnotate" alt="Annotatable Image">
    </div>
    <script>
        const imageContainer = document.getElementById('image-container');
        let count = 0;

        function addAnnotation(event) {
            const rect = event.target.getBoundingClientRect();
            const posX = event.clientX - rect.left;
            const posY = event.clientY - rect.top;

            const annotation = document.createElement('div');
            annotation.classList.add('annotation');
            annotation.style.left = `${posX}px`;
            annotation.style.top = `${posY}px`;
            annotation.innerText = ++count;

            imageContainer.appendChild(annotation);

            event.preventDefault();
        }

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
            const annotations = [];

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
