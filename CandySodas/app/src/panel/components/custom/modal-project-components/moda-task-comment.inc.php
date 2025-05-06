<?php 
global $CONFIG;
?>
<div class="modal bg-body fade" tabindex="-1" id="kt_modal_3">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h5 class="modal-title">Add New Comment</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <form class="mx-auto w-100 mw-600px pt-15 pb-10" novalidate="novalidate" id="kt_modal_create_project_form" enctype="multipart/form-data">
                    <div>
                        <div class="w-100">
                            <div class="fv-row mb-8">
                                <h1 class="fw-bold text-gray-900">Comentário</h1>
                                <textarea class="form-control form-control-solid" rows="3" placeholder="Comment here..." name="comment" id="comment"></textarea>
                                <input type="hidden" name="taskId" value="<?= htmlspecialchars($_GET['id']); ?>">
                                <input type="hidden" name="projectId" value="<?= htmlspecialchars($_GET['projectId']); ?>">
                            </div>
                          
                            <div class="fv-row mb-8">
                                <h1 class="fw-bold text-gray-900">Upload de arquivo</h1>
                                <input type="file" name="files[]" id="files" class="form-control" multiple>
                                <span class="text-muted fs-6">Imagens permitidas: JPG, PNG com tamanho de até 2MB.</span>
                                <div class="progress mt-3">
                                    <div id="upload-progress" class="progress-bar bg-primary" style="width: 0%;"></div>
                                </div>
                            </div>

                            <div class="d-flex flex-stack">
                                <button type="button" id="task-submit" class="btn btn-lg btn-primary">Publish Comment</button>
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

            return fetch("<?= htmlspecialchars($CONFIG['CONF']['siteUrl']); ?>/api/space-task-new-comment", {
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
                title: 'Comentário enviado com sucesso!',
                text: 'Seu comentário foi publicado.',
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
