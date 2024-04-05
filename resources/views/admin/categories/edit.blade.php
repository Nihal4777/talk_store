<x-admin-layout>
    @include('admin.categories.form',['type'=>'edit',"action" => route("categories.update", $category)])
</x-admin-layout>