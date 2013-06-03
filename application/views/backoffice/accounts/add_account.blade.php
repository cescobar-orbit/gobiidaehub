@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_accounts.user_accounts')->get($lang) }} <small>{{ Lang::line('lbl_accounts.create_account')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
          @if(isset($error_data))
	         <div class="alert alert-error">{{ $error_data }}</div>
	      @endif
	      
        <div class="row-fluid">
         {{ Form::open('/backoffice/account/list', 'post', array('id' => 'frm', 'class' => 'form-horizontal well')) }}   
             <div class="control-group"> 
                <label class="control-label" for="Role">{{ Lang::line('lbl_accounts.role')->get($lang) }}</label>
                 <div class="controls">
	             
				     <select id="roleid" name="roleid">
				       <option value="">{{ Lang::line('lbl_menu.select')->get($lang) }}</option>
				      <?php  $roles = Role::all(); ?>
	                    @foreach ($roles as $r)
	                     <option value="{{ $r->id }}">{{ $r->rolename }}</option>
	                    @endforeach
	                  </select>
				  
                 </div>
             </div>            


             <div class="control-group"> 
              <label class="control-label" for="Username">{{ Lang::line('lbl_accounts.username')->get($lang) }}</label>
                <div class="controls">
              
				      {{ Form::text('username', $acct->username, array('class' => 'span3','rel'=>'popover')) }}
        
                 </div>
             </div> 
             
             <div class="control-group"> 
                <label class="control-label" for="Fullname">{{ Lang::line('lbl_accounts.fullname')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('accountname', $acct->accountname, array('class' => 'span3','rel'=>'popover')) }}        
                 </div>
             </div>
              
              <div class="control-group"> 
                 <label class="control-label" for="Email">{{ Lang::line('lbl_accounts.email')->get($lang) }}</label>
                 <div class="controls">              
				      {{ Form::text('email', $acct->emailaddress, array('class' => 'span3','rel'=>'popover')) }}        
                 </div>
             </div> 
             
             <div class="control-group"> 
              <label class="control-label" for="Enabled">{{ Lang::line('lbl_accounts.enabled')->get($lang) }}</label>
                <div class="controls">
                     {{ Form::checkbox('enabled', '1', true) }}
                 </div>
             </div> 
            
            <div class="control-group"> 
                <label class="control-label" for="IsContributor">Contributor</label>
                <div class="controls">
				    {{ Form::checkbox('iscontributor', 1, false) }}
                 </div>
             </div>   
             
             
             {{ Form::hidden('id', '0'); }}
             <br/>
			<div class="row-fluid">
				<button id="btn-cancel" class="btn" >{{ Lang::line('lbl_accounts.cancel')->get($lang) }}</button>
				<button type="submit" id="btn-save" class="btn btn-primary">{{ Lang::line('lbl_accounts.save')->get($lang) }}</button>
			</div>
			
	  {{ Form::close() }}
	  
	  <form id="frm-cancel" name="frm-cancel" method="post"></form>
  </div>

</div>

<script type="text/javascript">
$(document).ready(function(e) {

	 $('#frm').validate(
	  {
	   rules: {
			   roleid: { required: true },
			   username: { minlength: 5, required: true},
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

