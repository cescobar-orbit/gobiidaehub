@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_variables.variables')->get($lang) }} &nbsp; <small>{{ Lang::line('lbl_variables.edit_variable')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
    <form id="frm" name="frm" method="post" class="form-horizontal well">
    
     <div class="row">
       <div class="span15">
        <div class="row-fluid">
            
          <div class="span4">
            
             <div class="control-group"> 
                <label class="control-label" for="VariableName">{{ Lang::line('lbl_variables.variablename')->get($lang) }}</label>
                <div class="controls">              
				    <select id="variablename" name="variablename">     
				        <?php  $vnames = DB::table('VariableNameCV')->order_by("Term","asc")->get(); ?>
	                    @foreach ($vnames as $vname)
	                       @if(isset($variable) && $variable->variablename == $vname->term)
	                           <option value="{{ $vname->id }}" selected>{{ $vname->term }}</option> 
	                       @else
	                           <option value="{{ $vname->id }}">{{ $vname->term }}</option> 
	                       @endif
	                          
	                    @endforeach
                  </select>        
                 </div>
             </div> 
             
             <div class="control-group"> 
                <label class="control-label" for="VariableCode">{{ Lang::line('lbl_variables.variablecode')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('variablecode', $variable->variablecode, array('class' => 'span12','rel'=>'popover')); }}        
                 </div>
             </div>
             
             <div class="control-group"> 
                <label class="control-label" for="Units">{{ Lang::line('lbl_variables.unit')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="units" name="units">      
			        <?php  $units = DB::table('Units')->order_by("UnitsName","asc")->get(); ?>
                    @foreach ($units as $unit)
                       @if(isset($variable) && $variable->variableunitsid == $unit->id)
                           <option value="{{ $unit->id }}" selected>{{ $unit->unitsname }}</option> 
                       @else
                           <option value="{{ $unit->id }}">{{ $unit->unitsname }}</option>      
                       @endif   
                    @endforeach
                  </select>
				  
                 </div>
             </div> 
               
             <div class="control-group"> 
                <label class="control-label" for="Speciation">{{ Lang::line('lbl_variables.speciation')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="speciation" name="speciation">
			        <?php  $specs = DB::table('SpeciationCV')->order_by("Term","asc")->get(); ?>
                    @foreach ($specs as $spec)
                      @if(isset($variable) && $variable->speciation == $spec->term)
                         <option value="{{ $spec->id }}" selected>{{ $spec->term }}</option>  
                      @else
                         <option value="{{ $spec->id }}">{{ $spec->term }}</option> 
                      @endif 
                    @endforeach
                  </select>
				  
                 </div>
             </div> 
                   
             <div class="control-group"> 
                <label class="control-label" for="ValueType">{{ Lang::line('lbl_variables.valuetype')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="valuetype" name="valuetype">
			        <?php  $valuetypes = DB::table('ValueTypeCV')->order_by("Term","asc")->get(); ?>
                    @foreach ($valuetypes as $vt)
                       @if(isset($variable) && $variable->valuetype == $vt->term)
                          <option value="{{ $vt->id }}" selected>{{ $vt->term }}</option>
                       @else
                           <option value="{{ $vt->id }}">{{ $vt->term }}</option>
                       @endif     
                    @endforeach
                  </select>
				  
                 </div>
             </div> 
             
            <div class="control-group"> 
                <label class="control-label" for="DataType">{{ Lang::line('lbl_variables.datatype')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="datatype" name="datatype">
			        <?php  $datatypes = DB::table('DataTypeCV')->order_by("Term","asc")->get(); ?>
                    @foreach ($datatypes as $dt)
                       @if(isset($variable) && $variable->datatype == $dt->term)
                           <option value="{{ $dt->id }}" selected>{{ $dt->term }}</option> 
                       @else
                           <option value="{{ $dt->id }}">{{ $dt->term }}</option>
                       @endif   
                    @endforeach
                  </select>
				  
                 </div>
             </div> 
             <div class="control-group"> 
                <label class="control-label" for="GeneralCategory">{{ Lang::line('lbl_variables.generalcategory')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="generalcategory" name="generalcategory">
			        <?php  $generalcategories = DB::table('GeneralCategoryCV')->order_by("Term","asc")->get(); ?>
                    @foreach ($generalcategories as $gc)
                       @if(isset($variable) && $variable->generalcategory == $gc->term)
                           <option value="{{ $gc->id }}" selected>{{ $gc->term }}</option> 
                       @else
                           <option value="{{ $gc->id }}">{{ $gc->term }}</option>
                       @endif    
                    @endforeach
                  </select>
				  
                 </div>
             </div> 
          </div>
          <div class="span5">            
             <div class="control-group"> 
                <label class="control-label" for="SampleMedium">{{ Lang::line('lbl_variables.samplemedium')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="samplemedium" name="samplemedium">
			        <?php  $samplemedium = DB::table('SampleMediumCV')->order_by("Term","asc")->get(); ?>
                    @foreach ($samplemedium as $sm)
                       @if(isset($variable) && $variable->samplemedium == $sm->term)
                           <option value="{{ $sm->id }}" selected>{{ $sm->term }}</option>
                       @else
                           <option value="{{ $sm->id }}">{{ $sm->term }}</option>
                       @endif    
                    @endforeach
                  </select>
				  
                 </div>
             </div>
             
             <div class="control-group"> 
                <label class="control-label" for="TimeUnits">{{ Lang::line('lbl_variables.timeunits')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="timeunits" name="timeunits">
			        <option value="">{{ Lang::line('lbl_menu.select')->get($lang) }}</option>
			        <?php  $timeunits = DB::table('Units')->order_by("UnitsName","asc")->get(); ?>
                    @foreach ($timeunits as $tu)
                       @if(isset($variable) && $variable->variableunitsid == $tu->id)
                          <option value="{{ $tu->id }}" selected>{{ $tu->unitsname }}</option>   
                       @else
                          <option value="{{ $tu->id }}">{{ $tu->unitsname }}</option> 
                       @endif 
                    @endforeach
                  </select>
				  
                 </div>
             </div>  
              
             <div class="control-group"> 
                <label class="control-label" for="TimeSupport">{{ Lang::line('lbl_variables.timesupport')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('timesupport', $variable->timesupport, array('class' => 'span5','rel'=>'popover')); }}        
                 </div>
             </div>  
             
             <div class="control-group"> 
                <label class="control-label" for="IsRegular">{{ Lang::line('lbl_variables.isregular')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="isregular" name="isregular">
                       <option value="0" <?php echo (!$variable->isregular)?"selected":""?>>{{ Lang::line('lbl_sites.srs_no')->get($lang) }}</option>  
                       <option value="1" <?php echo ($variable->isregular)? "selected":""?>>{{ Lang::line('lbl_sites.srs_yes')->get($lang) }}</option>
                   </select>				  
                 </div>
             </div>   
             <div class="control-group"> 
                <label class="control-label" for="NoDataValue">{{ Lang::line('lbl_variables.nodatavalue')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('nodatavalue', $variable->nodatavalue, array('class' => 'span5','rel'=>'popover')); }}        
                 </div>
             </div>
             <div class="control-group"> 
                 <label class="control-label" for="IsElectronic">{{ Lang::line('lbl_variables.iselectronic')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="iselectronic" name="iselectronic">
                       <option value="0" <?php echo (!$variable->iselectronic) ? "selected":""?>>{{ Lang::line('lbl_sites.srs_no')->get($lang) }}</option>  
                       <option value="1" <?php echo ($variable->isregular) ? "selected":""?> >{{ Lang::line('lbl_sites.srs_yes')->get($lang) }}</option>
                   </select>				  
                 </div>
             </div>  
          </div>  
     
        </div>       
            <br/>
            {{ Form::hidden('id', $variable->id); }}
			<div class="row-fluid">
				<button id="btn-cancel" class="btn" >{{ Lang::line('lbl_variables.cancel')->get($lang) }}</button>
				<button id="btn-save" class="btn btn-primary" type="submit">{{ Lang::line('lbl_variables.save')->get($lang) }}</button>
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
				 variablename: { required: true },
				 variablecode: { required: true },
                 speciation: { required: true },
                 units: { required: true },
                 samplemedium: { required: true },
                 valuetype:  { required: true },
                 isregular: { required: true},
                 timesupport: { required: true, number:true },
                 timeunits: { required:true },
                 datatype: { required:true },
                 generalcategory: { required:true },
                 nodatavalue: { required:true, number:true },
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
		 $('#frm-cancel').attr('action',"{{ URL::to('backoffice/variable/list') }}");
		 $('#frm-cancel').submit();
	 });
	 
	 $('#btn-save').click(function(){

       $('#frm').attr('action', "{{ URL::to('backoffice/variable/save') }}");
       $('#frm').submit();
	 });
  
});
</script> 
    
    
 
@endsection

