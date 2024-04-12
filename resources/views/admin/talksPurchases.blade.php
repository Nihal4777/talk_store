<x-admin-layout>
    <div class="heading">
        Talk Purchases
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
                    <th>Talk Name</th>
                    <th>Order Id</th>
                    <th>Amount</th>
                    <th>Payement Id</th>
                    <th>User Name</th>
                </tr>
                @foreach ($orders as $id=>$order)
                    <tr>
                        <td scope="row">{{$id+1}}</td>
                        <td scope="row">{{$order->talk->title}}</td>
                        <td scope="row">{{$order->order_id}}</td>
                        <td scope="row">{{$order->amount/100}}</td>
                        <td scope="row">{{$order->payment_id}}</td>
                        <td scope="row">{{$order->user->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
