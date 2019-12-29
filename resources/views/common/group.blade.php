<style type="text/css">
    .rotate {
        display: block;
        clear:both;
        transform: rotate(-90deg);
        /* Legacy vendor prefixes that you probably don't need... */
        /* Safari */
        -webkit-transform: rotate(-90deg);
        /* Firefox */
        -moz-transform: rotate(-90deg);
        /* IE */
        -ms-transform: rotate(-90deg);
        /* Opera */
        -o-transform: rotate(-90deg);
        /* Internet Explorer */
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    }
</style>
<table class="nes-table is-bordered is-centered">
        <thead>
        <tr stle="height:">
        <th>&nbsp;</th>
        @foreach ($toppings as $toppingProper)
            <th><span class="rotate">{{$toppingProper}}</span></th>
        @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach ($groupOrgUserList as $userName => $groupOrgUser)
            <tr>
                <td>{{$userName}}</td>
                @foreach ($groupOrgUser as $topping => $preference)
                    <td>
                        @if( $preference == 1)
                            <i class="nes-icon is-medium star"></i>
                        @elseif( $preference == 0)
                            <i class="nes-icon is-medium star is-half"></i>
                        @elseif( $preference == -1)
                            <i class="nes-icon is-medium star is-empty"></i>
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
