@extends('layouts.app')
@section('title') Menu Item List @endsection

@section('body')
    <ul>
        @each('menu-item.partials.menu-item-tree', $menuItems, 'menuItem')
    </ul>
@endsection
