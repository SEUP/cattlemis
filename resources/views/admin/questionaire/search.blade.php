@extends('admin.layout')

@section('page-wrapper')
@include('admin.questionaire.searchwidget',['showManage'=>true])
@endsection


@section('javascript')
    <script type="text/javascript" src="{{asset("/js/questionaire/search.js")}}"></script>
@endsection
