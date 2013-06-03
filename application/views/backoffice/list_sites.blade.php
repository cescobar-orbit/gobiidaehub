@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')

<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
  
<h3></h3>
 
    
 <div class="container-fluid">
	
     <!--Dashboad-->
     <div id="columns" class="row-fluid">
        <br/>
           <div class="alert alert-block alert-info">
             <h4>{{ Lang::line('lbl_menu.info')->get($lang) }}</h4>
             <p>
                {{ Lang::line('lbl_menu.infotext')->get($lang) }}
             </p>
           </div>
        <ul id="widget2" class="ui-sortable unstyled">
            <li id="Widget2" class="widget">
               <div class="widget-head">
                    <span>{{ Lang::line('lbl_sites.sites')->get($lang) }}</span>
                </div>
               <div class="widget-content">	 
                 <div class="widget-iframe" style="overflow: auto;">
                  <div style="overflow:hidden">
                  <?php $sites = Site::where('TechPersonID','=', $acctId)->order_by('SiteName','asc')->get();  ?>
                     @if($sites)			
			           <table id="recordtable" class="table table-striped" >
				         <thead>
							<tr>
							    <th>{{ Lang::line('lbl_locations.location')->get($lang) }}</th>
							    <th>{{ Lang::line('lbl_sites.sitecode')->get($lang) }}</th>
								<th>{{ Lang::line('lbl_sites.sitename')->get($lang) }}</th>
								<th>{{ Lang::line('lbl_activities.pendings')->get($lang) }}</th>
								<th>&nbsp;</th>
							</tr>
						 </thead>
							<tbody>
							   @foreach ($sites as $site)
			                        <tr>
			                            <td width="15%">{{ $site->locationcode }}</td>
									    <td width="15%">{{ $site->sitecode }}</td> 
									    <td width="30%">{{ $site->sitename }}</td> 
										<td width="10%">
										 <?php $activities = SiteActivity::where('SiteID','=', $site->id)->get(); 
										       $pendings = ($activities != null) ? count($activities) : 0;
										      
										 ?>
										 @if($pendings > 0)
										    <a href="<?php echo URL::to('backoffice/activity/worklist/'. $site->id) ?>">{{ $pendings }} </a>
										 @else
										    {{ $pendings }}
										 @endif
										</td>
									    <td width="15%">
									       <li>	  
									        @if($pendings > 0)       	         
									         <a class="btn-small" href="<?php echo URL::to('backoffice/activity/worklist/'. $site->id) ?>"><i class="icon-tasks"></i>{{ Lang::line('lbl_activities.activities')->get($lang) }}</a>
									        @else
									          <a class="btn-small" href="#"><i class="icon-tasks"></i>{{ Lang::line('lbl_activities.activities')->get($lang) }}</a>
									        @endif   
									         <a class="btn-small" href="<?php echo URL::to('backoffice/annotation/display_siteannotations/'. $site->id) ?>"><i class="icon-comment"></i>{{ Lang::line('lbl_annotations.annotations')->get($lang) }}</a>
									      </li>
									    </td>
							           
								    </tr>
			                   @endforeach
			                </tbody>
			            </table>
			            @else
			               <div class="alert alert-error">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <h4>{{ Lang::line('lbl_activities.warning')->get($lang) }}!</h4>
								      {{ Lang::line('lbl_activities.emptydata')->get($lang) }} ...
						  </div>
			           @endif
					  </div>
			       </div>
			     </div>
			   </li>			           	     
		    </ul>
		 
		</div>
	 <br/><br/>
  </div>
    
 
@endsection

