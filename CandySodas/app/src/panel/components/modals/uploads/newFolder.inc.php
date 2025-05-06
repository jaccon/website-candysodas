<div class="modal fade" id="kt_modal_newfolder" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content">
      <form class="form" id="kt_modal_newfolder_form">
        <div class="modal-header">
          <h2 class="fw-bold">New Folder</h2>
          <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
          </div>
        </div>
        <div class="modal-body pt-10 pb-15 px-lg-17">
          <div class="form-group mt-4">
            <label for="metaTaxonomy">Folder Name</label>
            <input 
              type="text" 
              id="folderName" 
              name="folderName" 
              class="form-control" 
              placeholder="Enter folder name">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="button" id="create-folder" class="btn btn-primary">Create a Folder</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.getElementById("create-folder").addEventListener("click", function () {
    var folderName = document.getElementById("folderName").value.trim();

    if (!folderName) {
        alert("O nome da pasta é obrigatório.");
        return;
    }

    fetch("/api/upload-new-folder", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ folderName: folderName }),
    })
    .then(response => {
        if (response.status === 200) {
            return response.json();
        } else {
            throw new Error("Erro ao criar pasta. Código: " + response.status);
        }
    })
    .then(data => {
        alert("Pasta criada com sucesso!");
        location.reload();
    })
    .catch(error => {
        alert("Erro na requisição: " + error.message);
    });
});
</script>