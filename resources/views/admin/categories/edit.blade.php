@extends ("layouts.app")

@section ("title", "- Categories")
@section ("page_title", "Add Categories")
@section ("content")
    <div class="card">
        <div class="card-body">
            @include('admin.categories.form',['type'=>'edit',"action" => route("categories.update", $id)])
        </div>
    </div>
@endsection