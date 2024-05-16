<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Date</th>
        <th>Total</th>
        <th>Patronage</th>
        <th>Price</th>
        <th>Size</th>
        <th>Quantity</th>
        <th>Number</th>
        <th>Nickname</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>#{{ $order->id }}</td>
            <td>{{ $order->customer->user->name }}</td>
            <td>{{ $order->customer->user->email }}</td>
            <td>{{$order->created_at->format('d.m.Y')}}</td>
            <td>{{$order->total}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @foreach($order->project->patronages as $patronage)
            @php
                $details = json_decode($patronage->details, true);
            @endphp
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                @if($patronage->is_custom_patronage)
                <td>Custom</td>
                @else
                <td>{{$patronage->patronage->title}}</td>
                @endif
                <td>{{$patronage->price_per_item_with_discount}}</td>
                <td>{{$details[0]['size']}}</td>
                <td>{{$details[0]['quantity']}}</td>
                <td>{{$details[0]['number']}}</td>
                <td>{{$details[0]['nickname']}}</td>
            </tr>
            @if(count($details)>1)
                @foreach($details as $i=>$detail)
                    @if($i>0)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$detail['size']}}</td>
                        <td>{{$detail['quantity']}}</td>
                        <td>{{$detail['number']}}</td>
                        <td>{{$detail['nickname']}}</td>
                    </tr>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endforeach
    </tbody>
</table>