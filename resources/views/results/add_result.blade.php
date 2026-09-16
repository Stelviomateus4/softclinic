<div class="modal fade" id="addAnti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add Antimicrobial</h4>
      </div>
      <form method="POST" action="{{ url('#') }}">
@csrf
      <div class="modal-body">
      	<div class="form-group">
			<label>Antimicrobial Name:</label>
		 	{!! Form::text('name', null, array('class' => 'form-control', 'required'=>'required')) !!}
		</div>
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button"><span class='glyphicon glyphicon-remove'></span> Close</button>
          <button class="btn btn-danger" type="reset">Reset</button>
           <button class="btn btn-success" type="submit"><span class='glyphicon glyphicon-ok'></span> Save changes</button>
    </div>
    </form>
  </div>
</div>
</div>