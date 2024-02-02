<!-- <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Cropper</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" /> -->
 <script src="https://cdn.tailwindcss.com"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
<link href="cropperjs/cropper.css" rel="stylesheet">
<script src="cropperjs/cropper.js"></script>

<style type="text/css">
    .img-container {
        width: 100%;
        /* or any other maximum width you prefer */
        height: 500px;
        /* or any other fixed height you prefer */
        margin: auto;
    }


    .preview {
        overflow: hidden;
        width: 180px;
        height: 180px;
        border: 1px solid red;
    }
</style>

<!-- <body> -->
    <div class="container">
        <h5>Upload Images</h5>
        <form method="post">
            <input type="file" name="image" class="image">
        </form>
    </div>

<!-- Main modal -->
<div id="modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-50 w-full h-full overflow-y-auto bg-gray-800 bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl mx-auto">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-white">
                    Crop image
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                    onclick="closeModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="img-container">
                    <div class="grid grid-cols-3">
                        <div class="col-span-2">
                            <!-- default image where we will set the src via jQuery -->
                            <img id="image" class="w-full">
                        </div>
                        <div class="col-span-1 ml-auto">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex justify-end items-center p-4 md:p-5 border-t rounded-b border-gray-600">
                <button type="button" id="crop"
                    class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                    Crop
                </button>
                <button onclick="closeModal()" type="button"
                    class="ms-3 focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">
                    Cancel
                </button>
            </div>

        </div>
    </div>
</div>


</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="cropperjs/cropper.min.js" type="text/javascript"></script>
<script>
    var modal = document.getElementById('modal');
    var image = document.getElementById('image');
    var cropper, reader, file;

    function openModal() {
        modal.classList.remove('hidden');
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview'
        });
    }

    function closeModal() {
        modal.classList.add('hidden');
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }

    $("body").on("change", ".image", function (e) {
        var files = e.target.files;
        var done = function (url) {
            image.src = url;
            openModal();
        };

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $("#crop").on("click", function () {
        var canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        canvas.toBlob(function (blob) {
            var formData = new FormData();
            formData.append('croppedImage', blob, 'cropped_image.png');

            $.ajax({
                type: "POST",
                url: "test1.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    closeModal();
                    // alert("Image uploaded successfully!");
                },
                error: function (error) {
                    console.error(error);
                    closeModal();
                    // alert("Error uploading image!");
                }
            });
        });
    });
</script>

<!-- 
</body>

</html> -->