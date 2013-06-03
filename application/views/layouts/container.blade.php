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
       
                <ul id="primary-nav" class="nav">
                    <li>
                     <span>
                        <a class="band" href="#"><h4><strong>GOBIOIDEI</strong></h4></a>
                     <span><small><font color="white">Research - Education - Conservation</font></small></span>
                  </span>
                    </li>
                    <li>
                       <span class="icon-bar"></span>  
                       <span class="icon-bar"></span>  
                       <span class="icon-bar"></span>
                    </li>
                </ul>
                <ul id="secondary-nav" class="nav pull-right">
                    <li><a data-toggle="modal" href="#myModal"><i class="icon-user icon-white"></i>&nbsp; <font color="white">{{ Auth::user()->username }} </font></a></li>
                    <li><a href="{{ URL::to('backoffice/app/logout') }}"><i class="icon-off icon-white"></i>&nbsp; <font color="white">{{ Lang::line('lbl_menu.logout')->get($lang) }}</font></a></li>
                </ul>
            </div>
        </div>
    </div>

    <!--Container-->
    
    <div class="container-fluid">
       
    <!--subnav-->
   <?php  $profile = Role::find(Auth::user()->roleid); ?>  

        <div class="subnav">
            <ul class="nav nav-pills">
               @section('navigation')
                
                 <?php  echo Navbar::create()
						           ->with_brand('CMS Backoffice', '#')
						           ->with_menus( Navigation::links(
						                        array(
						                             array(Lang::line('lbl_menu.home')->get($lang), URL::to('backoffice/app/home'), true),
						                           
												      array(Lang::line('lbl_menu.user_mgnt')->get($lang), '#', false, false,
												           array(
												               array(Navigation::HEADER, Lang::line('lbl_menu.administration')->get($lang)),
												               array(Navigation::DIVIDER),
												               array(Lang::line('lbl_menu.roles')->get($lang), URL::to('backoffice/account/list_roles')),
												               array(Lang::line('lbl_menu.accounts')->get($lang), URL::to('backoffice/account/list')),
												               )
												          ),
												          
												     array(Lang::line('lbl_menu.contributors')->get($lang), URL::to('backoffice/contributor/list')),
				
												          
												     array(Lang::line('lbl_menu.taxonomic')->get($lang), URL::to('backoffice/taxonomic/list')),
												    
												     array(Lang::line('lbl_menu.definitions')->get($lang), URL::to('backoffice/definition/list')),
												                 
						                            )
						                         )
						                   );
					?>
               @yield_section
                
            </ul>
        </div>

       
        
      
        <!--Dashboad-->
        <div id="columns" class="row-fluid">
           @yield('content')
           
               <!--Profile Form-->
		    <div class="modal hide fade" id="myModal">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal">×</button>
		            <h3>{{ Lang::line('lbl_accounts.change_password')->get($lang) }}</h3>
		        </div>
		        <div class="modal-body">
		            <form id="frm-changepass" name="frm-changepass" class="form-horizontal" method="post">
		            <div class="control-group">
		                <label class="control-label" for="txtLoginID">{{ Lang::line('lbl_accounts.username')->get($lang) }}&nbsp;&nbsp;</label>
		               
		                    <div class="input-prepend">
		                        <span class="add-on"><i class="icon-user"></i></span>
		                        <input class="span12" id="username" type="text" value="{{ Auth::user()->username }}" disabled>
		                    </div>
		            </div>
		            <div class="control-group">
		                <label class="control-label" for="txtPassword">{{ Lang::line('lbl_accounts.newpassword')->get($lang) }}&nbsp;&nbsp;</label>
		                    <div class="input-prepend">
		                        <span class="add-on"><i class="icon-lock"></i></span>
		                        <input class="span12" id="password" name="password" type="password">
		                    </div>
		            </div>
		           
		           <div class="control-group"> 
                      <label class="control-label" for="Password">{{ Lang::line('lbl_accounts.confirm_password')->get($lang) }}&nbsp;&nbsp;</label>
                      <div class="input-prepend">
                          <span class="add-on"><i class="icon-lock"></i></span>            
				          <input class="span12" id="confirm_password" name="confirm_password" type="password">        
                      </div>
                    </div> 
                    
		            <input type="hidden" id="acctid" name="acctid" value="{{ Auth::user()->id }}" />
		          </form>
		        </div>
		        <div class="modal-footer">
		            <a href="#" class="btn" data-dismiss="modal">{{ Lang::line('lbl_accounts.cancel')->get($lang) }}</a>
		            <a href="#" id="btn-save" class="btn btn-primary">{{ Lang::line('lbl_accounts.save')->get($lang) }}</a> 
		        </div>
			        <script type="text/javascript">
						$(document).ready(function(e) {
						
							 $('#frm-changepass').validate(
							  {
								rules: {
										 password: { required: true },
										 confirm_password: { required: true, equalTo: "#password"},
									   },
								highlight: function(element) 
								             {
											    $(element).closest('.control-group').removeClass('success').addClass('error');
											 },
								success: function(element) 
								            {
											  element.text('').addClass('valid')
													          .closest('.control-group').removeClass('error').addClass('success');
											}
							 });
						
							 
							 $('#btn-save').click(function(){
								 $(this).attr("disabled","disabled"); // prevent double submiting
						         $('#frm-changepass').attr('action', "{{ URL::to('backoffice/account/change_password') }}");
						         $('#frm-changepass').submit();
							 });		 
						  
						});
	          </script> 
		    </div>

        </div>
 
    </div>
</body>
</html>