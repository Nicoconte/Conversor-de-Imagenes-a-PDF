
const images = [];

function getBackMessage(tag ,text, classes)
{
	$(tag).text(text);
	$(".panel-upload p").addClass(classes);
	setTimeout(() => {
		$(tag).removeClass(classes);
	}, 1000);

}

function updatePreview(images)
{
	let templateWithImage = "";	
	let elementOnScreen = 0;

	let template = "";

	images.forEach(image => {
		templateWithImage += `
					<div class="preview d-flex flex-column ml-4 border" image-name=${image} style="width:15%; height:100%;">
										
						<div class="d-flex justify-content-end align-items-center" style="width:100%; height:15%;">
							<button class="delete-image btn bg-danger btn-sm"><i class="fa fa-times"></i></button>
						</div>
										
						<div style="width:100%; height:85%;">
							<img src="Uploads/${image}" style="width:100%; height:100%;">
						</div>
									 
					</div>`
		elementOnScreen++;
	});

	let alternativeTemplate = "<div class='d-flex justify-content-center align-items-center' style='width:100%;height:100%'><h4>No hay archivos!</h4><div>";

	template = (elementOnScreen === 0) ? alternativeTemplate : templateWithImage;

	$(".files-preview").html(template);

}

function resetFileInput()
{
	document.getElementById("file").value = "";
}

function deleteSpecificImageFromServer(name)
{	
	$.post("Core/Scripts/DeleteSpecificFile.php", {action : "delete-specific-image", image : name});
}

function deleteSpecificImageFromPreview()
{
	$(document).on("click", ".delete-image", function() {

		let index = 0;

		let element = $(this)[0].parentElement.parentElement;
		let imageName = $(element).attr("image-name");

		deleteSpecificImageFromServer(imageName)

		images.forEach(image => {
			if(image === imageName)
			{
				index = images.indexOf(image);
					
				if (index > -1)
				{
					images.splice(index, 1);
				}	
			}
		})

		$("#get-image-name").attr("value", images);

		updatePreview(images);
	})
}


function uploadImages() 
{
	$(document).on("click", "#upload-image", function() {

		let file = document.getElementById("file").files[0];
		formData = new FormData();
		formData.append("file", file);

		$.ajax({
			type : "POST",
			dataType : "JSON",
			cache : false,
			contentType : false,
			processData : false,			
			url : "Core/Scripts/UploadFile.php",
			data : formData,
			success : function(response) {
		
				if (response.success)
				{	
					images.push(response.name);

					$("#get-image-name").attr("value", images);

					updatePreview(images);
					getBackMessage(".panel-upload p", "Archivo subido!", "d-block text-success");
					resetFileInput();
				}
				else
				{
					getBackMessage(".panel-upload p", "No se pudo subir el Archivo :C", "d-block text-danger");
					resetFileInput()
				}
			}
		});

	});
}


function setConfiguration()
{		

	$("#accept-config-changes").click(function() {
		
		$("#get-pdf-config").attr("value", ($("#pageType").val() + "," +$("#pageOrientation").val() + "," + $("#pdf-name").val()));
		Swal.fire({
			icon : "success",
			text : "Los cambios han sido realizados!",
			timer : 1500
		})
	});
}


function actionPosDownload()
{
	$("#download-btn").click(function() {
		images.length = 0;
		Swal.fire({
			icon : "success",
			text : "La descarga esta por comenzar",
			timer : 2500
		})
		setTimeout(() => {
			updatePreview(images);
		}, 2500);
	})
}

function ready() {
	uploadImages();
	deleteSpecificImageFromPreview();
	actionPosDownload();
	updatePreview(images);
	setConfiguration();
}


$(document).ready(ready);