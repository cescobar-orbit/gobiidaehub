@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')
<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_variables.variables')->get($lang) }} <small>{{ Lang::line('lbl_variables.all_variables')->get($lang) }}</small></h3>
    
<div class="tab-content" id="tabContent">
	<div id="op1" class="tab-pane active">
		<form id="frm" name="frm" method="post">
			<?php $variables = DB::table('Variables')->get(); ?>
			@if($variables)			
			<table id="recordtable" class="table table-striped table-hover table-bordered" >
				<thead>
					<tr>
						<th>ID</th>
						<th>{{ Lang::line('lbl_variables.variablecode')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_variables.variablename')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_variables.unit')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_variables.speciation')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_variables.samplemedium')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_variables.valuetype')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_variables.datatype')->get($lang) }}</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				    
                     @foreach ($variables as $variable)
                        <tr>
						    <td width="4%">{{ $variable->id }}</td>
							<td width="5%">{{ $variable->variablecode }}</td>
							<td width="25%">{{ $variable->variablename }}</td>
							<td width="10%"><?php $u = Unit::find($variable->variableunitsid);?>
							 @if($u)
							    {{ $u->unitsname }}
							 @endif
							</td>
							<td width="10%">{{ $variable->speciation}}</td>
							<td width="10%">{{ $variable->samplemedium }}</td>
							<td width="10%">{{ $variable->valuetype }}</td>
							<td width="10%">{{ $variable->datatype }}</td>
							
							<td>
							   <div class="btn-group">
									    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
									    {{ Lang::line('lbl_variables.actions')->get($lang) }}
									    <span class="caret"></span>
									    </a>
									    <ul class="dropdown-menu pull-left">
									      <li><a href="<?php echo URL::to('backoffice/variable/edit/'. $variable->id) ?>"><i class="icon-edit"></i>{{ Lang::line('lbl_variables.edit')->get($lang) }}</a></li>
									      <li><a href="<?php echo URL::to('backoffice/variable/confirm_variable_deletion/'. $variable->id) ?>"><i class="icon-remove"></i>{{ Lang::line('lbl_variables.remove')->get($lang) }}</a></li>
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
					  <h4>{{ Lang::line('lbl_variables.warning')->get($lang) }}!</h4>
					      {{ Lang::line('lbl_variables.emptydata')->get($lang) }} ...
			     </div>
            @endif
          
			<div class="row-fluid">
				<button id="btn-cancel" class="btn">{{ Lang::line('lbl_variables.cancel')->get($lang) }}</button>
				<button id="btn-addnew" class="btn btn-primary">{{ Lang::line('lbl_variables.addnew')->get($lang) }}</button>
			</div>
	</form>
	 <br/><br/><br/>
  </div>

</div>

<script type="text/javascript">
$(document).ready(function(e) {
	
    $('#recordtable').dataTable();

    $('#btn-cancel').click(function(){
   	   $('#frm').attr('action',"{{ URL::to('home') }}");
   	   $('#frm').submit();
    });

    $('#btn-addnew').click(function(){
   	   $('#frm').attr('action',"{{ URL::to_action('backoffice/variable/add') }}");
   	   $('#frm').submit();
    });
 
});
</script> 
    
    
 
@endsection

