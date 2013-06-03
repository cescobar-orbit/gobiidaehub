@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Taxon::find($genusid)->taxonname }} &nbsp; <small>{{ Lang::line('lbl_taxons.edit_specie')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
         @if(isset($error_data))
	         <div class="alert alert-error">{{ $error_data }}</div>
	      @endif
	      
      {{ Form::open('', 'post', array('id' => 'frm', 'class' => 'form-horizontal')) }}

        <div class="tabbable"> <!-- Only required for left/right tabs -->
           <ul class="nav nav-tabs">
             <li class="active"><a href="#tab1" data-toggle="tab">Section 1</a></li>
             <li><a href="#tab2" data-toggle="tab">Section 2</a></li>
             <li><a href="#tab3" data-toggle="tab">Section 3</a></li>
           </ul>
          <div class="tab-content">
             <div class="tab-pane active" id="tab1">
                 <div class="well row-fluid" style="width:90%">
		           <div class="span5"> 
		            		             
		             <div class="control-group"> 
		                <label class="control-label" for="Genus">{{ Lang::line('lbl_taxons.genus')->get($lang) }}</label>
		                <div class="controls">              
						    <select id="genusid" name="genusid">
						        {{ $parents = Taxon::where('TaxonType','=', 'G')->order_by("TaxonName","asc")->get() }}
						        <option value="">{{ Lang::line('lbl_menu.select')->get($lang) }}</option>
						        <option value="-999">None Taxon</option>
			                    @foreach ($parents as $parent)
			                      @if($specie->parentid == $parent->id)
			                         <option value="{{ $parent->id }}" selected>{{ $parent->taxonname }}</option>
			                      @else
			                         <option value="{{ $parent->id }}">{{ $parent->taxonname }}</option>
			                      @endif     
			                    @endforeach
			                  </select>      
		                 </div>
		             </div> 
		                          
		             <div class="control-group"> 
		                <label class="control-label" for="Taxonname">{{ Lang::line('lbl_taxons.speciename')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('taxonname', $specie->taxonname, array('readonly'=>'true','class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div> 
		             
		             <div class="control-group"> 
		                <label class="control-label" for="Common Name">{{ Lang::line('lbl_taxons.commonname')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('commonname', $specie->commonname, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div> 
              
		           </div>
		           <div class="span5">   
		           		             
		             <div class="control-group"> 
		                <label class="control-label" for="Authorname">{{ Lang::line('lbl_taxons.author')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('authorname', $specie->authorname, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div> 
		             
		             <div class="control-group"> 
		               <label class="control-label" for="Startdate">{{ Lang::line('lbl_taxons.date')->get($lang) }}</label>
		                <div class="controls">         
						  <div id="datetimepicker1" class="input-append"> 
						    <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"> </i> </span>
						    <input type="text" id="updated" name="updated" data-format="yyyy-MM-dd" value="{{ $specie->updated }}"></input>  
						  </div>                 
					   </div>
		             </div> 
		             
		             <div class="control-group"> 
		                <label class="control-label" for="Description">{{ Lang::line('lbl_taxons.description')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('description', $specie->description, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div>  
		          </div>
		           
		        </div> 
             </div>
             <div class="tab-pane" id="tab2">
               	<div class="well row-fluid" style="width:90%"> 
               	 <div class="span5">
		             <div class="control-group"> 
		                <label class="control-label" for="Size">{{ Lang::line('lbl_taxons.size')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('size', $specie->size, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div> 
		             <div class="control-group"> 
		                <label class="control-label" for="Headpores">{{ Lang::line('lbl_taxons.headpores')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('headpores', $specie->headpores, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div> 
		             <div class="control-group"> 
		                <label class="control-label" for="GeneralMorphology">{{ Lang::line('lbl_taxons.generalmorphology')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('generalmorphology', $specie->generalmorphology, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div>       
               	 </div>               	 
                 <div class="span5">
		             <div class="control-group"> 
		                <label class="control-label" for="Teeth">{{ Lang::line('lbl_taxons.teeth')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('teeth', $specie->teeth, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div>   
		             <div class="control-group"> 
		                <label class="control-label" for="Fins">{{ Lang::line('lbl_taxons.fins')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('fins', $specie->fins, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div>
		             <div class="control-group"> 
		                <label class="control-label" for="Colors">{{ Lang::line('lbl_taxons.colors')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('colors', $specie->color, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div>        
                 </div>
		       </div>           
            </div>
            <div class="tab-pane" id="tab3">
              	<div class="well row-fluid" style="width:90%"> 
               	 <div class="span5"> 
		             <div class="control-group"> 
		                <label class="control-label" for="Scales">{{ Lang::line('lbl_taxons.scales')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('scales', $specie->scales, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div>  <option value="{{ $parent->id }}">{{ $parent->taxonname }}</option>
		             <div class="control-group"> 
		                <label class="control-label" for="Distribution">{{ Lang::line('lbl_taxons.distribution')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('distribution', $specie->distribution, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div> 
		             <div class="control-group"> 
		                <label class="control-label" for="Papillae">{{ Lang::line('lbl_taxons.papillae')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('papillae', $specie->papillae, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div>          
               	 </div>               	 
                 <div class="span5"> 
                    <div class="control-group"> 
		                <label class="control-label" for="Habitat & Depth">{{ Lang::line('lbl_taxons.habitatdepth')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('habitatdepth', $specie->habitatdepth, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div> 
		             <div class="control-group"> 
		                <label class="control-label" for="Breeding">{{ Lang::line('lbl_taxons.breeding')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('breeding', $specie->breeding, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div>   
		             <div class="control-group"> 
		                <label class="control-label" for="Notes">{{ Lang::line('lbl_taxons.notes')->get($lang) }}</label>
		                <div class="controls">              
						      {{ Form::text('notes', $specie->notes, array('class' => 'span12','rel'=>'popover')); }}        
		                 </div>
		             </div>     
                 </div>
		       </div>    
            
            </div>
               
         </div>
       </div>
         {{ Form::hidden('id', $specie->id); }}
         {{ Form::hidden('taxontype', 'S'); }}
            
		 <div class="row-fluid">
			<button id="btn-cancel" class="btn" >{{ Lang::line('lbl_taxons.cancel')->get($lang) }}</button>
			<button id="btn-save" class="btn btn-primary" type="submit">{{ Lang::line('lbl_taxons.save')->get($lang) }}</button>
		 </div>	
    {{ Form::close() }}  
    <form id="frm-cancel" name="frm-cancel" method="post"></form>    
</div>

<script type="text/javascript">
$(document).ready(function(e) {

	 $('#frm').validate(
	  {
		rules: {
			    genusid: { required: true },
			    taxonname: { required: true },
			    authorname: { required: true },
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
		 $('#frm-cancel').attr('action',"<?php echo URL::to('backoffice/taxonomic/list_species/'.$genusid) ?>");
		 $('#frm-cancel').submit();
	 });
	 
	 $('#btn-save').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
         $('#frm').attr('action', "{{ URL::to('backoffice/taxonomic/save_specie') }}");
         $('#frm').submit();
	 });

	 try{
		 $('#datetimepicker1').datetimepicker({ language: 'en', pick12HourFormat: true });
	    }
	 catch(e){ }   
});
</script> 
    
    
 
@endsection

