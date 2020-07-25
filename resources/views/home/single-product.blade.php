@extends('layouts.app')

@section('script')
    <script>
        $('#sendComment').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
          
        })

        document.querySelector('#sendCommentForm').addEventListener('submit' , function(event){

            event.preventDefault();
            let target = event.target;
            let data = {
                commentable_id : target.querySelector('input[name = "commentable_id"]').value,
                commentable_type : target.querySelector('input[name = "commentable_type"]').value,
                parent_id : target.querySelector('input[name = "parent_id"]').value,
                comment : target.querySelector('textarea[name = "comment"]').value
            }
            if (data.comment.length < 2) {
                console.error('please enter more than 2 characters')
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                    'content-type' : 'application/json'
                }
            })

            $.ajax({
                type : 'POST',
                url : '/comments',
                data : JSON.stringify(data),
                success : function(data) {
                    console.log(data);
                }
            })

        })
    </script>
@endsection

@section('content')

    <div class="modal fade" style="direction:rtl!important;text-align:right!important" id="sendComment">
        <div class="modal-dialog">
            @auth
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ارسال نظر</h5>
                        <button type="button" class="close mr-auto ml-0" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('send.comment') }}" method="POST" id="sendCommentForm">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="commentable_id" value="{{ $product->id }}">
                            <input type="hidden" name="commentable_type" value="{{ get_class($product) }}">
                            <input type="hidden" name="parent_id" value="0">
                            <div class="form-group">
                                <label for="comment" class="col-form-label">پیام دیدگاه:</label>
                                <textarea name="comment" class="form-control" id="comment"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                            <button type="submit" class="btn btn-primary">ارسال نظر</button>
                        </div>
                    </form>
                </div>
            @endauth
        </div>
    </div>

    <div class="container" style="direction:rtl!important;text-align:right!important">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ $product->title }}
                    </div>

                    <div class="card-body">
                        {{ $product->description }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="mt-4">بخش نظرات</h4>
                    @auth
                        <span class="btn btn-sm btn-primary" data-toggle="modal" data-target="#sendComment">ثبت نظر جدید</span>
                    @endauth
                </div>
                <!-- <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="commenter">
                            <span>نام نظردهنده</span>
                            <span class="text-muted">- دو دقیقه قبل</span>
                        </div>
                        <span class="btn btn-sm btn-primary" data-toggle="modal" data-target="#sendComment" data-id="2" data-type="product">پاسخ به نظر</span>
                    </div>

                    <div class="card-body">
                        محصول زیبایه

                        <div class="card mt-3">
                            <div class="card-header d-flex justify-content-between">
                                <div class="commenter">
                                    <span>نام نظردهنده</span>
                                    <span class="text-muted">- دو دقیقه قبل</span>
                                </div>
                            </div>

                            <div class="card-body">
                                محصول زیبایه
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
       </div>
    </div>
@endsection
