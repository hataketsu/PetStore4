<tr>
    <td>
        {{$item->url}}
    </td>
    <td>
        <img src="/images/{{$item->image}}" style="width:120px;">
    </td>
    <td>
        <div class="ui buttons">
        <a href="/ads/{{$item->id}}/edit" class="ui icon green button"><i class="pencil icon"></i> Sửa</a>
        <a href="javascript:void(0);" onclick="ask_to_delete('Xóa quảng cáo?','/ads/{{$item->id}}/delete')" class="ui icon yellow button"><i class="delete icon"></i> Xóa</a>
        </div>
    </td>
</tr>