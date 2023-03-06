@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Logo Maintenance</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Logo Maintenance</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class='text-center'>Logo</h2>
                        <form action="{{ route('uploadLogo', $logo[0]->id) }}" class="row mb-2" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12 justify-content-center">
                                <div class="image-preview-container">
                                    <div class="preview">
                                        <img id="preview-selected-image" src="{{ asset('Image/' . $logo[0]->img_url) }}"
                                            style="display:block" />
                                    </div>
                                    <label for="file-upload">Upload Image</label>
                                    <input type="file" id="file-upload" name="input-image"
                                        onchange="previewImage(event);" value="{{ old('input-image') }}" accept="image/*">
                                    @error('input-image')
                                        <span class="invalidFeedback" role="alert">
                                            {{ str_replace('input-image', 'Image', $message) }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">Update Logo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const previewImage = (event) => {
                const imageFiles = event.target.files;
                const imageFilesLength = imageFiles.length;
                if (imageFilesLength > 0) {
                    const imageSrc = URL.createObjectURL(imageFiles[0]);
                    const imagePreviewElement = document.querySelector("#preview-selected-image");
                    imagePreviewElement.src = imageSrc;
                    imagePreviewElement.style.display = "block";
                }
            };
        </script>
    </div>
@endsection
