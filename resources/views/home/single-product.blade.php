@extends('layouts.app')

@section('script')
    <script>
        $('#sendComment').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
          
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
                    <form action="{{ route('send.comment') }}" method="POST">
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
