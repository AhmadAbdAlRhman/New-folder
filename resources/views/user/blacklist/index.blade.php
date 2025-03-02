@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',[
    'title'=>__('BlackList'),
    'buttons'=>[
    [
        'name'=>'<i class="fa fa-plus"></i>&nbsp'.__('Add Number'),
        'url'=> roFute('user.blacklist.create'),
    ]
]])
@endsection  