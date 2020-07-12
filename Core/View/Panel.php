<div class="panel-container">
	
	<div class="panel-information p-4 text-white d-flex flex-column justify-content-center align-items-center">
		<h3>1- Seleccione las imagenes que desea convertir</h1>
		<h3>2- Descargue el PDF!</h1>
		<p class="mt-3">Opcional: Configurar tipo de hoja y orientacion. | Si sale, perdera todo su progreso</p>
	</div>

	<div class="panel-options d-flex flex-column justify-content-center align-items-center">
		
		<div class="panel-upload d-flex justify-content-center flex-column justify-content-center align-items-center">
			<p class="d-none"></p>
			<input type="file" class="text-dark" id="file" multiple>
			<button class="btn bg-info text-white mt-3" id="upload-image"><i class="fa fa-upload"></i> Subir imagenes</button>			
		</div>
		
		<div class="panel-actions d-flex flex-row justify-content-center align-items-center mt-4">
			<form action="Core/Scripts/GeneratePDF.php" method="POST">
				<input type="text" name="images" class="d-none" value="" id="get-image-name">
				<input type="text" name='config' class='d-none' value='' id='get-pdf-config'>
				<button type="submit" class="btn bg-info text-white" id="download-btn"><i class="fa fa-download"></i> Descargar PDF</button>
			</form>
			<button class="btn bg-info text-white ml-3" data-toggle="modal" data-target="#config-modal" id='config-btn'><i class="fa fa-cogs"></i> Configurar PDF</button>			
		</div>
	
	</div>

	<div class="panel-preview">
		<div class="files-preview d-flex justify-content-center align-items-center flex-row p-3">
		</div>
	</div>
</div>


<div id='config-modal' class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Configuraciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<input type="text" class="form-control mb-4" id='pdf-name' placeholder="Nombre del archivo">
        <select name="" id="pageType">
        	<option value="A4">A4</option>
        	<option value="Legal">legal</option>
        	<option value="Letter">Carta</option>
        </select>
        <select name="" id="pageOrientation">
        	<option value="Landscape">Landscape</option>
        	<option value="Portrait">Retrato</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='accept-config-changes'>Guardar cambios</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>