@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')

<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ $genus->taxonname }} &nbsp;<small>{{ Lang::line('lbl_taxons.all_species')->get($lang) }}</small></h3>
 
    
<div class="tab-content" id="tabContent">
	<div id="op1" class="tab-pane active">

		<form id="frm" name="frm" method="post">
			@if($species)			
			<table id="recordtable" class="table table-striped table-hover table-bordered table-condensed"  cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>{{ Lang::line('lbl_taxons.family')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.subfamily')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.genus')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.specie')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.author')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.updated')->get($lang) }}</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				   @foreach ($species as $specie)
				      <?php $ancestor1 = new Taxon;
				            $ancestor2 = new Taxon;
				            $ancestor3 = new Taxon; 
				      
				            $ancestor1 = Taxon::find($specie->parentid);
				            $ancestor2 = (isset($ancestor1)) ? Taxon::find($ancestor1->parentid) : new Taxon;
				            $ancestor3 = (isset($ancestor2)) ? Taxon::find($ancestor2->parentid) : new Taxon;
				            
				            $name3 = ($ancestor3) ? $ancestor3->taxonname : ""; 
				            $name2 = ($ancestor2) ? $ancestor2->taxonname : "";
				            $name1 = ($ancestor1) ? $ancestor1->taxonname : "";
				           
				      ?>
                        <tr>
						    <td width="5%">{{ $specie->id }}</td>
							<td width="15%">{{ (isset($ancestor3)) ? $ancestor3->taxonname: "" }}</td>
							<td width="15%">{{ (isset($ancestor2)) ? $ancestor2->taxonname: "" }}</td>
							<td width="15%">{{ (isset($ancestor1)) ? $ancestor1->taxonname: "" }}</td>
							<td width="10%">
							    <a data-toggle="modal" href="#previewImageModal<?php echo $specie->id ?>">{{ $specie->taxonname }}</a>
							    <!-- Preview Form -->
							    <div class="modal hide fade" id="previewImageModal<?php echo $specie->id ?>">
								   <div class="modal-header">
									    <button type="button" class="close" data-dismiss="modal">×</button>
									     <h3>{{ Lang::line('lbl_taxons.detail')->get($lang) }}</h3>
								    </div>
									<div class="modal-body">
									   <legend>	
									      <small>								                                 
                                             <span><strong>{{ Lang::line('lbl_taxons.author')->get($lang) }}: </strong>{{ $specie->authorname }} </span>&nbsp;&nbsp;                                                 
                                             <span><strong>{{ Lang::line('lbl_taxons.updated')->get($lang) }}:</strong>{{ $specie->updated }} </span>
									      </small>
									   </legend>
									   <dl class="dl-horizontal"> 
									     <dt>{{ Lang::line('lbl_taxons.taxonparent')->get($lang) }}:</dt>             
	                                     <dd>{{ $name1 }}</dd> 
	                                       
                                         <dt>{{ Lang::line('lbl_taxons.specificname')->get($lang) }}:</dt>             
	                                     <dd>{{ $specie->taxonname }}</dd> 
	                                     
	                                     <dt>{{ Lang::line('lbl_taxons.commonname')->get($lang) }}:</dt>             
	                                     <dd>{{ $specie->commonname }}</dd>                   
                                         
                                         <dt>{{ Lang::line('lbl_taxons.taxontype')->get($lang) }}:</dt>
                                         <dd>{{ $specie->taxontype }}</dd>
                                         
                                         <dt>{{ Lang::line('lbl_taxons.description')->get($lang) }}:</dt>             
	                                     <dd>
	                                       <address>
	                                        {{ $specie->description }}
	                                       </address>
	                                     </dd>
	                                     
                                         <dt>{{ Lang::line('lbl_taxons.size')->get($lang) }}:</dt>             
	                                     <dd> {{ $specie->size }}</dd>
	                                     
	                                     <dt>{{ Lang::line('lbl_taxons.headpores')->get($lang) }}:</dt>             
	                                     <dd> {{ $specie->headpores }}</dd>
	                                     
	                                     <dt>{{ Lang::line('lbl_taxons.teeth')->get($lang) }}:</dt>             
	                                     <dd> {{ $specie->teeth }}</dd>
	                                     
	                                     <dt>{{ Lang::line('lbl_taxons.papillae')->get($lang) }}:</dt>             
	                                     <dd> {{ $specie->papillae }}</dd>
	                                     
	                                     <dt>{{ Lang::line('lbl_taxons.fins')->get($lang) }}:</dt>             
	                                     <dd> {{ $specie->fins }}</dd>
	                                     
	                                     <dt>{{ Lang::line('lbl_taxons.colors')->get($lang) }}:</dt>             
	                                     <dd> {{ $specie->color }}</dd>
	                                     
	                                     <dt>{{ Lang::line('lbl_taxons.scales')->get($lang) }}:</dt>             
	                                     <dd> {{ $specie->scales }}</dd>
	                                     
	                                     <dt>{{ Lang::line('lbl_taxons.breeding')->get($lang) }}:</dt>             
	                                     <dd> {{ $specie->breeding }}</dd>
	                                     
	                                     <dt>{{ Lang::line('lbl_taxons.habitatdepth')->get($lang) }}:</dt>             
	                                     <dd> {{ $specie->habitat }}</dd>
	       
	                                     <dt>{{ Lang::line('lbl_taxons.distribution')->get($lang) }}:</dt>             
	                                     <dd>
	                                       <address>
	                                        {{ $specie->distribution }}
	                                       </address>
	                                     </dd> 
	                                     <dt>{{ Lang::line('lbl_taxons.notes')->get($lang) }}:</dt>             
	                                     <dd>
	                                       <address>
	                                        {{ $specie->notes }}
	                                       </address>
	                                     </dd> 
              
                                       </dl> 
									 </div>
									 <div class="modal-footer">
							            <a href="#" class="btn btn-info" data-dismiss="modal">{{ Lang::line('lbl_taxons.cancel')->get($lang) }}</a>
									 </div>
							    </div> 
							</td>
							<td width="15%">{{ $specie->authorname}}</td>
							<td width="10%">{{ $specie->updated}}</td>
	
							<td width="15%">
							    <div class="btn-group">
									    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
									    {{ Lang::line('lbl_taxons.actions')->get($lang) }}
									    <span class="caret"></span>
									    </a>
									    <ul class="dropdown-menu pull-left">
									      <li><a href="<?php echo URL::to('backoffice/taxonomic/edit_specie/'. $specie->id) ?>"><i class="icon-edit"></i>{{ Lang::line('lbl_taxons.edit')->get($lang) }}</a></li>
									      <li><a href="<?php echo URL::to('backoffice/taxonomic/confirm_specie_deletion/'. $specie->id) ?>"><i class="icon-remove"></i>{{ Lang::line('lbl_taxons.remove')->get($lang) }}</a></li>
									      <li><a href="<?php echo URL::to('backoffice/taxonomic/list_taxonimages/'. $specie->id) ?>"><i class="icon-camera"></i>{{ Lang::line('lbl_taxons.images')->get($lang) }}</a></li>
									    </ul>
							     </div>
							</td>
					    </tr>
                      @endforeach
				</tbody>
			</table>
            @else
                <div class="alert alert-error">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <h4>{{ Lang::line('lbl_taxons.warning')->get($lang) }}!</h4>
					      {{ Lang::line('lbl_taxons.emptydata')->get($lang) }} ...
			     </div>
            @endif
        
            {{ Form::hidden('genusid', $genus->id) }}
          
			<div class="row-fluid">
				<button id="btn-cancel" class="btn">{{ Lang::line('lbl_taxons.cancel')->get($lang) }}</button>
				<button id="btn-addnew" class="btn btn-primary">{{ Lang::line('lbl_taxons.addnew')->get($lang) }}</button>
			</div>
	    		
	</form>

  </div>


</div>

<script type="text/javascript">
$(document).ready(function(e) {
	
	 $('#recordtable').dataTable();

	 $('#btn-addnew').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
		 $('#frm').attr('action',"<?php echo URL::to_action('backoffice/taxonomic/add_specie/'.$genus->id) ?>");
		 $('#frm').submit();
	  });
	  
	 $('#btn-cancel').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
		 $('#frm').attr('action',"{{ URL::to('backoffice/taxonomic/list') }}");
		 $('#frm').submit();
	 });

 
});
</script> 
    
    
 
@endsection

