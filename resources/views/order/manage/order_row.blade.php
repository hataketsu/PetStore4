<tr>
    <td>
        <a href="/orders/{{$item->id}}">#{{$item->id}}</a>
    </td>
    <td><h5>
            {{$item->user_id==null?'Guest':('#'.$item->user_id.'# '.$item->user->name)}}
        </h5>
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
        <div class="ui buttons">
            <a href="javascript:void(0);" onclick="ask_to_dispose_order({{$item->id}})" class="ui icon yellow button"><i
                        class="delete icon"></i> Dispose</a>
            <a href="javascript:void(0);" onclick="ask_to_confirm_order({{$item->id}})" class="ui primary button">Confirm</a>
            <a href="javascript:void(0);" onclick="ask_to_ship_order({{$item->id}})" class="ui primary button">Ship</a>
            <a href="javascript:void(0);" onclick="ask_to_done_order({{$item->id}})" class="ui primary button">Done</a>
        </div>
    </td>
</tr>