<?php 
    global $CONFIG;
    $components = Cms::getComponents();
?>
<div class="modal bg-body fade" tabindex="-1" id="kt_modal_metadata">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h5 class="modal-title">Add New Metadata</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <form class="mx-auto w-100 mw-600px pt-15 pb-10" novalidate="novalidate" id="kt_modal_create_project_form" enctype="multipart/form-data">
                    <div>
                        <div class="w-100">

                            <div class="mb-6 fv-row">
                                <h4 class="fw-bold text-gray-900"> Title </h4>
                                <input 
                                  type="text" 
                                  name="title" 
                                  class="form-control mb-2" 
                                  placeholder="Publication title" 
                                  id="title"
                                  required
                                />
                                <div class="text-muted fs-7"> Metadata title text </div>
                            </div>

                            <div class="mb-6 fv-row">
                                <h4 class="fw-bold text-gray-900"> Description </h4>
                                <input 
                                  type="text" 
                                  name="description" 
                                  class="form-control mb-2" 
                                  placeholder="Description metadata" 
                                  id="description"
                                  required
                                />
                                <div class="text-muted fs-7"> describe your metadata ... </div>
                            </div>
                            

                            <div class="fv-row mb-6">
                                <h4 class="fw-bold text-gray-900"> Content </h4>
                                <textarea class="form-control form-control-solid" rows="3" placeholder="Comment here..." name="content" id="content" required></textarea>
                                <input type="hidden" name="pubId" value="<?= htmlspecialchars($_GET['id']); ?>">
                                <input type="hidden" name="metaOrigin" value="<?= $metaOrigin; ?>">
                                <input type="hidden" name="component" value="<?= $registerId; ?>">
                            </div>

                            <div class="mb-6 fv-row">
                                <h4 class="fw-bold text-gray-900"> Metadata Type </h4>
                                <select 
                                    name="metadataType" 
                                    id="metadataType"
                                    required
                                    data-placeholder="Select Metadata Type" 
                                    class="form-select form-select-solid form-select-lg"
                                >
                                    <option value="">  Select a category father if exists </option>
                                    <option value="image">  Image </option>
                                    <option value="featuredImage">  Image Featured ( Image High Light ) </option>
                                    <option value="files">  Files </option>
                                    <option value="gallery">  Image Gallery </option>
                                    <option value="video">  Video Embedded </option>
                                    <option value="text">  Simple Text </option>
                                </select>
                                <div class="text-muted fs-7"> Metadata title text </div>
                            </div>

                            <div class="mb-10 fv-row">
                                <h4 class="fw-bold text-gray-900"> Status </h4>
                                <select 
                                    name="status" 
                                    id="status"
                                    required
                                    data-placeholder="Select Metadata Status" 
                                    class="form-select form-select-solid form-select-lg"
                                >
                                    <option value="">  Select a status </option>
                                    <option value="enabled">  Enabled </option>
                                    <option value="disabled">  Disabled </option>
                                </select>
                                <div class="text-muted fs-7"> Metadata status  </div>
                            </div>
                          
                            <div class="fv-row mb-8">
                                <h4 class="fw-bold text-gray-900">Upload de arquivo</h4>
                                <input type="file" name="files[]" id="files" class="form-control" multiple>
                                <span class="text-muted fs-6">Imagens permitidas: JPG, PNG com tamanho de até 2MB.</span>
                                <div class="progress mt-3">
                                    <div id="upload-progress" class="progress-bar bg-primary" style="width: 0%;"></div>
                                </div>
                            </div>

                            <div class="d-flex flex-stack">
                                <button type="button" id="task-submit" class="btn btn-lg btn-primary"> Save Metadata</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("task-submit").addEventListener("click", function (event) {
    event.preventDefault();

    const form = document.querySelector("#kt_modal_create_project_form");
    const formData = new FormData(form);
    const progressBar = document.getElementById("upload-progress");

    fetch("https://www.uuidgenerator.net/api/version1")
        .then((response) => response.text())
        .then((uuid) => {
            formData.append("id", uuid.trim());

            console.log(uuid.trim());

            return fetch("<?= htmlspecialchars($CONFIG['CONF']['siteUrl']); ?>/api/add-metadata", {
                method: "POST",
                body: formData,
                headers: {
                    'X-Request-ID': uuid.trim()
                },
                onprogress: function(event) {
                    if (event.lengthComputable) {
                        const percent = Math.round((event.loaded / event.total) * 100);
                        progressBar.style.width = percent + '%';
                        progressBar.innerText = percent + '%';
                    }
                }
            });
        })
        .then((response) => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error("Erro ao enviar os dados.");
            }
        })
        .then((data) => {
            Swal.fire({
                icon: 'success',
                title: 'Sucess to save a new metadata!',
                text: 'Sucess to save a new metadata!',
                confirmButtonText: 'Ok'
            }).then(() => {
                location.reload();
            });
        })
        .catch((error) => {
            console.error("Erro:", error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Houve um problema ao enviar o comentário.',
                confirmButtonText: 'Fechar'
            });
        });
});
</script>
