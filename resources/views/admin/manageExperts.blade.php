<x-admin-layout>
    <div class="heading">
        Add experts
    </div>
    <div class="">
        <form method="post">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">
                    <input type="text" class="form-control mt-3" name="name" id="" placeholder="Expert name">
                </div>
                <div class="col-12 col-md-6">
                    <input type="email" class="form-control mt-3" name="email" id=""
                        placeholder="Expert email">
                </div>
            </div>
            <div>
                <input type="submit" class="btn btn-warning mt-3" value="Add Expert">
            </div>
        </form>
    </div>
    <div class="mt-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scopr="col" class="bg-transparent">Name</th>
                    <th scopr="col" class="bg-transparent">Email</th>
                    <th scopr="col" class="bg-transparent"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($experts as $expert)
                    <tr>
                        <td class="bg-transparent" scope="row">{{$expert->name}}</td>
                        <td class="bg-transparent" scope="row">{{$expert->email}}</td>
                        <td class="bg-transparent" scope="row">
                            <form  method="POST" action="/admin/removeExpert/{{$expert->id}}">
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
