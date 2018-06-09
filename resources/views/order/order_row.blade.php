<tr>
    <td>
        <a href="/orders/{{$item->id}}">#{{$item->id}}</a>
    </td>
    <td>
        <h5>
            {{$item->getTotal()}}
        </h5>
    </td>
    <td>
        <h5>
            {{$item->getStatus()}}
        </h5>
    </td>
    <td><h5>{{$item->updated_at}}</h5></td>
    <td>
        @if($item->status!='done')
            <a href="javascript:void(0);" onclick="ask_to_dispose_order({{$item->id}})" class="ui icon yellow button"><i
                        class="delete icon"></i> Hủy bỏ</a>
        @endif
    </td>
</tr>