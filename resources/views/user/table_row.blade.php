<tr>
    <td><h5>{{$item->name}}</h5></td>

    <td><h5>{{$item->email}}</h5></td>
    <td><h5>{{$item->phone}}</h5></td>
    <td><h5>{{$item->address}}</h5></td>
    <td><h5>
            @if($item->is_admin)
                <a href="/manage/users/{{$item->id}}/unmake_admin"
                   class="ui yellow labeled icon  button"><i
                            class="arrow down icon"></i> bỏ admin</a>
            @else
                <a href="/manage/users/{{$item->id}}/make_admin"
                   class="ui green labeled icon button"><i
                            class="arrow up icon"></i> thành admin</a>
            @endif
        </h5></td>
    <td><h5>
            <a onclick="ask_to_delete('Xóa người dùng này?','/manage/users/{{$item->id}}/delete')"
               href="javascript:void(0);"
               class="ui red labeled icon button"><i
                        class="delete icon"></i> xóa</a>
        </h5></td>
</tr>
