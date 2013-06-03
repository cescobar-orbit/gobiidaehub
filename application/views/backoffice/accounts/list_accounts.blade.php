@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')

<?php $lang = Session::get('lang', function() { return 'en';}); ?>
<br/>
<h3>{{ Lang::line('lbl_accounts.user_accounts')->get($lang) }} &nbsp;<small>{{ Lang::line('lbl_accounts.all_accounts')->get($lang) }}</small></h3>
 <br/>   
<div class="tab-content" id="tabContent">
	<div id="op1" class="tab-pane active">
		<form id="frm" name="frm" method="post">
		    <?php $accounts = Account::all(); ?>
			@if($accounts)			
			<table class="table table-striped table-hover table-bordered table-condensed" id="recordtable">
				<thead>
					<tr>
						<th>ID</th>
						<th>{{ Lang::line('lbl_accounts.username')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_accounts.firstname')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_accounts.role')->get($lang) }}</th>
						<th>{{ Lang::line('lbl_accounts.status')->get($lang) }}</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>				   
                     @foreach ($accounts as $acct)
                        <tr>
						    <td>{{ $acct->id }}</td>
							<td>{{ $acct->username }}</td>
							<td>{{ $acct->accountname }}</td>
							<td>{{ Role::find($acct->roleid)->rolename }}</td>
							<td>@if ($acct->active )
							     <span class="label label-success">{{ Lang::line('lbl_accounts.active')->get($lang) }}</span>
                                @else
                                  <span class="label label-important">{{ Lang::line('lbl_accounts.inactive')->get($lang) }}</span>
                                @endif
							</td>
							<td>
							    <div class="btn-group">
									    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
									    {{ Lang::line('lbl_accounts.actions')->get($lang) }}
									    <span class="caret"></span>
									    </a>
									    <ul class="dropdown-menu pull-left">
									      <li><a href="<?php echo URL::to('backoffice/account/edit/'. $acct->id) ?>"><i class="icon-edit"></i>{{ Lang::line('lbl_accounts.edit')->get($lang) }}</a></li>
									      <li><a href="<?php echo URL::to('backoffice/account/confirm/'. $acct->id) ?>"><i class="icon-remove"></i>{{ Lang::line('lbl_accounts.remove')->get($lang) }}</a></li>
									      <li><a href="<?php echo URL::to('backoffice/account/reset_password/'. $acct->id) ?>"><i class="icon-refresh"></i>{{ Lang::line('lbl_accounts.resetpassword')->get($lang) }}</a></li>
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
					  <h4>{{ Lang::line('lbl_accounts.warning')->get($lang) }}!</h4>
					  {{ Lang::line('lbl_accounts.emptydata')->get($lang) }} ...
			     </div>
            @endif
			<div class="row-fluid">
				<button id="btn-cancel" class="btn">{{ Lang::line('lbl_accounts.cancel')->get($lang) }}</button>
				<button id="btn-addnew" class="btn btn-primary">{{ Lang::line('lbl_accounts.addnew')->get($lang) }}</button>
			</div>	
 
	</form>
  </div>
<br/><br/>

</div>

<script type="text/javascript">
$(document).ready(function(e) {

 $('#recordtable').dataTable();
	 	
 $('#btn-cancel').click(function(){
	 $(this).attr("disabled","disabled"); // prevent double submiting
	 $('#frm').attr('action',"{{ URL::to('/backoffice/app/home') }}");
	 $('#frm').submit();
 });

 $('#btn-addnew').click(function(){
	 $(this).attr("disabled","disabled"); // prevent double submiting
	 $('#frm').attr('action',"{{ URL::to_action('backoffice/account/add') }}");
	 $('#frm').submit();
 });


 
});
</script> 
    
    
 
@endsection

