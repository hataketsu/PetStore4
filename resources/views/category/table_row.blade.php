<tr>
    <td>
        #{{$item->id}}
    </td>
    <td>
        <a href="/categories/{{$item->id}}">{{$item->name}}</a>
    </td>
    <td>{{$item->sort}}</td>
    <td>
        <div class="ui buttons">
        <a href="/categories/{{$item->id}}/edit" class="ui icon green button"><i class="pencil icon"></i> Sửa</a>
        <a href="javascript:void(0);" onclick="ask_to_delete_category({{$item->id}})" class="ui icon yellow button"><i class="delete icon"></i> Xóa</a>
        </div>
    </td>
</tr>