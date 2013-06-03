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
	 {{ HTML::style('assets/jquery/css/jquery-ui-1.8.16.custom.css') }}
	 
	 {{ HTML::style('assets/bootstrap/css/bootstrap-responsive.css') }}
	 {{ HTML::style('assets/bootstrap/css/bootstrap-responsive.min.css') }}
	 {{ HTML::style('assets/bootstrap/css/bootstrap-datatables.css') }}
	 {{ HTML::style('assets/bootstrap/css/bootstrap-datetimepicker.min.css') }}
	 
     {{ Asset::container('bootstrapper')->scripts() }}  
          
      {{ HTML::style('assets/media/css/demo_page.css') }}
      {{ HTML::style('assets/media/css/bootstrap.css') }}
      {{ HTML::style('assets/media/css/dataTables.bootstrap.css') }}
  
    
     {{ HTML::script('assets/jquery/js/jquery.easing.min.js') }}
     {{ HTML::script('assets/jquery/js/jquery-ui-1.8.16.custom.min.js') }}
     {{ HTML::script('assets/jquery/js/jquery-1.7.2.min.js') }}  
    
     {{ HTML::script('assets/media/js/jquery.js') }}
     {{ HTML::script('assets/media/js/jquery.dataTables.js') }}       
  	 {{ HTML::script('assets/media/js/dataTables.bootstrap.js') }}
      
     {{ HTML::script('assets/bootstrap/js/bootstrap-transition.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-alert.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-modal.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-dropdown.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-scrollspy.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-tab.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-tooltip.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-popover.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-button.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-collapse.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-carousel.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-typeahead.js') }}
     
     {{ HTML::script('assets/bootstrap/js/bootstrap-datetimepicker.min.js') }}   
      
     {{ HTML::script('assets/app/js/script.js') }} 
     {{ HTML::script('assets/bootstrap/js/jquery.validate.min.js') }}
     
     @if($lang == "en")
        {{ HTML::script('assets/bootstrap/js/jquery.validate.messages.en.js') }} 
     @else
       {{ HTML::script('assets/bootstrap/js/jquery.validate.messages.es.js') }} 
     @endif  
</head>
<body>
    <!--Navigation-->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="brand" href="index.html">
                      <img src="<?php echo URL::to_asset('img/stri_logos/340000f3xcro0.gif')?>"  alt="logo" />
                 </a>
                <ul id="primary-nav" class="nav">
                    <li><i>&nbsp;</i><span>&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
                </ul>
                <ul id="secondary-nav" class="nav pull-right">
                    <li><a data-toggle="modal" href="#myModal"><i class="icon-user icon-white"></i>&nbsp; <font color="white"> {{ Auth::user()->username }} </font></a></li>
                    <li><a href="{{ URL::to('backoffice/app/logout') }}"><i class="icon-off icon-white"></i>&nbsp; <font color="white">{{ Lang::line('lbl_menu.logout')->get($lang) }} </font></a></li>
                </ul>
            </div>
        </div>
    </div>

    <!--Container-->
    <div class="container-fluid">
      
        <!--Dashboad-->
        <div id="columns" class="row-fluid">
           @yield('content')

        </div>
    </div>
</body>
</html>