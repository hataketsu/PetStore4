<tr>
    <td>
        #{{$item->id}}
    </td>
    <td>
        {{$item->url}}
    </td>
    <td>
        <a href="/blogs/{{$item->id}}"> {{$item->title}}</a>
    </td>
    <td>
        {{$item->updated_at}}
    </td>

    <td>
        <div class="ui buttons">
        <a href="/blogs/{{$item->id}}/edit" class="ui icon green button"><i class="pencil icon"></i> Sửa</a>
        <a href="javascript:void(0);" onclick="ask_to_delete('Xoá bài viết?','/blogs/{{$item->id}}/delete')" class="ui icon yellow button"><i class="delete icon"></i> Xóa</a>
        </div>
    </td>
</tr>
