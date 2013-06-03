@layout('layouts.firstlogin')



@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_accounts.account')->get($lang) }} &nbsp; <small>{{ Lang::line('lbl_accounts.change_password')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
          @if(isset($error_data))
	         <div class="alert alert-error">{{ $error_data }}</div>
	      @endif
	 
    <form id="frm" name="frm" method="post" class="form-horizontal well">
    
     <div class="row">
       <div class="span15">
        <div class="row-fluid">
            
          <div class="span4">
             <div class="control-group">
		        <label class="control-label" for="txtLoginID">{{ Lang::line('lbl_accounts.username')->get($lang) }}&nbsp;&nbsp;</label>
		        
		            <div class="input-prepend">
		               <span class="add-on"><i class="icon-user"></i></span>
		               <input class="span12" id="username" type="text" value="{{ Auth::user()->username }}" disabled>
		            </div>
		         
		     </div>
             <div class="control-group"> 
                <label class="control-label" for="Password">{{ Lang::line('lbl_accounts.newpassword')->get($lang) }}&nbsp;&nbsp;</label>
                
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
                               
          </div>
     
        </div>       
            <br/>
            {{ Form::hidden('acctid', $acct->id); }}
			<div class="row-fluid">
				&nbsp;&nbsp;
				<button id="btn-cancel" class="btn" >{{ Lang::line('lbl_accounts.cancel')->get($lang) }}</button>
				<button id="btn-save" class="btn btn-primary" type="submit">{{ Lang::line('lbl_accounts.save')->get($lang) }}</button>
			</div>	
		
       </div>
     </div>
   </form>
    <form id="frm-cancel" name="frm-cancel" method="post"></form>
</div>

<script type="text/javascript">
$(document).ready(function(e) {

	 $('#frm').validate(
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

	
	 $('#btn-cancel').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
		 $('#frm-cancel').attr('action',"{{ URL::to('backoffice/app/logout') }}");
		 $('#frm-cancel').submit();
	 });
	 
	 $('#btn-save').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
         $('#frm').attr('action', "{{ URL::to('backoffice/account/change_password') }}");
         $('#frm').submit();
	 });
 
  
});
</script> 
    
    
 
@endsection

