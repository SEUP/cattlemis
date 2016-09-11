@extends('public.layout')

@section('page-wrapper')
    @include('admin.questionaire.searchwidget',['showManage'=>false])

@endsection


@section('javascript')
    <script type="text/javascript" src="/js/questionaire/search.js"></script>
@endsection
