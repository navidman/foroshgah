<ul class="list-group list-group-flush">
	@foreach($categories as $cat)
		<li class="list-group-item">
			<div class="d-flex">
				<span>{{ $cat->name }}</span>
				<div class="actions mr-2">
					<a href="#" class="badge badge-danger">حذف</a>
					<a href="#" class="badge badge-primary">ویرایش</a>
					<a href="#" class="badge badge-warning">ثبت زیر دسته</a>
				</div>
			</div>
			@if($cat->child->count())
				@include('admin.layouts.categories-group' , ['categories' => $cat->child])
			@endif	
		</li>
	@endforeach
</ul>