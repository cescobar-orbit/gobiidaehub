@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')

<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_taxons.taxons')->get($lang) }} &nbsp;<small>{{ Lang::line('lbl_taxons.all_taxons')->get($lang) }}</small></h3>
 
    
<div class="tab-content" id="tabContent">
	<div id="op1" class="tab-pane active">

		<form id="frm" name="frm" method="post">

			@if($taxons)			
			<table id="recordtable" class="table table-striped table-hover table-bordered table-condensed"  cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>{{ Lang::line('lbl_taxons.family')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.subfamily')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.specificname')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.taxontype')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.author')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.updated')->get($lang) }}</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				   @foreach ($taxons as $taxon)
				      <?php 
				            $familyColumn = "";
				            $subFamilyColumn = "";
				            $genusColumn = "";

				            switch($taxon->taxontype)
				            {
				            	case 'F':  $familyColumn = "";
				            	           $subfamilyColumn = "";
				            		       break;
				            		       
				            	case 'SF': $ancestor = Taxon::find($taxon->parentid);
				            	           $familyColumn = $ancestor->taxonname;
				            	           $subfamilyColumn = "";
				            		       break;
				            		       
				            	case 'G': $ancestor = Taxon::find($taxon->parentid);
				            	          if($ancestor->taxontype == "F")
				            	          {
				            	          	$familyColumn = $ancestor->taxonname;
				            	          	$subFamilyColumn = "";
				            	          }
				            	          if($ancestor->taxontype == "SF")
				            	          {
				            	           	$subFamilyColumn = $ancestor->taxonname;
				            	           	$familyColumn = Taxon::find($ancestor->parentid)->taxonname;
				            	          }
				            	          
				            	          break;		      
				            }
				            
				           
				      ?>
                        <tr>
						    <td width="5%">{{ $taxon->id }}</td>
							<td width="15%">{{ $familyColumn }}</td>
							<td width="15%">{{ $subFamilyColumn }}</td>
							<td width="15%"> 
							   <a data-toggle="modal" href="#previewImageModal<?php echo $taxon->id ?>">{{ $taxon->taxonname }}</a>
							    <!-- Preview Form -->
							    <div class="modal hide fade" id="previewImageModal<?php echo $taxon->id ?>">
								   <div class="modal-header">
									    <button type="button" class="close" data-dismiss="modal">×</button>
									     <h3>{{ Lang::line('lbl_taxons.detail')->get($lang) }}</h3>
								    </div>
									<div class="modal-body">
									   <dl class="dl-horizontal"> 
									     <dt>{{ Lang::line('lbl_taxons.taxonparent')->get($lang) }}:</dt>             
	                                     <dd>{{ $taxon->taxonname }}</dd>   
                                         <dt>{{ Lang::line('lbl_taxons.specificname')->get($lang) }}:</dt>             
	                                     <dd> {{ $taxon->taxonname}}</dd>   	                                             
                                         <dt> {{ Lang::line('lbl_taxons.taxontype')->get($lang) }}:</dt>
                                         <dd>{{ $taxon->taxontype }}</dd>
                                         <dt>{{ Lang::line('lbl_taxons.author')->get($lang) }}:</dt>
                                         <dd>{{ $taxon->authorname }} </dd>          
                                         <dt>{{ Lang::line('lbl_taxons.updated')->get($lang) }}:</dt>
                                         <dd>{{ $taxon->updated }} </dd>
                                       </dl> 
									 </div>
									 <div class="modal-footer">
							            <a href="#" class="btn btn-info" data-dismiss="modal">{{ Lang::line('lbl_taxons.cancel')->get($lang) }}</a>
									 </div>
							    </div> 
							</td>
							<td width="10%">{{ $taxon->taxontype }}</td>
							<td width="15%">{{ $taxon->authorname}}</td>
							<td width="10%">{{ $taxon->updated}}</td>
	
							<td width="15%">
							    <div class="btn-group">
									    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
									    {{ Lang::line('lbl_taxons.actions')->get($lang) }}
									    <span class="caret"></span>
									    </a>
									    <ul class="dropdown-menu pull-left">
									      <li><a href="<?php echo URL::to('backoffice/taxonomic/edit/'. $taxon->id) ?>"><i class="icon-edit"></i>{{ Lang::line('lbl_taxons.edit')->get($lang) }}</a></li>
									      <li><a href="<?php echo URL::to('backoffice/taxonomic/confirm_taxon_deletion/'. $taxon->id) ?>"><i class="icon-remove"></i>{{ Lang::line('lbl_taxons.remove')->get($lang) }}</a></li>
								          @if($taxon->taxontype == "G")
									        <li><a href="<?php echo URL::to('backoffice/taxonomic/list_species/'. $taxon->id) ?>"><i class="icon-leaf"></i>{{ Lang::line('lbl_taxons.species')->get($lang) }}</a></li>
									      @endif
									      <li><a href="<?php echo URL::to('backoffice/taxonomic/list_taxonimages/'. $taxon->id) ?>"><i class="icon-camera"></i>{{ Lang::line('lbl_taxons.images')->get($lang) }}</a></li>
									    </ul>
							     </div>
							</td>
					    </tr>
                      @endforeach
				</tbody>
			</table>
			<!--  
			<table border="0" align="right">
			  <tr><td>{{ $records }} of {{ $count }}</td><td><td></tr>
			</table>
			-->
            @else
                <div class="alert alert-error">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <h4>{{ Lang::line('lbl_taxons.warning')->get($lang) }}!</h4>
					      {{ Lang::line('lbl_taxons.emptydata')->get($lang) }} ...
			     </div>
            @endif
           <br/>
			<div class="row-fluid">
				<button id="btn-cancel" class="btn">{{ Lang::line('lbl_taxons.cancel')->get($lang) }}</button>
				<button id="btn-addnew" class="btn btn-primary">{{ Lang::line('lbl_taxons.addnew')->get($lang) }}</button>
			</div>
	</form>
	
	 <br/><br/>
  </div>


</div>

<script type="text/javascript">
$(document).ready(function(e) {

	$('#recordtable').dataTable();
	//$('#recordtable').dataTable({"bInfo":false,"bPaginate": false});

	 $('#btn-addnew').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
		 $('#frm').attr('action',"{{ URL::to_action('backoffice/taxonomic/add') }}");
		 $('#frm').submit();
	  });
	  
	 $('#btn-cancel').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
		 $('#frm').attr('action',"{{ URL::to('backoffice/app/home') }}");
		 $('#frm').submit();
	 });

 
});
</script> 
    
    
 
@endsection

