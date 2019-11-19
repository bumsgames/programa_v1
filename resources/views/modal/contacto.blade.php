
<div class="modal fade" id="contactModal">
	<div class="modal-dialog  modal-lg modal-responsive"  >
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">AGENTES ACTIVOS:</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

      {{-- <img src="img/61a25413-e695-49bc-b739-12c23c5b0e1c.jpg" alt="">
      --}}
      <br>
      <div class="container">
      	<br>
      	@foreach ($agentes_activos as $agente)
      	
      	<h2>
      		<li>
      			{{ $agente->name }} {{ $agente->lastname }}.
      			<br>
      			<br>
      			<i class="fab fa-whatsapp"></i> What'sApp: +{{ $agente->telefono}} 
      			<br>
      			<a href="https://wa.me/{{$agente->telefono}}" target="_blank">Click para chatear</a>

      		</li>
      	</h2>
      	<br>
      	<br>
      	@endforeach
      </div>

      <br>
      <br>
      <br>
  </div>
</div>
</div>
