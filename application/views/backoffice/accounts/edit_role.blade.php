@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_accounts.roles')->get($lang) }} &nbsp;<small>{{ Lang::line('lbl_accounts.edit_role')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
        @if(isset($error_data))
	         <div class="alert alert-error">{{ $error_data }}</div>
	      @endif  
	       
        <div class="row-fluid">
          {{ Form::open('/backoffice/account/list_roles', 'post', array('id' => 'frm', 'class' => 'form-horizontal well')) }}        

             <div class="control-group"> 
                <label class="control-label" for="Role">{{ Lang::line('lbl_accounts.role')->get($lang) }}</label>
                <div class="controls">
                    {{ Form::text('rolename', $role->rolename, array('class' => 'span6','rel'=>'popover')) }}        
                 </div>
             </div> 
             <div class="control-group"> 
                <label class="control-label" for="Role">Complete Access</label>
                <div class="controls">              
				    {{ Form::checkbox('fullaccess', '1', ($role->fullaccess) ? true:false ) }}
                  </div>
             </div>
             <div class="control-group"> 
                <label class="control-label" for="Role">Access Control</label>
                <div class="controls">              
				    {{ Form::checkbox('accesscontrol', '1', ($role->accesscontrol) ? true:false ) }}
                  </div>
             </div>
            <div class="control-group"> 
                <label class="control-label" for="Role">Content Editor</label>
                <div class="controls">              
				    {{ Form::checkbox('contenteditable', '1', ($role->contenteditable) ? true:false ) }}
                  </div>
             </div> 
              
             {{ Form::hidden('id', $role->id) }}
             <br/><br/>
			<div class="row-fluid">
				<button id="btn-cancel" class="btn" >{{ Lang::line('lbl_accounts.cancel')->get($lang) }}</button>
				<button id="btn-save" class="btn btn-primary">{{ Lang::line('lbl_accounts.save')->get($lang) }}</button>
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
				   rolename: { minlength: 5, required: true },

				 },
		  highlight: function(element) {
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
		 $('#frm-cancel').attr('action',"{{ URL::to('backoffice/account/list_roles') }}");
		 $('#frm-cancel').submit();
	 });
	 
	 $('#btn-save').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
         $('#frm').attr('action', "{{ URL::to('backoffice/account/save_role') }}");
         $('#frm').submit();
	 });
 
});
</script> 
    
    
 
@endsection

