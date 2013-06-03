@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_sites.site_images')->get($lang) }} &nbsp; <small>{{ Lang::line('lbl_sites.add_image')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
          @if(isset($error_data))
	         <div class="alert alert-error">
	          {{ $error_data }}
	        </div>
	      @endif
        <form id="frm" name="frm" method="post" class="form-horizontal well">
	        <div class="fileupload fileupload-new row-fluid" data-provides="fileupload">
	             <table width="100%" border="0">
	                <tr>
	                   <td valign="top" width="25%"><div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div></td>
	                   <td valign="top">             
	                       <div class="control-group"> 
	                        <label class="control-label" for="Email"> {{ Lang::line('lbl_sites.display')->get($lang) }}</label>
		                     <div class="controls">                    
						      {{ Form::checkbox('display', '1', true) }}
		                     </div>
		                   </div>

			              <div class="control-group"> 
			                <label class="control-label" for="Authorname">{{ Lang::line('lbl_menu.author')->get($lang) }}</label>
	  	                    &nbsp;<div class="input-prepend">
			                     <span class="add-on"><i class="icon-user"></i></span>             
							      {{ Form::text('authorname', null, array('class' => 'span10','rel'=>'popover')); }}        
			                 </div>
			               </div>
			               <div class="control-group"> 
			                 <label class="control-label" for="Email">{{ Lang::line('lbl_contacts.email')->get($lang) }}</label>
			                 &nbsp;<div class="input-prepend">
			                     <span class="add-on">@</span>             
							      {{ Form::text('email', null, array('class' => 'span10','rel'=>'popover')); }}        
			                 </div>
			             </div> 
	                  </td>
	                  <td valign="top" width="40%">
	                      <div class="control-group"> 
		                  <label class="control-label" for="Description">{{ Lang::line('lbl_menu.description')->get($lang) }}</label>
		                  <div class="controls">              
						      {{ Form::textarea('description', null, array('class' => 'span10','rel'=>'popover')); }}        
		                  </div>
		             </div>  
	                  </td>
	               </tr>
	             </table>            
		             <div class="row-fluid">
		                <span class="btn btn-file">
		                   <span class="fileupload-new">Select image</span>
		                   <input type="file" />
		                </span>
		                 <button id="btn-upload" class="btn btn-primary" >{{ Lang::line('lbl_sites.upload_image')->get($lang) }}</button>
		               <button id="btn-cancel" class="btn" >{{ Lang::line('lbl_sites.cancel')->get($lang) }}</button>
		            </div>
	         </div>
        </form>
   <form id="frm-cancel"></form>
</div>

<script type="text/javascript">
$(document).ready(function(e) {

	 $('#frm').validate(
		{
				rules: {
						 sitename: { required: true },
						 sitecode: { required: true },
						 locationcode: { required: true },
		                 organizationid: { required: true },
		                 owner: { required: true },
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
		 $('#frm-cancel').attr('action',"{{ URL::to('backoffice/site/list') }}");
		 $('#frm-cancel').submit();
	 });
	 
	 $('#btn-upload').click(function(){

       $('#frm').attr('action', "{{ URL::to('backoffice/site/save') }}");
       $('#frm').submit();
	 });

 
});
</script> 
    
    
 
@endsection

