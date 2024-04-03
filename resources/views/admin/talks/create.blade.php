<x-admin-layout>
    <div class="heading">
        Add Script
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
    <!-- <div class="d-flex flex-column my-5 flex-wrap"> -->

    <form enctype="multipart/form-data" action="{{route('talks.store')}}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6 col-12">
                <select class="form-control" name='category_id'>
                    <option value="default" selected disabled>--Select Category--</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach 
                </select>
            </div>
            <div class="col-md-6 col-12">
                <input type="text" name="title" class="form-control" placeholder="Add title of the script" id="">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 col-12">
                <input type="text" class="form-control" placeholder="Person 1 name" name="person1_name" id="">
            </div>
            <div class="col-md-3 col-12">
                <input type="text" class="form-control" placeholder="Person 2 name" name="person2_name" id="">
            </div>
            <div class="form-group col-md-6 col-12">
                <textarea class="form-control" id="" name="description" placeholder="Enter description"></textarea>
            </div>
            <div class="form-group col-12">
                <textarea class="form-control" id="" rows="15" name="script" placeholder="Enter script"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <input type="number" min="1" class="form-control" placeholder="Price" name="price" id="" required>
            </div>
            <div class="col-md-6 col-12">
                <input type="file" class="form-control" accept="image/*" name="image" id="">
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-warning font-weight-bold">Add Script</button>
        </div>
    </form>

    <!-- </div> -->
   
</x-admin-layout>