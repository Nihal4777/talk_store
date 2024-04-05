<x-admin-layout>
    <div class="heading">
        Add Script
    </div>
    @include('admin.talks.form',['type'=>'Update',"action" => route("talks.update",$talk->id)])
</x-admin-layout>