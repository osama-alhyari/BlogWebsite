<!DOCTYPE html>
<html lang="en">

@extends('layout.app')
@section('content')

<body>


    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Recent Posts</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Post preview-->
                @if(!($posts->isEmpty()))
                @foreach($posts as $post)
                <div class="post-preview">
                    <a href="{{route('showPost', $post->id)}}">
                        <h2 class="post-title">{{$post->title}}</h2>
                        @if($post->subtitle)
                        <h3 class="post-subtitle">{{$post->subtitle}}</h3>
                        @endif
                    </a>
                    <p class="post-meta">
                        Posted on
                        {{$post->date_created}}
                    </p>
                </div>
                @auth
                @if(Auth::user()->is_admin)

                <div class="d-flex justify-content-between">
                    <a href="{{route('editPost',$post->id)}}" type="button" class="btn btn-secondary">Edit Post</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deletePostModal" data-post-id="{{ $post->id }}">
                        Delete Post
                    </button>
                </div>
                @endif
                @endauth

                <!-- Divider-->
                <hr class="my-4" />
                @endforeach
                @else

                <div class="post-preview">
                    <h2 class="post-title">No Posts Currently Available</h2>
                    <h3 class="post-subtitle">Come Back Soon!</h3>
                </div>


                @endif
                <!-- Pager-->
                <div class="d-flex justify-content-between mb-4" id="paginationBlock">{{ $posts->links() }}</div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deletePostForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePostModalLabel">Delete Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this post?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deletePostModal = document.getElementById('deletePostModal');
            deletePostModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var postId = button.getAttribute('data-post-id');

                // Set the form action to the delete route with the post ID
                var deleteForm = document.getElementById('deletePostForm');
                deleteForm.action = '/posts/' + postId;
            });
        });
    </script>
</body>
@endsection

</html>