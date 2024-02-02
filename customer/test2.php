<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open File with Custom Header</title>
</head>
<body>

<a href="#" id="openFileLink" target="_blank">Open File</a>

<script>
    document.getElementById('openFileLink').addEventListener('click', function () {
        // Replace 'path/to/your/file.pdf' with the actual path to your file on the server
        var fileUrl = 'test3.php?url=' + encodeURIComponent('../img/fyp.pdf') + '&name=' + encodeURIComponent('Atin');

        // Set the href attribute to trigger opening in a new tab
        this.href = fileUrl;
    });
</script>

</body>
</html>
