<tr>

    <td style="text-align: center   ">

        <a href="/products/{{$item['product']->id}}">
            <img src="/images/{{explode(';',$item['product']->image_urls)[0]}}" style="width: 120px"><br>
            <strong>{{$item['product']->name}}</strong></a>
    </td>
    <td>
        @if($item['product']->price>$item['product']->sale_off)
            <del>{{$item['product']->price}}$</del>
            <span style="color: orangered;margin-left: 10px">{{$item['product']->sale_off}}$</span>
        @else
            {{$item['product']->price}}$
        @endif

    </td>
    <td>
        <div class="ui input">
            <input data-id="{{$item['product']->id}}"
                   max="{{$item['product']->in_stock}}"
                   min="1"
                   class="product_input"
                   value="{{$item['quantity']}}" type="number">
        </div>
    </td>
    <td class="footable-last-visible" style="display: table-cell;">
        <a onclick="ask_to_delete_item_from_cart({{$item['product']->id}})" href="javascript:void(0);"
           class="ui icon yellow button"><i class="delete icon"></i></a>
    </td>
</tr>