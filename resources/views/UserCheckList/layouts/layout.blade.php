<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>{{ $title }}</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>
	
	@section('navbar')
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
	  
      </div>
    </nav>
	@show
	
	@section('header')
    <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="container">
        <h2><center>{{ $title }}</center></h2>
      </div>
	@show
	
	
   	<div class="container">
      <!-- Example row of columns -->
      <div class="row">
		@yield('content')
      </div>
      <hr>
      <footer>
        <p>2019г. преддипломная практика Чаадаевой С.А. </p>
      </footer>
    </div>
  </body>
</html>