@extends('admin.admin_master')

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--tinymce js-->
    <script src="{{ asset('backend/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ asset('backend/assets/js/pages/form-editor.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection

@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">About Page</h4>

                            <form method="post" action="{{ route('update.about') }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $about_page->id }}">

                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input name="title" id="title" class="form-control" type="text" value="{{ $about_page->title }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="short_title" class="col-sm-2 col-form-label">Short Title</label>
                                    <div class="col-sm-10">
                                        <input name="short_title" id="short_title" class="form-control" type="text" value="{{ $about_page->short_title }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="short_description" class="col-sm-2 col-form-label">Short Title</label>
                                    <div class="col-sm-10">
                                        <textarea name="short_description" id="short_description" class="form-control" rows="5">{{ $about_page->short_description }}</textarea>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="long_description" class="col-sm-2 col-form-label">Long Title</label>
                                    <div class="col-sm-10">
                                        <textarea name="long_description" id="elm1" class="form-control" rows="5">{{ $about_page->long_description }}</textarea>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="about_image" class="col-sm-2 col-form-label">About Image</label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-md mb-3" src="{{ (!empty($about_page->about_image)) ? url($about_page->about_image) : url('upload/no_image.jpg')  }}" alt="">
                                        <input name="about_image" id="image" class="form-control" type="file">
                                    </div>
                                </div>
                                <!-- end row -->

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update About">

                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>
@endsection
