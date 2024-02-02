<!-- dekat form -->
<input type="hidden" name="current_image" value="../assets/default_pd.jpeg">
<!-- Image Preview -->
<div class="mb-2">
    <img src="../assets/default_pd.jpeg" name="up_image" id="uploaded_image" class="w-36 h-36 rounded-lg" />
</div>
<input type="hidden" name="image" id="cropped_image" value="">
<input type="file"
    class="mt-2.5 block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-500 placeholder-gray-400"
    id="upload_image" />
<p class="mt-1 text-sm text-gray-300" id="file_input_help">
    PNG or
    JPG (MAX.
    1080x1080px).</p>


<!-- untuk crop (script & modal) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/dropzone.min.css" />
<link href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />

<style>
    img {
        display: block;
        max-width: 100%;
    }

    .preview2 {
        overflow: hidden;
        width: 180px;
        height: 180px;
        margin-left: auto;
        border: 1px solid red;
    }
</style>


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
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="img-container">
                    <div class="flex mx-auto">
                        <div class="w-8/12">
                            <img src="" id="sample_image" />
                        </div>
                        <div class="ml-auto w-4/12">
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
            </div>

        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function () {

        var $modal = $('#modal');

        var image = document.getElementById('sample_image');

        var cropper;

        $('#upload_image').change(function (event) {
            var files = event.target.files;

            var done = function (url) {
                image.src = url;
                $modal.modal('show');
            };

            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function (event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $('#crop').click(function () {
            canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400
            });

            canvas.toBlob(function (blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;

                    // Hide the modal
                    $modal.modal('hide');
                    // Optionally, update the preview image on your form
                    $('#uploaded_image').attr('src', base64data);
                    $('#cropped_image').attr('value', base64data);
                    $('#cropped_image').val(base64data);
                };
            });
        });

    });
</script>


<!-- untuk php -->
<?php
if (isset($_POST['image'])) {
    $data = $_POST['image'];

    $image_array_1 = explode(";", $data);


    $image_array_2 = explode(",", $image_array_1[1]);

    $data = base64_decode($image_array_2[1]);

    $PdPhotoPath = '../img/' . time() . '.png';

    file_put_contents($PdPhotoPath, $data);
} else {
    // If no new file is selected, use the current user profile photo path
    $PdPhotoPath = $current_image;
}
?>