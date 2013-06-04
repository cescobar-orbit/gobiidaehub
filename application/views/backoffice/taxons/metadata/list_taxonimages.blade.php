@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')

<?php $lang = Session::get('lang', function() { return 'en';}); 
      $folder = ($taxon->taxontype == "S") ? "species" : "taxons";
?>
<br/>
<h3>{{ $taxon->taxonname}} &nbsp;<small>{{ Lang::line('lbl_taxons.all_images')->get($lang) }}</small></h3>
 
    
<div class="tab-content" id="tabContent">
	<div id="op1" class="tab-pane active">
         
       {{ Form::open_for_files('upload', 'post', array('id' => 'frm_upload', 'class' => 'form-horizontal well')) }}    
	      <div class="fileupload fileupload-new row-fluid" data-provides="fileupload">
	          
	          <div class="row-fluid">
	            <div class="span6">
	              <div class="control-group"> 
                    <label class="control-label" for="contributor">{{ Lang::line('lbl_taxons.author')->get($lang) }}</label>
			        <div class="controls"> 
			         <select id="contributorid" name="contributorid">
                       <option value="">Select</option>
                       <option value="-999">None Contributor</option>
                        {{ $contributors = Contributor::order_by('contributorname','asc')->get() }}
                        @foreach($contributors as $contributor)
                            <option value="{{ $contributor->id }}">{{ $contributor->contributorname }}</option>
                        @endforeach
                     </select>
                    </div>
                  </div>
                  <div class="control-group">
			          <label class="control-label" for="location">{{ Lang::line('lbl_taxons.imagelocation')->get($lang) }}:</label>
                      <div class="controls">
                         {{ Form::text('imagelocation', null, array('class' => 'span6','rel'=>'popover')); }}  
                     </div> 
			       </div> 
	            </div>
	            <div class="span6">
                    <table border="0">
                        <tr>
                            <td valign="top">
                              <input type="radio" name=specieimageonpage id="specieimageonpage" value="1" checked />
                           </td>
                            <td>{{ Form::label('Image on Specie Page','Image on specie page') }}</td>
                        </tr>
                        <tr>
                            <td valign="top">
                            <input type="radio" name="genusimageonpage" id="genusimageonpage" value="1" />
                            <td>{{ Form::label('Image on genus page','Image on genus page') }}</td>                          
                        </tr>
                     </table>
	            </div>
	          </div>
                
		       <div class="row-fluid">
		          <span class="btn btn-file">
		             <span class="fileupload-new">{{ Lang::line('lbl_taxons.select_image')->get($lang) }}</span>
		               {{ Form::file('image',array('id'=> 'image_file')) }}
		          </span>
		          <button id="btn-upload" class="btn btn-primary" >{{ Lang::line('lbl_taxons.upload_image')->get($lang) }}</button>
		       </div>
			              
	        </div>          

		   {{ Form::hidden('taxonid', $taxon->id); }}	   
	    </div>
	 {{ Form::close() }}    
	  		     
       <form id="frm" name="frm" method="post">
			@if($images)			
			<table id="recordtable" class="table table-striped table-hover table-bordered table-condensed"  cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>{{ Lang::line('lbl_taxons.date')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.image')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.imagelocation')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.author')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.speciepage')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_taxons.genuspage')->get($lang) }}</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				   @foreach ($images as $image)
                        <tr>
						    <td width="5%"><small>{{ $image->id }}</small></td>
						    <td width="15%"><small>{{ $image->created_at }}</small></td>						    
							<td width="20%">
							  <a data-toggle="modal" href="#previewImageModal<?php echo $image->id ?>"><small>{{ $image->imagename }}</small></a>
							     <!-- Preview Form -->
							    <div class="modal hide fade" id="previewImageModal<?php echo $image->id ?>">
								   <div class="modal-header">
									    <button type="button" class="close" data-dismiss="modal">×</button>
									     <h3>{{ Lang::line('lbl_taxons.preview')->get($lang) }}</h3>
								    </div>
									<div class="modal-body">
									    <table border="0" width="100%">
									      <tr>
									        <td>
									              <div class="fileupload-preview thumbnail" style="width: 250px; height: 350px;">
									                 <img src="<?php echo URL::to_asset('uploads/images/'.$folder.'/'.$image->imagename) ?>" />
									              </div>
									        </td>
							                <td width="30%">
							                  <label class="control-label" for="Author"><strong>{{ Lang::line('lbl_taxons.author')->get($lang) }}:</strong></label>
                                              <div class="controls">
                                
                                               </div>
							                  <br/>
							                 
							                 <label class="control-label" for="Description"><strong>{{ Lang::line('lbl_taxons.imagelocation')->get($lang) }}:</strong></label>
                                             <div class="controls">
                                               {{ $image->imagelocation }}
                                             </div>
							                </td>
							              </tr>
							            </table>
									 </div>
									 <div class="modal-footer">
							            <a href="#" class="btn btn-info" data-dismiss="modal">{{ Lang::line('lbl_taxons.cancel')->get($lang) }}</a>
									 </div>
							    </div> 
							</td>
							<td width="15%"><small>{{ $image->imagelocation }}</small></td>
							<td width="15%">
							  <small>
							  <?php  $author = Contributor::find($image->contributorid);  
							         echo  (isset($author)) ? $author->contributorname : "";
							  ?>
							  </small>
							</td>
							
							<td width="10%">
							  @if ($image->speciepageimage)
							     <span class="label label-success">{{ Lang::line('lbl_taxons.srs_yes')->get($lang) }}</span>
                                @else
                                  <span class="label label-important">{{ Lang::line('lbl_taxons.srs_no')->get($lang) }}</span>
                                @endif
							</td>
							
							<td width="10%">
							  @if ($image->genuspageimage)
							     <span class="label label-success">{{ Lang::line('lbl_taxons.srs_yes')->get($lang) }}</span>
                                @else
                                  <span class="label label-important">{{ Lang::line('lbl_taxons.srs_no')->get($lang) }}</span>
                                @endif
							</td>
							
							<td width="10%">
                                <a href="<?php echo URL::to('backoffice/taxonomic/confirm_deletion_image/'. $image->id) ?>"><i class="icon-remove"></i><small>{{ Lang::line('lbl_taxons.remove')->get($lang) }}</small></a>
									   
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
          
			<div class="row-fluid">
				<button id="btn-cancel" class="btn">{{ Lang::line('lbl_taxons.cancel')->get($lang) }}</button>
			</div>
			 {{ Form::hidden('taxonid', $taxon->id); }}	   
	</form>	

   
</div>

<script type="text/javascript">
$(document).ready(function(e) {
	
	 $('#recordtable').dataTable();

	 $('#btn-upload').click(function(){
		 $('#frm_upload').attr('action',"{{ URL::to_action('backoffice/taxonomic/upload_image') }}");
		 $('#frm_upload').submit();
	  });
	  
	 $('#btn-cancel').click(function(){
		 @if($taxon->taxontype != "S")
		     $('#frm').attr('action',"<?php echo URL::to_action('backoffice/taxonomic/list/'.$taxon->id) ?>");
         @else
        	 $('#frm').attr('action',"<?php echo URL::to_action('backoffice/taxonomic/list_species/'.$taxon->parentid) ?>");
         @endif
         
		 $('#frm').submit();
	 });
 
 
});
</script> 
    
    
 
@endsection

