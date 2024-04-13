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
                    <th class="bg-transparent">Sr.</th>
                    <th class="bg-transparent">Title</th>
                    <th class="bg-transparent">Description</th>
                    <th class="bg-transparent">Person 1</th>
                    <th class="bg-transparent">Person 2</th>
                    <th class="bg-transparent"></th>
                    <th class="bg-transparent"></th>
                </tr>
                @foreach ($talks as $id=>$talk)
                    <tr>
                        <td class="bg-transparent" scope="row">{{$id+1}}</td>
                        <td class="bg-transparent" scope="row">{{$talk->title}}</td>
                        <td class="bg-transparent" scope="row">{{$talk->description}}</td>
                        <td class="bg-transparent" scope="row">{{$talk->person1_name}}</td>
                        <td class="bg-transparent" scope="row">{{$talk->person2_name}}</td>
                        <td class="bg-transparent" data-toggle="modal" data-target="#scriptEditModal" data-bs-target="#staticBackdrop">
                            <a class="btn btn-success" href="{{route('talks.edit',$talk->id)}}">Edit</a>
                        </td>
                        <td class="bg-transparent">
                            <form  method="POST" action="{{route('talks.destroy',$talk->id)}}">
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
