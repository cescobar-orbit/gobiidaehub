@layout('layouts.container')

@section('navigation')
@parent

@endsection


@section('content')

  <h3>Organizations</h3>

    
<div class="tab-content" id="tabContent">
	<div id="op1" class="tab-pane active">
		<form>
			<h4>List of organizations</h4>
			<!-- 
			
			<table class="table table-striped table-hover table-bordered" id="organizationTable">
				<thead>
					<tr>
						<th><input type="checkbox"></th>
						<th rel="tooltip" data-original-title="Organization name">Name</th>
						<th rel="tooltip" data-original-title="State">State</th>
						<th rel="tooltip" data-original-title="City">City</th>
						<th rel="tooltip" data-original-title="Citation">Citation</th>
						<th rel="tooltip" data-original-title="Zip code">Zip code</th>
						<th rel="tooltip" data-original-title="Address">Address</th>
					</tr>
				</thead>
				<tbody>
				    <?php  $institutes = DB::table('Organizations')->get(); ?>
                     @foreach ($institutes as $org)
                        <tr>
							<td class="center"><input type="checkbox"></td>
							<td>{{ $org->organizationname }}</td>
							<td>{{ $org->state }}</td>
							<td>{{ $org->city }}</td>
							<td>{{ $org->citation }}</td>
							<td>{{ $org->zipcode }}</td>
							<td>{{ $org->address }}</td>
					    </tr>
                      @endforeach
				</tbody>
			</table>

			<div class="row-fluid">
				<button class="btn btn-primary disabled" id="btnDeleteMessage">Eliminar</button>
				<button class="btn btn-primary">Marcar</button>
			</div>	<div id="op2" class="tab-pane">
	    </div>
	    -->
	    <?php 
	      $records = Organization::select(array('id','organizationname','city','citation','state', 'zipcode','address'));

          echo Datatables::of($records)->make();
	      ?>      
		</form>
	</div>


</div>

<!-- Modal -->
<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Confirmación</h3>
	</div>
	<div class="modal-body">
		<p>Desea eliminar el/los mensaje(s) seleccionado(s)</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
		<button class="btn btn-primary" id="btnAccept">Aceptar</button>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
	
 $('organizationTable').dataTable();
 
});
</script> 
    
    
    
@endsection

