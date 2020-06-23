<div class="table-responsive">
    <table class="table table-padded recent-order-list-table table-responsive-fix-big">
        <thead>
        <tr>
            <th>#No</th>
            <th>Customer Name</th>
            <th>Delivery Date & Time</th>
            <th>Location</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Info</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{$loop->iteration + ($pageNum - 1)*$perPage }}</td>
                <td><a href="javascript:void()" class="mr-2 bg-primary rounded-circle text-center text-uppercase d-inline-block">{{$order->first_name[0].$order->last_name[0]}}</a> <span class="text-pale-sky">{{$order->first_name . ' ' . $order->last_name}}</span>
                </td>
                <td class="text-muted">{{$order->created_at->format("j F Y, g:i A")}}</td>
                <td><a href="javascript:void()" class="text-primary">{{$order->city}}</a></td>
                <td><span class="text-pale-sky">$ {{number_format($order->grand_total, 3)}}</span></td>
                <td>
                    @if($order->status == 'Hold')
                        <span class="label label-xl label-rounded label-{{config('constants.status.' . $order->status)}}">{{$order->status}}</span>
                    @else
                        <span class="label label-xl label-rounded label-{{config('constants.status.' . $order->status)}}">{{$order->status}}</span>
                    @endif
                </td>
                <td>
                    <a href="{{url("/admin/orderInfo?order_id=$order->id")}}">
                        <i class="fa fa-info color-muted"> View More</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $orders->links() !!}
</div>

