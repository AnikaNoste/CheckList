@extends('AdminCheckList.layouts.layout')

@section('navbar') 

@endsection

@section('header') 
	@parent
@endsection


@section('content') 
	@include('AdminCheckList.tableCSS') 
	@include('AdminCheckList.content.listsContent')
@endsection
