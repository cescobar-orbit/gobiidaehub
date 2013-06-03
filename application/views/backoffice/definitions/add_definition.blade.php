@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_definitions.definitions')->get($lang) }} &nbsp; <small>{{ Lang::line('lbl_definitions.create_definition')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
          @if(isset($error_data))
	         <div class="alert alert-error">{{ $error_data }}</div>
	      @endif 
	      
        <div class="row-fluid">
          {{ Form::open_for_files('/backoffice/definition/list', 'post', array('id' => 'frm', 'class' => 'form-horizontal well')) }}           

            <div class="control-group">
              <label class="control-label" for="Category">{{ Lang::line('lbl_definitions.category')->get($lang) }}</label>
              <div class="controls">
                  <select id="category" name="category">
                     {{ $categories = Category::order_by('categoryname','asc')->get() }}
                     
                     <option value="">{{ Lang::line('lbl_menu.select')->get($lang) }}</option>
  
                     @foreach($categories as $category)
                       @if($category->id == $definition->categoryid)
                          <option value="{{$category->id}}" selected>{{ $category->categoryname }}</option>
                       @else
                          <option value="{{$category->id}}">{{ $category->categoryname }}</option>
                       @endif
                     @endforeach
                  </select>
              </div>
            </div>
            <div class="control-group"> 
              <label class="control-label" for="Term">{{ Lang::line('lbl_definitions.term')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('term', $definition->term, array('class' => 'span3','rel'=>'popover')); }}        
                 
                 </div>
             </div> 
             
            
            <div class="control-group"> 
              <label class="control-label" for="Definition">{{ Lang::line('lbl_definitions.definition')->get($lang) }}</label>
                <div class="controls">         
				      {{ Form::textarea('definition', $definition->definition, array('class' => 'span5','rel'=>'popover')); }}        
                 </div>
             </div>                  
                
              {{ Form::hidden('id', '0'); }}
              {{ Form::hidden('lang', $lang); }}
               <br/>
			 <div class="row-fluid">
			     <span class="btn btn-file">
		                   <span class="fileupload-new">Select Photo</span>
		                  {{ Form::file('image', array('id'=> 'photos')) }}
		        </span>
				<button id="btn-cancel" class="btn" >{{ Lang::line('lbl_definitions.cancel')->get($lang) }}</button>
				<button id="btn-save" class="btn btn-primary">{{ Lang::line('lbl_definitions.save')->get($lang) }}</button>
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
			     category: { required:true },
				 term: { required: true, minlength: 6 },
				 definition: { required: true, minlength:10 },									   				   
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
		 $('#frm-cancel').attr('action',"{{ URL::to('backoffice/definition/list') }}");
		 $('#frm-cancel').submit();
	 });
	 
	 $('#btn-save').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
         $('#frm').attr('action', "{{ URL::to('backoffice/definition/save') }}");
         $('#frm').submit();
	 });
 
});
</script> 
    
    
 
@endsection

