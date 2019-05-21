@extends('UserCheckList.layouts.layout')

@extends('layouts.app')

@section('navbar') 

@endsection

@section('header') 
	@parent
@endsection


@section('content') 
	@include('UserCheckList.tableCSS') 
	@include('UserCheckList.content.checkListContent') 
@endsection
