<tr>
    <td>
        {{$item->name}}
    </td>
    <td>
        {{$item->code}}
    </td>
    <td>
        {{\App\Discount::TYPES[$item->type]}}
    </td>
    <td>
        {{$item->discount}}
    </td>
    <td>
        {{$item->used_time}}
    </td>
    <td>
        {{$item->updated_at}}
    </td>
    <td>
        <div class="ui buttons">
            <a href="/discounts/{{$item->id}}/edit" class="ui icon green button"><i class="pencil icon"></i> Sửa</a>
            <a href="javascript:void(0);" onclick="ask_to_delete('Are you sure to delete this discount?',{{$item->id}})"
               class="ui icon yellow button"><i
                        class="delete icon"></i> Xóa</a>
        </div>
    </td>
</tr>