<x-admin-layout>
    <div class="heading">
        Add categories
    </div>
    @include('admin.categories.form',['type'=>'add',"action" => route("categories.store")])
    <div class="mt-5">
        <table class="table table-hover">

            <tbody>
               @foreach ($categories as $id=>$category)
               <tr>
                <th scope="row">{{$id+1}}</th>
                <td>{{$category->name}}</td>
                <td>
                    <a class="btn btn-success" href="{{route("categories.edit",$category->id)}}">Edit</a>
                </td>
                <td>
                    <form  method="POST" action="{{route('categories.destroy', ['category' => $category->id])}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
