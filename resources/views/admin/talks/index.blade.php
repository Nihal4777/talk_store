<x-admin-layout>
    <div class="heading">
        Script
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

    <div class="mt-5">
        <table class="table table-hover">

            <tbody>
                <tr>
                    <th>Sr.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Person 1</th>
                    <th>Person 2</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($talks as $id=>$talk)
                    <tr>
                        <td scope="row">{{$id+1}}</td>
                        <td scope="row">{{$talk->title}}</td>
                        <td scope="row">{{$talk->description}}</td>
                        <td scope="row">{{$talk->person1_name}}</td>
                        <td scope="row">{{$talk->person2_name}}</td>
                        <td data-toggle="modal" data-target="#scriptEditModal" data-bs-target="#staticBackdrop">
                            <div class="btn btn-success">Edit</div>
                        </td>
                        <td>
                            <div class="btn btn-danger">Delete</div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
