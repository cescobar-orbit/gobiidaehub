@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_sites.sites')->get($lang) }} &nbsp; <small>{{ Lang::line('lbl_sites.edit_site')->get($lang) }}</small></h3>
    
    <div class="container-fluid">
          @if(isset($error_data))
	         <div class="alert alert-error">
	          {{ $error_data }}
	        </div>
	      @endif
    <form id="frm" name="frm" method="post" class="form-horizontal well">
    
     <div class="row">
       <div class="span15">
        <div class="row-fluid">
            
          <div class="span4">
            
             <div class="control-group"> 
                <label class="control-label" for="Site">{{ Lang::line('lbl_sites.sitename')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('sitename', $site->sitename, array('class' => 'span12','rel'=>'popover')); }}        
                 </div>
             </div> 
             
             <div class="control-group"> 
                <label class="control-label" for="Sitecode">{{ Lang::line('lbl_sites.sitecode')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('sitecode', $site->sitecode, array('class' => 'span12','rel'=>'popover')); }}        
                 </div>
             </div>
             
             <div class="control-group"> 
                <label class="control-label" for="Location">{{ Lang::line('lbl_sites.location')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="locationcode" name="locationcode">
			      
			        <?php  $locations = DB::table('Locations')->order_by('LocationName','asc')->get(); ?>
                    @foreach ($locations as $location)
                      @if((isset($site) && $site->locationcode == $location->locationcode))
                        <option value="{{ $location->locationcode }}" selected>{{ $location->locationname }} </option>
                      @else
                       <option value="{{ $location->locationcode }}">{{ $location->locationname }}</option>    
                      @endif
                    @endforeach
                  </select>
				  
                 </div>
             </div> 
               
             <div class="control-group"> 
                <label class="control-label" for="Organization">{{ Lang::line('lbl_sites.organization')->get($lang) }}</label>
                 <div class="controls">	             
				   <select id="organizationid" name="organizationid">
			      
			        <?php  $orgs = DB::table('Organizations')->order_by("OrganizationName","asc")->get(); ?>
                    @foreach ($orgs as $org)
                      @if((isset($contact) && $contact->organizationid == $org->id) || $org->id == 1)
                        <option value="{{ $org->id }}" selected>{{ $org->organizationname }} </option>
                      @else
                       <option value="{{ $org->id }}">{{ $org->organizationname }}</option>  
                      @endif  
                    @endforeach
                  </select>
				  
                 </div>
             </div> 
                   
             
             <div class="control-group"> 
                <label class="control-label" for="Owner">{{ Lang::line('lbl_sites.owner')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('owner', $site->owner, array('class' => 'span12','rel'=>'popover')); }}        
                 </div>
             </div> 
             
             <div class="control-group"> 
                <label class="control-label" for="Supervisor">{{ Lang::line('lbl_sites.supervisor')->get($lang) }}</label>
                <div class="controls">              
				   <select id="superpersonid" name="superpersonid">
			      
			        <?php  $officers = DB::table('Accounts')->where("RoleID","=", 2)->order_by("Username","asc")->get(); ?>
                    @foreach ($officers as $officer)
                      @if((isset($supervisor) && $supervisor->id == $officer->id))
                        <option value="{{ $officer->id }}" selected>{{ $officer->username }} </option>
                      @else
                       <option value="{{ $officer->id }}">{{ $officer->username }}</option> 
                      @endif   
                    @endforeach
                  </select>       
                 </div>
             </div> 
             
             <div class="control-group"> 
                <label class="control-label" for="Technical">{{ Lang::line('lbl_sites.technical')->get($lang) }}</label>
                <div class="controls">              
				   <select id="techpersonid" name="techpersonid">
			      
			        <?php  $operators = DB::table('Accounts')->where("RoleID","=",5)->order_by("Username","asc")->get(); ?>
                    @foreach ($operators as $operator)
                      @if((isset($tech) && $tech->id == $operator->id))
                        <option value="{{ $operator->id }}" selected>{{ $operator->username }} </option>
                      @else
                       <option value="{{ $operator->id }}">{{ $operator->username }}</option>  
                      @endif  
                    @endforeach
                  </select>       
                 </div>
             </div>            
             
              <div class="control-group"> 
                  <label class="control-label" for="State">{{ Lang::line('lbl_sites.state')->get($lang) }}</label>
                  <div class="controls">              
				      {{ Form::text('state', $site->state, array('class' => 'span8','rel'=>'popover')); }}        
                   </div>
              </div>
                
              <div class="control-group"> 
                  <label class="control-label" for="County">{{ Lang::line('lbl_sites.county')->get($lang) }}</label>
                  <div class="controls">              
				      {{ Form::text('county', $site->county, array('class' => 'span8','rel'=>'popover')); }}        
                   </div>
               </div> 
               
             <div class="control-group"> 
               <label class="control-label" for="Startdate">{{ Lang::line('lbl_sites.startdate')->get($lang) }}</label>
                <div class="controls">         
				  <div id="datetimepicker1" class="input-append"> 
				    <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"> </i> </span>
				     {{ Form::text('startdate', $site->startdate, array('data-format' => 'yyyy-MM-dd')); }}         
				  </div>                 
			   </div>
             </div>   
             
          </div>
          <div class="span5">
             <div class="control-group"> 
                <label class="control-label" for="Elevation">{{ Lang::line('lbl_sites.elevation')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('elevation_m', $site->elevation_m, array('class' => 'span5','rel'=>'popover')); }}        
                 </div>
             </div> 
             
             <div class="control-group"> 
                <label class="control-label" for="PosAccuracy">{{ Lang::line('lbl_sites.posaccuracy')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('posaccuracy_m', $site->posaccuracy_m, array('class' => 'span5','rel'=>'popover')); }}        
                 </div>
              </div>   
              
             <div class="control-group"> 
                <label class="control-label" for="Latitude">{{ Lang::line('lbl_sites.latitude')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('latitude', $site->latitude, array('class' => 'span5','rel'=>'popover')); }}        
                 </div>
             </div>  
             
             <div class="control-group"> 
                <label class="control-label" for="Longitude">{{ Lang::line('lbl_sites.longitude')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('longitude', $site->longitude, array('class' => 'span5','rel'=>'popover')); }}        
                 </div>
             </div>   
               <div class="control-group"> 
                <label class="control-label" for="LocalX">{{ Lang::line('lbl_sites.localx')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('localx', $site->localx, array('class' => 'span5','rel'=>'popover')); }}        
                 </div>
             </div>
              <div class="control-group"> 
                <label class="control-label" for="LocalY">{{ Lang::line('lbl_sites.localy')->get($lang) }}</label>
                <div class="controls">              
				   {{ Form::text('localy', $site->localy, array('class' => 'span5','rel'=>'popover')); }}        
                 </div>
             </div> 
             
             <div class="control-group"> 
                <label class="control-label" for="LocalProjection">{{ Lang::line('lbl_sites.projectionid')->get($lang) }}</label>
                <div class="controls">              
				   <select id="localprojectionid" name="localprojectionid">
			      
			        <?php  $srefs = DB::table('SpatialReferences')->get(); ?>
                    @foreach ($srefs as $sref)
                      @if((isset($srs) && $srs->id == $sref->id))
                        <option value="{{ $sref->id }}" selected>{{ $sref->srsid }}&nbsp;{{ $sref->srsname }} </option>
                      @endif
                       <option value="{{ $sref->id }}">{{ $sref->srsid }}&nbsp;{{ $sref->srsname }}</option>    
                    @endforeach
                  </select>   
                 </div>
             </div> 
              
             <div class="control-group"> 
                <label class="control-label" for="LatLonDatum">{{ Lang::line('lbl_sites.latlondatumid')->get($lang) }}</label>
                <div class="controls">              
				      {{ Form::text('latondatumid', $site->latlondatumid, array('class' => 'span5','rel'=>'popover')); }}        
                 </div>
             </div> 
             <div class="control-group"> 
                <label class="control-label" for="LocalProjection">{{ Lang::line('lbl_sites.verticaldatum')->get($lang) }}</label>
                <div class="controls">              
				   <select id="verticaldatum" name="verticaldatum">
			         <?php  $verticaldatum = DB::table('VerticalDatumCV')->order_by("Term","asc")->get(); ?>
                     @foreach ($verticaldatum as $vd)
                        @if(isset($site) && $site->verticaldatum == $vd->term)
                          <option value="{{ $vd->id }}" selected>{{ $vd->term }}</option>
                        @else
                           <option value="{{ $vd->id }}">{{ $vd->term }}</option>
                        @endif      
                     @endforeach
                  </select>   
                 </div>
             </div> 
             
             <div class="control-group"> 
               <label class="control-label" for="StationEnd">{{ Lang::line('lbl_sites.stationend')->get($lang) }}</label>
                <div class="controls">         
				  <div id="datetimepicker2" class="input-append"> 
				    <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"> </i> </span>
				    <input type="text" id="stationend" name="stationend" data-format="yyyy-MM-dd"></input>  
				  </div>                 
			   </div>
             </div>                 
                
             <div class="control-group"> 
                  <label class="control-label" for="Comments">{{ Lang::line('lbl_sites.comments')->get($lang) }}</label>
                  <div class="controls">              
				      {{ Form::textarea('comments', $site->comments, array('class' => 'span12','rel'=>'popover')); }}        
                   </div>
              </div>  
  
          </div> 

        </div>       
            <br/>
            {{ Form::hidden('id', $site->id); }}
			<div class="row-fluid">
				<button id="btn-cancel" class="btn" >{{ Lang::line('lbl_sites.cancel')->get($lang) }}</button>
				<button id="btn-save" class="btn btn-primary">{{ Lang::line('lbl_sites.save')->get($lang) }}</button>
			</div>	
		
       </div>
     </div>
   <?php echo Form::close(); ?>
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
		                 superpersonid: { required: true },
		                 techpersonid:  { required: true },
		                 latitude: { required: true, number:true },
		                 longitude: { required: true, number:true },
		                 localx: { required:true, number:true },
		                 localy: { required:true, number:true },
		                 latlondatumid: { required:true, number:true },
		                 localprojectionid: { required:true, number:true },
		                 posaccuracy_m: { number:true },
		                 elevation_m: { number:true },
		                 startdate: { required:true },
		                 verticaldatum:{ required:true},
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
	 
	 $('#btn-save').click(function(){

       $('#frm').attr('action', "{{ URL::to('backoffice/site/save') }}");
       $('#frm').submit();
	 });

	 try{
		 $('#datetimepicker1').datetimepicker({ language: 'en', pick12HourFormat: true });
	     $('#datetimepicker2').datetimepicker({ language: 'en', pick12HourFormat: true });
	    }
	 catch(e){ }
 
});
</script> 
    
    
 
@endsection

