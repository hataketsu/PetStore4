<tr>
    <td style="text-align: center   ">

        <a href="/products/{{$item['product']->id}}">
            <img src="/images/{{explode(';',$item['product']->image_urls)[0]}}" style="width: 120px"><br>
            <strong>{{$item['product']->name}}</strong></a>
    </td>
    <td>{{$item->final_price }}$</td>
    <td>
        <h5>{{$item->quantity}}</h5>
    </td>
</tr>