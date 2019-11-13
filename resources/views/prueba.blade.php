<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>	</title>
</head>
<body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
	<script
	src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	crossorigin="anonymous"></script>
        @php $i = 0; @endphp
        @foreach($articulos as $articulo)
        {{ $i++ }}
        {{ $articulo->images()}}
        <br>    
        @endforeach

        <br>    
        <br> 
        @php $i = 0; @endphp   
        @foreach($articulos2 as $articulo)
        {{ $i++ }}
        {{ $articulo->name}}
        <br>    
        @endforeach

        <br>    
        <br> 
       {{--  @foreach($articulos2 as $articulo)
        
        @foreach($articulo as $item)
        {{ $i++ }}
        {{ $item->name }}
        <br>    
        
        @endforeach
        
        @endforeach --}}
    <br>  
    <br>      

    <br>    
    <br>    
    <br>     <br>     <br>     <br>     <br>    
    <br>     <br>     <br>    
    <br>    

    <form action="{{ asset('/upload') }}"
    method="POST"
    class="dropzone"
    id="my-awesome-dropzone" multiple="multiple" files="true" enctype="multipart/form-data">
    <input  name="_token" type="" value="{{ csrf_token() }}">
    <input class="form-control" type="file" name="image" id="upload_file">


    <input class="form-control" type="file" name="image" id="upload_file">


</form>

<button id="button">Registro 111</button>



<form method="post" action="{{url('upload')}}" enctype="multipart/form-data" 
class="dropzone" id="dropzone">
<input  name="_token" type="" value="{{ csrf_token() }}">
<button type="submit">Registro</button>
</form> 

{{-- <script>	
	$("#button").click(function (e) {
		alert(1);
		myDropzone.processQueue();
		e.preventDefault();
		
	});
</script> --}}

