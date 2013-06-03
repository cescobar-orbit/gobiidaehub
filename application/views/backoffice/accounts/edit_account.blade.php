@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_accounts.user_accounts')->get($lang) }} <small>{{ Lang::line('lbl_accounts.edit_account')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
         @if(isset($error_data))
	         <div class="alert alert-error">{{ $error_data }}</div>
	     @endif 
	      
	 {{ Form::open('/backoffice/account/list', 'post', array('id' => 'frm', 'class' => 'form-horizontal well')) }}   
	      
        <div class="row-fluid">
         <div class="span6">
            <div class="control-group"> 
                <label class="control-label" for="Role">{{ Lang::line('lbl_accounts.role')->get($lang) }}</label>
                 <div class="controls">
	             
				     <select id="roleid" name="roleid">
				     {{  $roles = Role::get(); }}
	                    @foreach ($roles as $r)
	                      @if($acct->roleid == $r->id)
	                          <option value="{{ $r->id }}" selected>{{ $r->rolename }}</option>
	                      @else
	                          <option value="{{ $r->id }}">{{ $r->rolename }}</option>
	                      @endif
	                    @endforeach
	                  </select>
				  
                 </div>
             </div>

            <div class="control-group"> 
              <label class="control-label" for="Username">{{ Lang::line('lbl_accounts.username')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('username', $acct->username, array('readonly'=>'true','class' => 'span8','rel'=>'popover')); }}        
                 
                 </div>
             </div> 
             
             <div class="control-group"> 
                <label class="control-label" for="Fullname">{{ Lang::line('lbl_accounts.fullname')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('accountname', $acct->accountname, array('class' => 'span8','rel'=>'popover')) }}        
                 </div>
             </div>
              
              <div class="control-group"> 
                 <label class="control-label" for="Email">{{ Lang::line('lbl_accounts.email')->get($lang) }}</label>
                 <div class="controls">              
				      {{ Form::text('email', $acct->emailaddress, array('class' => 'span8','rel'=>'popover')) }}        
                 </div>
             </div>   
         </div>
         <div class="span6">    
            <div class="control-group"> 
              <label class="control-label" for="Enabled">{{ Lang::line('lbl_accounts.enabled')->get($lang) }}</label>
                <div class="controls">
				    {{ Form::checkbox('enabled', '1', ($acct->active) ? true:false ) }}
                 </div>
             </div>
             
             <div class="control-group"> 
                <label class="control-label" for="IsContributor">Contributor</label>
                <div class="controls">
				    {{ Form::checkbox('iscontributor', 1, ($acct->iscontributor) ? true:false ) }}
                 </div>
             </div>     
             
             <div class="control-group"> 
                <label class="control-label" for="Reset">{{ Lang::line('lbl_accounts.resetpassword')->get($lang) }}</label>
                <div class="controls">
				    {{ Form::checkbox('resetpassword', 1, false) }}
                 </div>
             </div>     
           </div>     
        {{ Form::hidden('id', $acct->id); }}
        
     </div>
           <br/>
	 <div class="row-fluid">
		 <button id="btn-cancel" class="btn" >{{ Lang::line('lbl_accounts.cancel')->get($lang) }}</button>
		 <button id="btn-save" class="btn btn-primary">{{ Lang::line('lbl_accounts.save')->get($lang) }}</button>
	  </div>	
  {{ Form::close() }}
  
  <form id="frm-cancel" name="frm-cancel" method="post"></form>
</div>

<script type="text/javascript">
$(document).ready(function(e) {

	 $('#frm').validate(
	   {
		  rules: {
				   roleid: { required: true },
				   username: { minlength: 5, required: true },
			     },
			highlight: function(element) {
					       $(element).closest('.control-group').removeClass('success').addClass('error');
					 },
			success: function(element) {
					          element.text('').addClass('valid')
					                 .closest('.control-group').removeClass('error').addClass('success');
					       }
	 });
		
	 $('#btn-cancel').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
		 $('#frm-cancel').attr('action',"{{ URL::to('backoffice/account/list') }}");
		 $('#frm-cancel').submit();
	 });
	 
	 $('#btn-save').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
         $('#frm').attr('action', "{{ URL::to('backoffice/account/save') }}");
         $('#frm').submit();
	 });
 
});
</script> 
    
    
 
@endsection

