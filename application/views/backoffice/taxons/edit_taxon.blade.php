@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_taxons.taxons')->get($lang) }} &nbsp; <small>{{ Lang::line('lbl_taxons.edit_taxon')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
         @if(isset($error_data))
	         <div class="alert alert-error">{{ $error_data }}</div>
	      @endif
	      
      {{ Form::open('/backoffice/taxonomic/list', 'post', array('id' => 'frm', 'class' => 'form-horizontal well')) }}
    
     <div class="row">
       <div class="span15">
        <div class="row-fluid">
            
             <div class="control-group"> 
                <label class="control-label" for="TaxonParent">{{ Lang::line('lbl_taxons.taxonparent')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="taxonparentid" name="taxonparentid">
			        <?php  $parents = Taxon::where('TaxonType','<>', 'S')->order_by("TaxonName","asc")->get(); ?>
			        <option value="">{{ Lang::line('lbl_menu.select')->get($lang) }}</option>
			        <option value="-999">None Taxon</option>
                    @foreach ($parents as $parent)
                       @if($taxon->parentid ==  $parent->id)
                           <option value="{{ $parent->id }}"  selected>{{ $parent->taxonname }}</option> 
                       @else
                          <option value="{{ $parent->id }}">{{ $parent->taxonname }}</option>
                       @endif       
                    @endforeach
                  </select>				  
                </div>
             </div>
             
            <div class="control-group"> 
                <label class="control-label" for="TaxonType">{{ Lang::line('lbl_taxons.taxontype')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="taxontype" name="taxontype">
			         <option value="F" {{ ($taxon->taxontype == "F")?"selected":""}} >{{ Lang::line('lbl_taxons.family')->get($lang) }}</option>
			         <option value="SF" {{ ($taxon->taxontype == "SF")?"selected":""}}>{{ Lang::line('lbl_taxons.subfamily')->get($lang) }}</option>
			         <option value="G" {{ ($taxon->taxontype == "G")?"selected":""}}>{{ Lang::line('lbl_taxons.genus')->get($lang) }}</option>
                  </select>
                 </div>
             </div>
             
             <div class="control-group"> 
                <label class="control-label" for="Taxonname">{{ Lang::line('lbl_taxons.specificname')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('taxonname', $taxon->taxonname, array('class' => 'span8','rel'=>'popover')); }}        
                 </div>
             </div> 
             
             <div class="control-group"> 
                <label class="control-label" for="Authorname">{{ Lang::line('lbl_taxons.author')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('authorname', $taxon->authorname, array('class' => 'span8','rel'=>'popover')); }}        
                 </div>
             </div>               
              
             <div class="control-group"> 
               <label class="control-label" for="Startdate">{{ Lang::line('lbl_taxons.date')->get($lang) }}</label>
                <div class="controls">         
				  <div id="datetimepicker1" class="input-append"> 
				    <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"> </i> </span>
				    <input type="text" id="update" name="update" data-format="yyyy-MM-dd" value="{{ $taxon->updated }}"></input>  
				  </div>                 
			   </div>
             </div>  
             
             <div class="control-group"> 
                <label class="control-label" for="Description">{{ Lang::line('lbl_taxons.description')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::textarea('description', $taxon->description, array('class' => 'span8','rel'=>'popover')); }}        
                 </div>
             </div> 
           
             
        </div>       
            <br/>
            {{ Form::hidden('id', $taxon->id); }}
			<div class="row-fluid">
				<button id="btn-cancel" class="btn" >{{ Lang::line('lbl_taxons.cancel')->get($lang) }}</button>
				<button id="btn-save" class="btn btn-primary" type="submit">{{ Lang::line('lbl_taxons.save')->get($lang) }}</button>
			</div>	
		
       </div>
     </div>
   {{ Form::close() }}
   
    <form id="frm-cancel" name="frm-cancel" method="post"></form>
</div>

<script type="text/javascript">
$(document).ready(function(e) {

	 $('#frm').validate(
	  {
		rules: {
				 taxonname: { required: true },
				 parentid: { required: true },

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
		 $('#frm-cancel').attr('action',"{{ URL::to('backoffice/taxonomic/list') }}");
		 $('#frm-cancel').submit();
	 });
	 
	 $('#btn-save').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
         $('#frm').attr('action', "{{ URL::to('backoffice/taxonomic/save') }}");
         $('#frm').submit();
	 });

	 try{
		 $('#datetimepicker1').datetimepicker({ language: 'en', pick12HourFormat: true });
	    }
	 catch(e){ }   
});
</script> 
    
    
 
@endsection

