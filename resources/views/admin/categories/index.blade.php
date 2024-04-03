<x-admin-layout>
    <div class="heading">
        Add categories
    </div>
    <form action="{{route('categories.store')}}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3 col-12">
                <input type="text" class="form-control" placeholder="Person 1 name" name="name" id="">
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-warning font-weight-bold">Add Script</button>
        </div>
    </form>
    <div class="mt-5">
        <table class="table table-hover">

            <tbody>
               @foreach ($categories as $id=>$category)
               <tr>
                <th scope="row">{{$id+1}}</th>
                <td>{{$category->name}}</td>
                <td data-toggle="modal" data-target="#scriptEditModal" data-bs-target="#staticBackdrop">
                    <div class="btn btn-success">Edit</div>
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
