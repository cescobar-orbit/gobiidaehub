@layout('layouts.container')

@section('navigation')
@parent

@endsection

@section('content')

<?php $lang = Session::get('lang', function() { return 'en';}); ?>

<br/><br/>
<form id ="frm" name="frm" method="post" class = "form-horizontal well">
  <div id="dialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-header">
		<!--  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
		<h3 id="myModalLabel">{{ Lang::line('lbl_accounts.confirmation')->get($lang) }}</h3>
	</div>
	<div class="modal-body">
		<p>{{ Lang::line('lbl_accounts.deletion_message')->get($lang) }}</p>
		<p><strong>{{ RoleCV::find($id)->rolename }}</strong></p>
	</div>
	<div class="modal-footer">
		<button id="btn-cancel" class="btn" data-dismiss="modal" aria-hidden="true">{{ Lang::line('lbl_accounts.cancel')->get($lang) }}</button>
		<button id="btn-delete" class="btn btn-primary">{{ Lang::line('lbl_accounts.confirm')->get($lang) }}</button>
	</div>

</div>
</form>

<script type="text/javascript">
$(document).ready(function(e) {

	$('#dialog').modal('show');

	 $('#btn-cancel').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
		 $('#frm').attr('action',"{{ URL::to('backoffice/account/list_roles') }}");
		 $('#frm').submit();
	 });
	 
	 $('#btn-delete').click(function(){
		 $(this).attr("disabled","disabled"); // prevent double submiting
	     $('#frm').attr('action', "<?php echo URL::to('backoffice/account/delete_role/'.$id); ?>");
	     $('#frm').submit();
     });
});
</script>

@endsection