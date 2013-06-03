@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_variables.variablenamecv')->get($lang) }} <small>{{ Lang::line('lbl_variables.create_term')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
        @if(isset($error_data))
	         <div class="alert alert-error">
	          {{ $error_data }}
	        </div>
	      @endif
        <div class="row-fluid">
         {{ Form::open('/backoffice/variable/list_variablenames', 'POST', array('id' => 'frm', 'class' => 'form-horizontal well')); }}           
 
             <div class="control-group"> 
              <label class="control-label" for="Term">{{ Lang::line('lbl_variables.term')->get($lang) }}</label>
                <div class="controls">
              
				      {{ Form::text('term', null, array('class' => 'span3','rel'=>'popover')) }}
        
                 </div>
             </div> 
             
             <div class="control-group"> 
              <label class="control-label" for="Definition">{{ Lang::line('lbl_variables.definition')->get($lang) }}</label>
                <div class="controls">
              
				      {{ Form::text('definition', null, array('class' => 'span3','rel'=>'popover')) }}
        
                 </div>
             </div> 
             
             {{ Form::hidden('id', '0'); }}
           
			<div class="row-fluid">
				<button id="btn-cancel" class="btn" >{{ Lang::line('lbl_variables.cancel')->get($lang) }}</button>
				<button id="btn-save" class="btn btn-primary">{{ Lang::line('lbl_variables.save')->get($lang) }}</button>
			</div>	
			
	<?php echo Form::close(); ?>
	<form id="frm-cancel" name="frm-cancel"></form>
  </div>

</div>

<script type="text/javascript">
$(document).ready(function(e) {

	$('#frm').validate(
		{
		  rules: {
				   term: { required:true, minlength: 4 },
				   definition: { required: true },									   				   
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
		 $('#frm-cancel').attr('action',"{{ URL::to('backoffice/variable/list_variablenames') }}");
		 $('#frm-cancel').submit();
	 });
	 
	 $('#btn-save').click(function(){

       $('#frm').attr('action', "{{ URL::to('backoffice/variable/save_variablename') }}");
       $('#frm').submit();
	 });
 
});
</script> 
    
    
 
@endsection

