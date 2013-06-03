@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')

<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_variables.variablenamecv')->get($lang) }}&nbsp;<small>{{ Lang::line('lbl_variables.all_terms')->get($lang) }}</small></h3>
    
<div class="tab-content" id="tabContent">
	<div id="op1" class="tab-pane active">
		<form id="frm" name="frm" method="post">
		 <?php $terms = DB::table('VariableNameCV')->order_by("Term","asc")->get(); ?>
		  @if($terms)				
			<table id="recordtable" class="table table-striped table-hover table-bordered" >
				<thead>
					<tr>
						<th>ID</th>
						<th>{{ Lang::line('lbl_variables.term')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_variables.definition')->get($lang) }}</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>				   
                     @foreach ($terms as $term)
                        <tr>
						    <td width="5%">{{ $term->id }}</td>
							<td width="25%">{{ $term->term }}</td>
							<td width="55%">{{ $term->definition }}</td>
							<td>
							    <div class="btn-group">
									    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
									    {{ Lang::line('lbl_variables.actions')->get($lang) }}
									    <span class="caret"></span>
									    </a>
									     <ul class="dropdown-menu pull-left">
									      <li><a href="<?php echo URL::to('backoffice/variable/edit_variablename/'. $term->id) ?>"><i class="icon-edit"></i>{{ Lang::line('lbl_variables.edit')->get($lang) }}</a></li>
									      <li><a href="<?php echo URL::to('backoffice/variable/confirm_deletion_variablename/'. $term->id) ?>"><i class="icon-remove"></i>{{ Lang::line('lbl_variables.remove')->get($lang) }}</a></li>
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
					  {{ Lang::line('lbl_variables.emptydata')->get($lang) }}...
			     </div>
            @endif
			<div class="row-fluid">
				<button id="btn-cancel" class="btn">{{ Lang::line('lbl_variables.cancel')->get($lang) }}</button>
				<button id="btn-addnew" class="btn btn-primary">{{ Lang::line('lbl_variables.addnew')->get($lang) }}</button>
			</div>	
	</form>
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
	 $('#frm').attr('action',"{{ URL::to_action('backoffice/variable/add_variablename') }}");
	 $('#frm').submit();
 });
 
});
</script> 
    
    
 
@endsection

