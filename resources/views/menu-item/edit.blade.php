@extends('layouts.app')
@section('title') Menu Item Edit @endsection

@section('body')
    <form action="{{ route('menu-items.update',['menu_item'=>$menuItem->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="local_name">Name</label>
            <input type="text" class="form-control @error('local_name') is-invalid @enderror" placeholder="Name" id="local_name" value="{{ old('local_name',$menuItem->name) }}"
                   name="local_name">
            @error('local_name')
            <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-danger" href="{{ route('menu-items.index') }}">Back</a>
    </form>
@endsection
