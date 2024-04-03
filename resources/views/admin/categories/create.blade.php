@extends ("layouts.app")

@section ("title", "- Category")
@section ("page_title", "Add Category")
@section ("content")
    <div class="card">
        <div class="card-body">
            @include('admin.categories.form',['type'=>'add',"action" => route("categories.store")])
        </div>
    </div>

@endsection