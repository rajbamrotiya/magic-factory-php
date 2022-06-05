<li>{{ $menuItem['name'] }} -
    <a  href="{{ route('menu-items.edit',['menu_item'=>$menuItem['id']]) }}"><span class="fa fa-edit"></span> Edit</a></li>
@if (count($menuItem['children']) > 0)
    <ul>
        @foreach($menuItem['children'] as $menuItem)
            @include('menu-item.partials.menu-item-tree', $menuItem)
        @endforeach
    </ul>
@endif
