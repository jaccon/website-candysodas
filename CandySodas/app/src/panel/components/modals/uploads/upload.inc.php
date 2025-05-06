<div class="modal fade" id="kt_modal_upload" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content">
      <form class="form" id="kt_modal_upload_form">
        <div class="modal-header">
          <h2 class="fw-bold">Upload files</h2>
          <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
          </div>
        </div>
        <div class="modal-body pt-10 pb-15 px-lg-17">
          <div class="form-group">
            <div id="kt_modal_upload_dropzone" class="dropzone"></div>
            <span class="form-text fs-6 text-muted">Max file size is <?= $CONFIG['CONF']['uploadMaxFileSize']; ?>MB per file.</span>
          </div>
          <div class="form-group mt-4">
            <label for="description">Description</label>
            <textarea 
              id="description" 
              name="description" 
              class="form-control" 
              rows="3" 
              placeholder="Enter file description"></textarea>
          </div>
          <div class="form-group mt-4">
            <label for="metaTaxonomy">Meta Taxonomy</label>
            <input 
              type="text" 
              id="metaTaxonomy" 
              name="metaTaxonomy" 
              class="form-control" 
              placeholder="Enter metadata taxonomy">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="button" id="upload-all" class="btn btn-primary">Upload All</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/basic.min.css">

<script>
 Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("#kt_modal_upload_dropzone", {
    url: "/api/upload-files",
    maxFilesize: 500, // 500MB
    acceptedFiles: "image/*,application/pdf,.zip,.rar,audio/mpeg,video/mp4",
    addRemoveLinks: true,
    autoProcessQueue: false,
    dictDefaultMessage: "Arraste os arquivos aqui ou clique para selecionar",
    dictRemoveFile: "Remover arquivo",
    dictCancelUpload: "Cancelar envio",
    paramName: 'uploadFile', // Nome do arquivo enviado
});

document.getElementById("upload-all").addEventListener("click", function () {
    var description = document.getElementById("description").value;
    var metaTaxonomy = document.getElementById("metaTaxonomy").value;

    var urlParams = new URLSearchParams(window.location.search);
    var dir = urlParams.get('dir');

    if (!description || !metaTaxonomy) {
        alert("Descrição e Meta Taxonomy são obrigatórios.");
        return;
    }

    myDropzone.on("sending", function (data, xhr, formData) {
        formData.append("description", description);
        formData.append("metaTaxonomy", metaTaxonomy);
        if (dir) {
            formData.append("dir", dir);
        }
    });

    myDropzone.processQueue();
});

myDropzone.on("error", function (file, message) {
    console.log("Erro no upload:", message);
});

myDropzone.on("queuecomplete", function () {
    var allFilesSuccess = myDropzone.getAcceptedFiles().every(function(file) {
        return file.status === Dropzone.SUCCESS;
    });

    if (allFilesSuccess) {
        var modalElement = document.getElementById('kt_modal_upload');
        var modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();

        modalElement.addEventListener('hidden.bs.modal', function () {
            location.reload();
        }, { once: true });
    }
});
</script>
