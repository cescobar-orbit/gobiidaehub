@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')

<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_menu.contributors')->get($lang) }} &nbsp;<small>{{ Lang::line('lbl_contributors.all_contributors')->get($lang) }}</small></h3>
 
    
<div class="tab-content" id="tabContent">
	<div id="op1" class="tab-pane active">
		   	   
		<form id="frm" name="frm" method="post">

			@if($contributors)			
			<table id="recordtable" class="table table-striped table-hover table-bordered table-condensed" >
				<thead>
					<tr>
						<th>ID</th>
						<th>{{ Lang::line('lbl_contributors.contributor')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_contributors.contributortype')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_contributors.phoneno')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_contributors.email')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_contributors.address')->get($lang) }}</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				   @foreach ($contributors as $contributor)
                        <tr>
						    <td width="5%">{{ $contributor->id }}</td>
							<td width="20%">
							    <a data-toggle="modal" href="#previewImageModal<?php echo $contributor->id ?>">{{ $contributor->contributorname }}</a>
							    <!-- Preview Form -->
							    <div class="modal hide fade" id="previewImageModal<?php echo $contributor->id ?>">
								   <div class="modal-header">
									    <button type="button" class="close" data-dismiss="modal">×</button>
									     <h3>{{ Lang::line('lbl_contributors.detail')->get($lang) }}</h3>
								    </div>
									<div class="modal-body">
	  							      <table border="0" width="100%">
									      <tr>
									        <td>
									            <div class="fileupload-preview thumbnail" style="width: 250px; height: 350px;">
									                 <img width="250px" height="190px" src="<?php echo URL::to_asset('uploads/images/contributors/'.$contributor->photo) ?>" />
									            </div>
									        </td>
									        <td>
                                               <address>
                                                  <strong>{{ $contributor->contributorname }}</strong><br/>
                                                  {{ $contributor->address }}<br/>
                                                  <abbr title="Phone">P:</abbr>{{ $contributor->phoneno }}<br/>
                                                  <a href="mailto:#">{{ $contributor->emailaddress }}</a><br/><br/>
                                                  <strong>{{ Lang::line('lbl_contributors.contributortype')->get($lang) }}</strong>: {{ $contributor->contributortype }}
                                              </address>
                                                             
                                           </td>
                                       </tr>
                                      </table> 
                                       <address>
                                                <strong>Biography:</strong><br/>
                                                <p align="justify"><small> {{ $contributor->detail }}</small></p>
                                       </address>  
									 </div>
									 <div class="modal-footer">
							            <a href="#" class="btn btn-info" data-dismiss="modal">{{ Lang::line('lbl_contributors.cancel')->get($lang) }}</a>
									 </div>
							    </div> 
							</td>
							<td width="7%">{{ $contributor->contributortype }}</td>
							<td width="10%">{{ $contributor->phoneno }}</td>
							<td width="15%">{{ $contributor->emailaddress }}</td>
							<td width="25%">{{ $contributor->address }}</td>
							<td width="15%">
							    <div class="btn-group">
									    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
									    {{ Lang::line('lbl_contributors.actions')->get($lang) }}
									    <span class="caret"></span>
									    </a>
									    <ul class="dropdown-menu pull-left">
									      <li><a href="<?php echo URL::to('backoffice/contributor/edit/'. $contributor->id) ?>"><i class="icon-edit"></i>{{ Lang::line('lbl_contributors.edit')->get($lang) }}</a></li>
									      <li><a href="<?php echo URL::to('backoffice/contributor/confirm_deletion/'. $contributor->id) ?>"><i class="icon-remove"></i>{{ Lang::line('lbl_contributors.remove')->get($lang) }}</a></li>
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
					  <h4>{{ Lang::line('lbl_contributors.warning')->get($lang) }}!</h4>
					      {{ Lang::line('lbl_contributors.emptydata')->get($lang) }} ...
			 </div>
         @endif
          
			<div class="row-fluid">
				<button id="btn-cancel" class="btn">{{ Lang::line('lbl_contributors.cancel')->get($lang) }}</button>
				<button id="btn-addnew" class="btn btn-primary">{{ Lang::line('lbl_contributors.addnew')->get($lang) }}</button>
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
	  $('#frm').attr('action',"{{ URL::to_action('backoffice/contributor/add') }}");
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

