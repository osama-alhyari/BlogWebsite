<!DOCTYPE html>
<html lang="en">

@extends('layout.app')
@section('content')

<body>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="post-heading">
                        <h1 style="word-wrap: break-word; white-space: normal;">{{$post->first()->title}}</h1>
                        <h2 class="subheading" style="word-wrap: break-word; white-space: normal;">{{$post->first()->subtitle}}</h2>
                        <span class="meta mb-4">
                            Posted on
                            {{$post->first()->date_created}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-8 col-lg-6 col-xl-7" style="word-wrap: break-word; white-space: normal;">
                    {!! html_entity_decode($post->first()->content) !!}
                </div>
                <div class="col-md-3 col-lg-4 mt-2">
                    <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                        <div class="card-body p-4">

                            @foreach($post->first()->comments as $comment)
                            <div class="card mb-4">
                                @if($comment->user->id === Auth::user()->id)
                                <div class="card-title d-flex justify-content-end pe-1 pt-1">
                                    <!-- Edit Icon -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editCommentModal" data-comment-id="{{ $comment->id }}" data-comment-content="{{ $comment->content }}">
                                        <svg class="me-2" width="20" height="20" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.75c0-.414.336-.75.75-.75s.75.336.75.75v9.25c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm-2.011 6.526c-1.045 3.003-1.238 3.45-1.238 3.84 0 .441.385.626.627.626.272 0 1.108-.301 3.829-1.249zm.888-.889 3.22 3.22 8.408-8.4c.163-.163.245-.377.245-.592 0-.213-.082-.427-.245-.591-.58-.578-1.458-1.457-2.039-2.036-.163-.163-.377-.245-.591-.245-.213 0-.428.082-.592.245z" fill-rule="nonzero" />
                                        </svg>
                                    </a>

                                    <!-- Delete Icon -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteCommentModal" data-comment-id="{{ $comment->id }}">
                                        <svg width="20" height="20" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="m20.015 6.506h-16v14.423c0 .591.448 1.071 1 1.071h14c.552 0 1-.48 1-1.071 0-3.905 0-14.423 0-14.423zm-5.75 2.494c.414 0 .75.336.75.75v8.5c0 .414-.336.75-.75.75s-.75-.336-.75-.75v-8.5c0-.414.336-.75.75-.75zm-4.5 0c.414 0 .75.336.75.75v8.5c0 .414-.336.75-.75.75s-.75-.336-.75-.75v-8.5c0-.414.336-.75.75-.75zm-.75-5v-1c0-.535.474-1 1-1h4c.526 0 1 .465 1 1v1h5.254c.412 0 .746.335.746.747s-.334.747-.746.747h-16.507c-.413 0-.747-.335-.747-.747s.334-.747.747-.747zm4.5 0v-.5h-3v.5z" fill-rule="nonzero" />
                                        </svg>
                                    </a>
                                </div>
                                @endif
                                <div class="card-body">
                                    <p>{{$comment->content}}</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(4).webp" alt="avatar" width="25"
                                                height="25" />
                                            <p class="small mb-0 ms-2">{{$comment->user->name}}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endforeach





                            @auth
                            <form action="{{route('storeComment')}}" method="post" class="form-outline mb-4">
                                @csrf

                                @endauth

                                @guest
                                <form action="{{route('authentication')}}" class="form-outline mb-4">
                                    @endguest
                                    <input type="hidden" name="post_id" value="{{$post->first()->id}}" />

                                    <input type="text" name="content" id="addANote" class="form-control" placeholder="Type comment..." />
                                    <button class="btn btn-success mt-4" for="addANote">+ Add a comment</button>
                                </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editCommentForm" method="POST" action="{{ route('updateComment') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="comment_id" id="editCommentId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" name="content" id="editCommentContent"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteCommentModal" tabindex="-1" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteCommentForm" method="POST" action="{{ route('deleteComment') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="comment_id" id="deleteCommentId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCommentModalLabel">Delete Comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this comment?
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
            // Edit Comment Modal
            var editCommentModal = document.getElementById('editCommentModal');
            editCommentModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var commentId = button.getAttribute('data-comment-id');
                var commentContent = button.getAttribute('data-comment-content');

                // Set values in the form fields
                document.getElementById('editCommentId').value = commentId;
                document.getElementById('editCommentContent').value = commentContent;
            });

            // Delete Comment Modal
            var deleteCommentModal = document.getElementById('deleteCommentModal');
            deleteCommentModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var commentId = button.getAttribute('data-comment-id');

                // Set comment ID in the form field
                document.getElementById('deleteCommentId').value = commentId;
            });
        });
    </script>
    @endsection

</body>

</html>