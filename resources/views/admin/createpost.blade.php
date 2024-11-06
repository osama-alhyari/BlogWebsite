<!DOCTYPE html>
<html lang="en">

@extends('layout.app')
@section('content')

<body>
    <header class="masthead">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Create Post</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container my-5">
        <form id="postForm" action="post" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-xl-8 col-lg-8 col-sm-12 col-12 m-auto">
                    <div class="card shadow">
                        <div class="card-body">
                            <a href="{{ url('posts') }}" class="btn btn-danger mb-3"> Back </a>

                            <div class="form-group mb-3">
                                <label class="mb-1">Post Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter The Title">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">Post Sub Title (Optional)</label>
                                <input type="text" class="form-control" name="subtitle" placeholder="Enter The Sub Title">
                                @error('subtitle')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">Post Content</label>
                                <textarea class="form-control" id="body" placeholder="Enter The Post Content" name="content"></textarea>
                                @error('content')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Client-Side Validation Script -->
    <script>
        $(document).ready(function() {
            $('#postForm').submit(function(event) {
                let isValid = true;

                // Clear previous error messages
                $('span.text-danger').text('');

                // Title validation
                const title = $('input[name="title"]').val().trim();
                if (title === "") {
                    $('input[name="title"]').next('.text-danger').text("Title is required.");
                    isValid = false;
                }

                // Body validation
                const body = $('textarea[name="body"]').val().trim();
                if (body === "") {
                    $('textarea[name="body"]').next('.text-danger').text("Body is required.");
                    isValid = false;
                }

                // Prevent form submission if validation fails
                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>

</body>
@endsection

</html>