<?php 
 $lang = Session::get('lang', function() {return 'en';});

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | Gobiidae Backoffice</title>
     {{ HTML::style('assets/app/css/style.css');}}

     {{ Asset::container('bootstrapper')->styles() }}
     {{ Asset::container('bootstrapper')->scripts() }}
     
     {{ HTML::script('assets/media/js/jquery.js') }}
     {{ HTML::script('assets/bootstrap/js/bootstrap-carousel.js') }}
   
</head>
<body id="login-page">

    <div id="login" class="container">
       
     <div class="navbar navbar-fixed-top">  
      <div class="navbar-inner">  
        <div class="container">  
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">  
            <span class="icon-bar"></span>  
            <span class="icon-bar"></span>   
          </a>  
          <div class="nav-collapse">
           <ul class="nav">
              <li>  
                  <span>
                    <a href="#"><h3><strong>GOBIOIDEI</strong></h3></a>
                     <span>Research - Education - Conservation</span>
                  </span>
              </li>
              <li>
                  <span class="icon-bar"></span>  
                  <span class="icon-bar"></span>  
                  <span class="icon-bar"></span>
              </li>
              <li>
                 <br/>
                  <div class="row">
                    @if(isset($error_data))
	                  <div class="alert alert-error">{{ $error_data }}</div>
	                @endif
	                
                  {{ Form::open('login', 'post', array('class' => '')) }}
                    <div style="float:left; width:270px">
                       <div class="control-group">
                        <div class="input-prepend">
                          <span class="add-on"><i class="icon-user"></i></span>
                          {{ Form::text('username', null, array('rel'=>'popover','placeholder' => Lang::line('lbl_login.username')->get($lang) )) }} 
                        </div>
                       </div>
                     </div>
                     <div style="float:left; width:275px">
                       <div class="control-group">        
                          <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            {{ Form::password('password', array('class'=>'','placeholder'=> Lang::line('lbl_login.password')->get($lang) )) }}
                          </div>
                          <span><a href="{{ URL::to_action('backoffice/account/forgotpassowd') }}">Forgot your password ?</a></span>               
                       </div> 
                    </div> 
                    <div style="float:left; width:195px">
                      <div class="control-group">
                         <div class="controls">                     
                           <button class="btn btn-medium btn-primary">LOGIN</button>
                         </div>
                      </div>
                   </div>
		           {{ Form::token() }}
		        {{ Form::close() }}
        
                 </div>          
              </li>  
            </ul>  
          </div><!--/.nav-collapse -->  
          
        </div>  
      </div>  
    </div>  
  
  <br/>
      <!-- Example row of columns -->  
      <div class="row">  
        <div>  
          <p> </p>  
          <div id="myCarousel" class="carousel slide">  
            <!-- Carousel items -->  
            <div align="center" class="carousel-inner">  
              <div class="active item"><img src="<?php echo URL::to_asset('img/logos/2.jpg') ?>" height="480px" /></div>  
              <div class="item"><img src="<?php echo URL::to_asset('img/logos/3.jpg') ?>"  height="480px" /></div>  
              <div class="item"><img src="<?php echo URL::to_asset('img/logos/barkera__mg_0619.jpg') ?>" height="480px"  /></div> 
              <div class="item"><img src="<?php echo URL::to_asset('img/logos/Elacatinus pallens DSC_4497 VT-05-377.jpg')  ?>"  height="480px" /></div> 
              <div class="item"><img src="<?php echo URL::to_asset('img/logos/2.jpg') ?>" height="480px" /></div>   
           </div>  
           <!-- Carousel nav -->  
           <a class="carousel-control left" href="#myCarousel" data-slide="prev">‹</a>  
           <a class="carousel-control right" href="#myCarousel" data-slide="next">›</a>  
         </div>  
       </div>  
    </div>  
  
      <hr>  
 
       <footer style="position: relative;
                      margin-top: -15px; /* negative value of footer height */
                      height: 90px;
                      clear:both;
                      padding-top:20px;
                      color:#fff;">  
        <font color="white">Gobioide is a project of the Fish Systematic & Conservation Lab, Texas A&M University - Corpus Christi, in conjunction with the Dept. of Ichthyology, American Museum of Natural History.</font>  
      </footer>  
  
    
    <!-- /container -->  
    </div>
  <script type="text/javascript">
   $(document).ready(function(e) {  
    $('#myCarousel').carousel();

   });
 </script>  
</body>
</html>
