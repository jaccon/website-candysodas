<?php 
global $CONFIG;
?>
<div class="modal bg-body fade" tabindex="-1" id="kt_modal_2">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h5 class="modal-title">
                   <?= PVIEW_SPACE_TXT1; ?>
                </h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <form 
                    method="POST" 
                    enctype="multipart/form-data" 
                    action="?success=true">
                                    
                    <div class="card-body p-9">
                        
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                            <span class="required"> <?= PVIEW_FORM_NAME; ?>  </span>
                            <span class="ms-1"  data-bs-toggle="tooltip" title="<?= PVIEW_FORM_NAME_LABEL; ?>" >
                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span>
                            <span class="path2"></span><span class="path3"></span></i></span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input 
                                type="text" 
                                name="name" 
                                class="form-control form-control-lg form-control-solid" 
                                placeholder="Space name" 
                                />
                            </div>
                        </div>
                        
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6"> <?= PRJ_ADD_05; ?> </label>
                            <div class="col-lg-8">
                                <div class="row">
                                <div class="col-lg-12 fv-row">
                                    <input 
                                    type="text" 
                                    name="description" 
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                    placeholder="<?= PRJ_ADD_05; ?>" 
                                    />
                                </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required"> <?= PVIEW_SPACE_TB_3; ?>  </span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input 
                                type="date" 
                                name="spaceDeadline" 
                                class="form-control form-control-lg form-control-solid" 
                                placeholder="<?= PVIEW_SPACE_TB_3; ?>" 
                            />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6"> <?= PVIEW_SPACE_TB_2; ?> </label>
                            <div class="col-lg-8 fv-row">
                                <select 
                                name="priority" 
                                data-placeholder="<?= PVIEW_SPACE_TB_2; ?>..." 
                                class="form-select form-select-solid form-select-lg"
                                >
                                <option value="high"> <?= PVIEW_FORM_PRIORITY_1; ?> </option>
                                <option value="medium"> <?= PVIEW_FORM_PRIORITY_2; ?> </option>
                                <option value="low"> <?= PVIEW_FORM_PRIORITY_3; ?> </option>
                                <option value="urgent"> <?= PVIEW_FORM_PRIORITY_4; ?> </option>
                                <option value="critical"> <?= PVIEW_FORM_PRIORITY_5; ?> </option>
                                </select>
                                <div class="form-text">
                                    <?= PVIEW_FORM_PRIORITY_TXT; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Status </label>
                            <div class="col-lg-8 fv-row">
                                <select 
                                    name="status" 
                                    data-placeholder="Select status..." 
                                    class="form-select form-select-solid form-select-lg"
                                >
                                <option value="working"> <?= PRJ_STATUS_01; ?> </option>
                                <option value="cancelled"> <?= PRJ_STATUS_02; ?> </option>
                                <option value="done"> <?= PRJ_STATUS_03; ?> </option>
                                <option value="onhold"> <?= PRJ_STATUS_04; ?> </option>
                                </select>
                                <div class="form-text">
                                    The space status in project
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="projectId" name="projectId" value="<?= $projectId; ?>">
                        <input type="hidden" id="customerId" name="customerId" value="<?= $projectData['customerId']; ?>">
                        
                    </div>
                                    
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <span class="btn btn-primary" id="space-submit"> 
                            <?= BUTTON_SUBMIT_01; ?> 
                        </span>
                    </div>

                    </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("space-submit").addEventListener("click", function (event) {
    event.preventDefault();
    fetch("https://www.uuidgenerator.net/api/version1")
        .then((response) => {
            if (response.ok) {
                return response.text(); 
            } else {
                throw new Error("Erro ao gerar UUID.");
            }
        })
        .then((uuid) => {
            const form = document.querySelector("#kt_modal_2 form");
            const formData = new FormData(form);

            // Crie um objeto com os dados do formulário
            const data = {
                name: formData.get('name'),
                description: formData.get('description'),
                spaceDeadline: formData.get('spaceDeadline'),
                priority: formData.get('priority'),
                status: formData.get('status'),
                uuid: uuid.trim(),
                projectId: formData.get('projectId'),
            };

            // Envie a requisição POST com o JSON
            return fetch("<?= htmlspecialchars($CONFIG['CONF']['siteUrl']); ?>/api/space-add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data), // Envia os dados como JSON
            });
        })
        .then((response) => {
            if (response.ok) {
                return response.json(); // Espera um JSON como resposta
            } else {
                throw new Error("Erro ao enviar os dados.");
            }
        })
        .then((data) => {
            alert("Space added successfully!");
            console.log("Response:", data);
            location.reload(); // Recarrega a página
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("There was an error while saving the space.");
        });
});
</script>
