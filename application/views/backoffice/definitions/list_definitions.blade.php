@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')

<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_definitions.definitions')->get($lang) }} &nbsp;<small>{{ Lang::line('lbl_definitions.all_definitions')->get($lang) }}</small></h3>
 
    
<div class="tab-content" id="tabContent">
	<div id="op1" class="tab-pane active">
		   	   
		<form id="frm" name="frm" method="post">	    
			@if($definitions)			
			<table id="recordtable" class="table table-striped table-hover table-bordered table-condensed">
				<thead>
					<tr>
						<th>ID</th>
						<th>{{ Lang::line('lbl_definitions.term')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_definitions.category')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_definitions.definition')->get($lang) }}</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				   @foreach ($definitions as $def)
                        <tr>
						    <td width="5%">{{ $def->id }}</td>
							<td width="18%">
							    <a data-toggle="modal" href="#previewImageModal{{ $def->id }}">{{ $def->term }}</a>
							    <!-- Preview Form -->
							    <div class="modal hide fade" id="previewImageModal{{ $def->id }}">
								   <div class="modal-header">
									    <button type="button" class="close" data-dismiss="modal">×</button>
									     <h3>{{ Lang::line('lbl_definitions.detail')->get($lang) }}</h3>
								    </div>
									<div class="modal-body">
	  							      <table border="0" width="100%">
									      <tr>
									        <td>
									            <div class="fileupload-preview thumbnail" style="width: 250px; height: 190px;">
									              @if(isset($def->photo))
									                 <img width="250px" height="190px" src="<?php echo URL::to_asset('uploads/images/definitions/'.$def->photo) ?>" />

									              @endif
									            </div>
									        </td>
									        <td width="30%">
                                               <address>
                                                  <strong>{{ $def->term }}</strong><br/>
                                                  {{ Category::find($def->categoryid)->categoryname }}<br/>
                                               </address>                                                             
                                           </td>
                                       </tr>
                                      </table> 
                                       <address>
                                                <strong>Definition:</strong><br/>
                                                <p align="justify"><small> {{ $def->definition }}</small></p>
                                       </address>  
									 </div>
									 <div class="modal-footer">
							            <a href="#" class="btn btn-info" data-dismiss="modal">{{ Lang::line('lbl_contributors.cancel')->get($lang) }}</a>
									 </div>
							    </div> 
							
							</td>
							<td width="15%">{{ Category::find($def->categoryid)->categoryname }}</td>
							<td width="46%">{{ $def->definition}}</td>							
							<td>
							    <div class="btn-group">
									    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
									    {{ Lang::line('lbl_definitions.actions')->get($lang) }}
									    <span class="caret"></span>
									    </a>
									    <ul class="dropdown-menu pull-left">
									      <li><a href="<?php echo URL::to('backoffice/definition/edit/'. $def->id) ?>"><i class="icon-edit"></i>{{ Lang::line('lbl_definitions.edit')->get($lang) }}</a></li>
									      <li><a href="<?php echo URL::to('backoffice/definition/confirm_deletion/'. $def->id) ?>"><i class="icon-remove"></i>{{ Lang::line('lbl_definitions.remove')->get($lang) }}</a></li>
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
					  <h4>{{ Lang::line('lbl_definitions.warning')->get($lang) }}!</h4>
					      {{ Lang::line('lbl_definitions.emptydata')->get($lang) }} ...
			 </div>
         @endif
          
			<div class="row-fluid">
				<button id="btn-cancel" class="btn">{{ Lang::line('lbl_definitions.cancel')->get($lang) }}</button>
				<button id="btn-addnew" class="btn btn-primary">{{ Lang::line('lbl_definitions.addnew')->get($lang) }}</button>
			</div>
	</form>
	 <br/><br/>
  </div>


</div>

<script type="text/javascript">
$(document).ready(function(e) {
	
  $('#recordtable').dataTable();

  $('#btn-addnew').click(function(){
	  $(this).attr("disabled","disabled"); // prevent double submiting
	  $('#frm').attr('action',"{{ URL::to_action('backoffice/definition/add') }}");
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

