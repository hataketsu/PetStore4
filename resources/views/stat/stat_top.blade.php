<h3 class="ui header">Sản phẩm xem nhiều nhất</h3>
<table class="ui celled table">
    <thead>
    <tr>
        <th>Sản phẩm</th>
        <th>Lượt xem</th>
    </tr>
    </thead>
    <tbody>
    @foreach($top_views as $item)
        @if($item->product!=null)
            <tr>
                <td>
                    <a href="/products/{{$item->product_id}}">{{$item->product->name}}</a>
                </td>
                <td>
                    {{$item->views}}
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>

<h3 class="ui header">Sản phẩm bán nhiều nhất</h3>
<table class="ui celled table">
    <thead>
    <tr>
        <th>Sản phẩm</th>
        <th>Doanh số</th>
    </tr>
    </thead>
    <tbody>
    @foreach($top_solds as $item)
        @if($item->product!=null)

            <tr>
                <td>
                    <a href="/products/{{$item->product_id}}">{{$item->product->name}}</a>
                </td>
                <td>
                    {{$item->solds}}
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>