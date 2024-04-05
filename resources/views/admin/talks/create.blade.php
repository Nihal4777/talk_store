<x-admin-layout>
    <div class="heading">
        Add Script
    <!-- <div class="d-flex flex-column my-5 flex-wrap"> -->
    </div>
    @include('admin.talks.form',['type'=>'add',"action" => route("talks.store")])

    <!-- </div> -->
   
</x-admin-layout>