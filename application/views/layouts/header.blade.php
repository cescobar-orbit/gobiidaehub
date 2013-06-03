<?php 
 $lang = Session::get('lang', function() { return 'en';});
?>
<!DOCTYPE HTML>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
  
	 {{ Asset::container('bootstrapper')->styles() }}
	 {{ HTML::style('assets/app/css/style.css') }} 
	 
	 {{ HTML::style('assets/bootstrap/css/bootstrap-responsive.css') }}
	 {{ HTML::style('assets/bootstrap/css/bootstrap-responsive.min.css') }}
	 
     {{ Asset::container('bootstrapper')->scripts() }}  
          
     {{ HTML::style('assets/media/css/bootstrap.css') }}
 
</head>
<body>
    <!--Container-->
    <div class="container-fluid">
      
        <!--Dashboad-->
        <div id="columns" class="row-fluid">
           @yield('content')

        </div>
    </div>
</body>
</html>