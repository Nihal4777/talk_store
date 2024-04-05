<form action="{{ $action }}" method="POST">
    {{-- <form action="{{route('categories.store')}}" method="post"> --}}
    @csrf
    @if ($type == 'edit')
        @method('PUT')
    @endif
    <div class="row mb-3">
        <div class="col-md-3 col-12">
            <input type="text" class="form-control" placeholder="Person 1 name" name="name" value="{{$category->name}}">
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-warning font-weight-bold">{{ $type == 'add' ? 'Add' : 'Update' }}
            Category</button>
    </div>
</form>
