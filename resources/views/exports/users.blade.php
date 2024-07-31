<table cellspacing="0" cellpadding="0" border="1">
    <tbody>
        <tr>
            @foreach ($columns as $column)
                <td style="background: #000000; color: #FFFFFF; text-align: center;">{{$column['label']}}</td>
            @endforeach
        </tr>
        @foreach($users as $user)
            <tr>
                @foreach ($filters as $filter)
                    <td>
                        @if($filter === 'vaccines')
                            @if(!is_null($user[$filter]))
                                {{implode(', ', $user[$filter])}}
                            @else
                                -
                            @endif
                        @else
                            {{$user[$filter]}}
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
