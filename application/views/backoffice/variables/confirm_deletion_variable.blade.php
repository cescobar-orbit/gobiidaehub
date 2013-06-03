@layout('layouts.container')

@section('navigation')
@parent

@endsection

@section('content')

<?php $lang = Session::get('lang', function() { return 'en';}); ?>

<br/><br/>
<?php  echo Form::open('/backoffice/variable/list', 'POST', array('id' => 'frm', 'class' => 'form-horizontal well')); ?>
<div id="dialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-header">
		<!--  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
		<h3 id="myModalLabel">{{ Lang::line('lbl_variables.confirmation')->get($lang) }}</h3>
	</div>
	<div class="modal-body">
		<p>{{ Lang::line('lbl_variables.deletion_message')->get($lang) }}</p>
	</div>
	<div class="modal-footer">
		<button id="btn-cancel" class="btn" data-dismiss="modal" aria-hidden="true">{{ Lang::line('lbl_variables.cancel')->get($lang) }}</button>
		<button id="btn-delete" class="btn btn-primary">{{ Lang::line('lbl_variables.confirm')->get($lang) }}</button>
	</div>

</div>
<?php  echo Form::close(); ?>

<script type="text/javascript">
$(document).ready(function(e) {

	$('#dialog').modal('show');

	 $('#btn-cancel').click(function(){
		 $('#frm').attr('action',"{{ URL::to('backoffice/variable/list') }}");
		 $('#frm').submit();
	 });
	 
	 $('#btn-delete').click(function(){

	        $('#frm').attr('action', "<?php echo URL::to('backoffice/variable/delete/'.$id); ?>");
	        $('#frm').submit();
	  });
});
</script>

@endsection