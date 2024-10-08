@extends('layouts.app')

@section('content')

  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Upload Image</h5>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('upload-image.store') }}" method="POST" class="dropzone" id="imageDropzone">
                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <div id="image" class="dropzone dz-clickable">
                            <div class="dz-message needsclick">
                                <br>Drop files here or click to upload.<br><br>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


      </div>
    </div>
  </div>

@endsection

@section('Customjs')

<script>
    Dropzone.options.imageDropzone = {
        
        paramName: "image", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        uploadMultiple: true,
        parallelUploads: 10,
        maxFiles: 10,
        init: function () {
            this.on("success", function (file, response) {
                console.log("Successfully uploaded:", file);
            });
            this.on("error", function (file, response) {
                console.log("Upload error:", response);
            });
        }
    };
</script>

@endsection
