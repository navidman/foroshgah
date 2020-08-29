<ul style="direction:rtl!important; text-align: right;">
	@foreach($categories as $category)
		<li>
			{{ $category->name }}
			@if($category->child)
				@include('layouts.list-categories' , ['categories' => $category->child])
			@endif
		</li>
	@endforeach
</ul>