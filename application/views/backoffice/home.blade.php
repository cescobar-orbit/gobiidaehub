@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php 
  $lang = Session::get('lang', function() {return 'en';});

?>
  <br/>
  <div class="well">
   <h1>{{ Lang::line('lbl_menu.welcome')->get($lang) }} !</h1>
    <p>{{ Auth::user()->accountname }}, {{ Lang::line('lbl_menu.welcometo')->get($lang) }} Gobiidae Content Management System</p>
  <br/>
  <blockquote>
     <small>
      Gobiidae Content Management System is a tool which will help you to handle all information needed to pusblish researching results.
      Through this tool you are able to create accounts, contributors of material, upload images of species ones  and more in a simply way, by clicking on each one of the buttons shown above.
      </small>
  </blockquote>
  <br/><br/><br/>    
 </div>      
@endsection

