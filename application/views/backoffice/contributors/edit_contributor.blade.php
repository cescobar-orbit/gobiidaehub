@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_menu.contributors')->get($lang) }} <small>{{ Lang::line('lbl_contributors.edit_contributor')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
          @if(isset($error_data))
	         <div class="alert alert-error">{{ $error_data }}</div>
	      @endif
	      
        <div class="row-fluid">
         {{ Form::open_for_files('/backoffice/contributor/list', 'post', array('id' => 'frm', 'class' => 'form-horizontal well')) }}        
            <table border="0" width="100%">
               <tr>
                 <td>
                   <div class="control-group"> 
                      <label class="control-label" for="ContributorName">{{ Lang::line('lbl_contributors.contributor')->get($lang) }}</label>
                      <div class="controls">              
				      {{ Form::text('contributorname', $contributor->contributorname, array('readonly'=>'true', 'class' => 'span10','rel'=>'popover')) }}        
                      </div>
                   </div>
                    <div class="control-group"> 
                      <label class="control-label" for="Email">{{ Lang::line('lbl_contributors.email')->get($lang) }}</label>
                      <div class="controls"> 
                         <div class="input-prepend"> 
                           <span class="add-on">@</span>            
				           {{ Form::text('email', $contributor->emailaddress, array('class' => 'span12','rel'=>'popover')) }}        
                         </div>
                      </div>
                   </div> 
                    <div class="control-group"> 
                      <label class="control-label" for="Phonenumber">{{ Lang::line('lbl_contributors.phoneno')->get($lang) }}</label>
                      <div class="controls">              
				        {{ Form::telephone('phonenumber', $contributor->phoneno, array('class' => 'span10','rel'=>'popover')) }}        
                      </div>
                    </div> 

                    <div class="control-group"> 
                      <label class="control-label" for="Address">{{ Lang::line('lbl_contributors.address')->get($lang) }}</label>
                      <div class="controls">              
				        {{ Form::text('address', $contributor->address, array('class' => 'span10','rel'=>'popover')) }}        
                      </div>
                    </div> 
                 </td>
                 <td colspan="100%" align="center">
                   
                      <table border="0">
                        <tr>
                          <td valign="top">{{ Form::radio('contributortype','A',($contributor->contributortype == 'A') ? 'true':'',array('id'=>'author')) }}</td>
                          <td>{{ Form::label('contributor','Author') }}</td>
                          <td>&nbsp;&nbsp;</td>
                          <td valign="top">{{ Form::radio('contributortype','S', ($contributor->contributortype == 'S') ? 'true':'',array('id'=>'sponsor')) }}</td>
                          <td>{{ Form::label('sponsor','Sponsor') }}</td>                          
                        </tr>
                     </table>
     
                   
                   <div class="control-group"> 
                       <label class="control-label" for="Biography">{{ Lang::line('lbl_contributors.biography')->get($lang) }}</label>
                       <div class="controls">              
				        {{ Form::textarea('detail', $contributor->detail, array('class' => 'span10','rel'=>'popover')) }}        
                       </div>
                    </div>
                 </td>
                </tr>
            </table>
             
             {{ Form::hidden('id', $contributor->id) }}
             <br/>
			<div class="row-fluid">
			   <div class="fileupload fileupload-new row-fluid" data-provides="fileupload">
			     <span class="btn btn-file">
		                   <span class="fileupload-new">Select Photo</span>
		                   {{ Form::file('image',array('id'=> 'image'))}}
		        </span>
		         <button id="btn-cancel" class="btn" >{{ Lang::line('lbl_contributors.cancel')->get($lang) }}</button>
				 <button id="btn-save" class="btn btn-primary">{{ Lang::line('lbl_contributors.save')->get($lang) }}</button>
		        </div>
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
				contributorname: { minlength: 3, required: true },
				email: { required: true, email:true },								   				   
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
		 $('#frm-cancel').attr('action',"{{ URL::to('backoffice/contributor/list') }}");
		 $('#frm-cancel').submit();
	 });
	 
	 $('#btn-save').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
         $('#frm').attr('action', "{{ URL::to('backoffice/contributor/save') }}");
         $('#frm').submit();
	 });
 
});
</script> 
    
 
@endsection

