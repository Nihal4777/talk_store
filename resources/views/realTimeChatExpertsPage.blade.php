<x-primary-layout>
    <div class="container section-padding" style="font-size: 20px">
        <div class="heading text-white text-center" style="font-size: 24px">
            Choose the expert that meets your needs
        </div>
        <div class="text-white fw-bold mt-5" style="text-decoration: underline">
            Available experts:
        </div>
        <div class="">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scopr="col" class="bg-transparent text-white">Name</th>
                        <th scopr="col" class="bg-transparent text-white"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($experts as $expert)
                        <tr>
                            <td class="bg-transparent text-white" scope="row">{{ $expert->user->name }}</td>
                            <td class="bg-transparent text-white" scope="row">
                                <form  method="POST" action="/realTimeChat/experts/{{$expert->user->id}}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Talk Now</button>
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-primary-layout>