{{-- <script>	
Dropzone.options.frmTarget = {
    autoProcessQueue: false,
    url: 'upload_files.php',
    init: function () {

        var myDropzone = this;

        // Update selector to match your button
        $("#button").click(function (e) {
            e.preventDefault();
            myDropzone.processQueue();
        });

        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#frmTarget').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });
    }
}
</script> --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fine Uploader New/Modern CSS file
        ====================================================================== -->
        <link href="client/fine-uploader-new.css" rel="stylesheet">

    <!-- Fine Uploader JS file
        ====================================================================== -->
        <script src="client/fine-uploader.js"></script>

    <!-- Fine Uploader Thumbnails template w/ customization
        ====================================================================== -->
        <script type="text/template" id="qq-template-manual-trigger">
            <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
                <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
                </div>
                <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                    <span class="qq-upload-drop-area-text-selector"></span>
                </div>
                <div class="buttons">
                    <div class="qq-upload-button-selector qq-upload-button">
                        <div>Select files</div>
                    </div>
                    <button type="button" id="trigger-upload" class="btn btn-primary">
                        <i class="icon-upload icon-white"></i> Upload
                    </button>
                </div>
                <span class="qq-drop-processing-selector qq-drop-processing">
                    <span>Processing dropped files...</span>
                    <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
                </span>
                <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                    <li>
                        <div class="qq-progress-bar-container-selector">
                            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                        </div>
                        <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                        <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                        <span class="qq-upload-file-selector qq-upload-file"></span>
                        <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                        <span class="qq-upload-size-selector qq-upload-size"></span>
                        <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                        <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                        <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                        <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                    </li>
                </ul>

                <dialog class="qq-alert-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">Close</button>
                    </div>
                </dialog>

                <dialog class="qq-confirm-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">No</button>
                        <button type="button" class="qq-ok-button-selector">Yes</button>
                    </div>
                </dialog>

                <dialog class="qq-prompt-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <input type="text">
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">Cancel</button>
                        <button type="button" class="qq-ok-button-selector">Ok</button>
                    </div>
                </dialog>
            </div>
        </script>

        <style>
            #trigger-upload {
                color: white;
                background-color: #00ABC7;
                font-size: 14px;
                padding: 7px 20px;
                background-image: none;
            }

            #fine-uploader-manual-trigger .qq-upload-button {
                margin-right: 15px;
            }

            #fine-uploader-manual-trigger .buttons {
                width: 36%;
            }

            #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
                width: 60%;
            }
        </style>

        <title>Fine Uploader Manual Upload Trigger Demo</title>
    </head>
    <body>
    <!-- Fine Uploader DOM Element
        ====================================================================== -->
        <div id="fine-uploader-manual-trigger"></div>

    <!-- Your code to create an instance of Fine Uploader and bind to the DOM/template
        ====================================================================== -->
        <script>
            var manualUploader = new qq.FineUploader({
                element: document.getElementById('fine-uploader-manual-trigger'),
                template: 'qq-template-manual-trigger',
                request: {
                    endpoint: '/server/uploads'
                },
                thumbnails: {
                    placeholders: {
                        waitingPath: '/source/placeholders/waiting-generic.png',
                        notAvailablePath: '/source/placeholders/not_available-generic.png'
                    }
                },
                autoUpload: false,
                debug: true
            });

            qq(document.getElementById("trigger-upload")).attach("click", function() {
                manualUploader.uploadStoredFiles();
            });
        </script>
    </body>
    </html>


    <script type="text/javascript">

       Dropzone.options.dropzone =
       {
          autoProcessQueue: false,
          init: function() {
             var submitButton = document.querySelector("#button")
        myDropzone = this; // closure

        submitButton.addEventListener("click", function() {
      myDropzone.processQueue(); // Tell Dropzone to process all queued files.
  });

    // You might want to show the submit button only when 
    // files are dropped here:
    this.on("addedfile", function() {
      // Show submit button here and/or inform user to click it.
  });

},
maxFilesize: 12,
renameFile: function(file) {
	var dt = new Date();
	var time = dt.getTime();
	return time+file.name;
},
acceptedFiles: ".jpeg,.jpg,.png,.gif",
addRemoveLinks: true,
timeout: 5000,
success: function(file, response) 
{
	console.log(response);
},
error: function(file, response)
{
	return false;
}
};
</script>

{{-- <script>
    Dropzone.options.myDropzone = {
        paramName: 'file',
        maxFilesize: 5, // MB
        maxFiles: 20,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        init: function() {
            this.on("success", function(file, response) {
                var a = document.createElement('span');
                a.className = "thumb-url btn btn-primary";
                a.setAttribute('data-clipboard-text','{{url('/uploads')}}'+'/'+response);
                a.innerHTML = "copy url";
                file.previewTemplate.appendChild(a);
            });
        }
    };
</script>
--}}


<script>

	// Dropzone.options.myDropzone = {
	// 	paramName: 'file',
 //        maxFilesize: 5, // MB
 //        maxFiles: 1,
 //        dictDefaultMessage: "Probando",
 //        acceptedFiles: ".jpeg,.jpg,.png,.gif",
 //        init: function() {
 //        	this.on("success", function(file, response) {
 //        		var a = document.createElement('span');
 //        		a.className = "thumb-url btn btn-primary";
 //        		a.setAttribute('data-clipboard-text','{{url('/uploads')}}'+'/'+response);
 //        		a.innerHTML = "copy url";
 //        		file.previewTemplate.appendChild(a);
 //        	});
 //        }
 //    };
// "myAwesomeDropzone" is the camelized version of the HTML element's ID
// Dropzone.options.myAwesomeDropzone = {
//   paramName: "file", // The name that will be used to transfer the file
//   maxFilesize: 0.1, // MB
//   accept: function(file, done) {
//     if (file.name == "justinbieber.jpg") {
//       done("Naha, you don't.");
//     }
//     else { done("Hola."); }
//   }
// };

</script>
</body>
</html>