<x-primary-layout>
    <div class="container section-padding" style="padding-top: 100px">
        <div class="table-responsive text-center">


            <table class="table" style="font-size: 20px; color: white;">
                <thead>
                    <tr class="text-warning">

                        <th scope="col">Script</th>
                        <th scope="col">Progress</th>
                        <th scope="col">Continue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($talks as $order)
                    <tr>
                        <td>{{$order->talk->title}}</td>
                        <td class="align-middle">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{$order->progress}}%;color:#efefef;" aria-valuenow="{{$order->progress}}"
                                <div class="progress-bar" role="progressbar" style="width: {{$order->progress}}%;color:#efefef;" aria-valuenow="{{$order->progress}}"
                                    aria-valuemin="0" aria-valuemax="100">{{$order->progress}}%</div>
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-success" href="/talk/chat/{{$order->talk_id}}">Continue challenge</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-primary-layout>