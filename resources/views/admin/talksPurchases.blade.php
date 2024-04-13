<x-admin-layout>
    <div class="heading">
        Talk Purchases
        
    </div>

    <div class="mt-5">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th class="bg-transparent">Sr.</th>
                    <th class="bg-transparent">Talk Name</th>
                    <th class="bg-transparent">Order Id</th>
                    <th class="bg-transparent">Amount</th>
                    <th class="bg-transparent">Payement Id</th>
                    <th class="bg-transparent">User Name</th>
                    <th class="bg-transparent">Date</th>
                </tr>
                @foreach ($orders as $id=>$order)
                    <tr>
                        <td class="bg-transparent" scope="row">{{$id+1}}</td>
                        <td class="bg-transparent" scope="row">{{$order->talk->title}}</td>
                        <td class="bg-transparent" scope="row">{{$order->order_id}}</td>
                        <td class="bg-transparent" scope="row">{{$order->amount/100}}</td>
                        <td class="bg-transparent" scope="row">{{$order->payment_id}}</td>
                        <td class="bg-transparent" scope="row">{{$order->user->name}}</td>
                        <td class="bg-transparent" scope="row">{{$order->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
