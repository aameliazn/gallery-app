<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Photo</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" />

</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Drop Multiple Images
                            <a href="{{ route('dashboard') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <label>Drag and Drop Multiple Images (JPG, JPEG, PNG)</label>

                        <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data"
                            class="dropzone" id="myDragAndDropUploader">
                            @csrf
                        </form>

                        <h5 id="message"></h5>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var maxFilesizeVal = 12;
        var maxFilesVal = 10;

        // Note that the name "myDragAndDropUploader" is the camelized id of the form.
        Dropzone.options.myDragAndDropUploader = {

            paramName: "file",
            maxFilesize: maxFilesizeVal, // MB
            maxFiles: maxFilesVal,
            resizeQuality: 1.0,
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: false,
            timeout: 60000,
            dictDefaultMessage: "Drop your files here or click to upload",
            dictFallbackMessage: "Your browser doesn't support drag and drop file uploads.",
            dictFileTooBig: "File is too big. Max filesize: " + maxFilesizeVal + "MB.",
            dictInvalidFileType: "Invalid file type. Only JPG, JPEG, and PNG files are allowed.",
            dictMaxFilesExceeded: "You can only upload up to " + maxFilesVal + " files.",
            maxfilesexceeded: function(file) {
                this.removeFile(file);
                // this.removeAllFiles(); 
            },
            sending: function(file, xhr, formData) {
                $('#message').text('Image Uploading...');
            },
            success: function(file, response) {
                $('#message').text(response.success);
                console.log(response.success);
                console.log(response);
            },
            error: function(file, response) {
                $('#message').text('Something Went Wrong! ' + response);
                console.log(response);
                return false;
            }
        };
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
