<?php 
global $CONFIG;
?>
<div class="modal bg-body fade" tabindex="-1" id="kt_modal_3">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h5 class="modal-title">
                  Add New Task
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
                            <span class="required"> Name </span>
                            <span class="ms-1"  data-bs-toggle="tooltip" title="<?= MYACCOUNT_08; ?>" >
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
                                          
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Space </label>
                            
                            <div class="col-lg-8 fv-row">

                                <?php $customers = helperSpaces::getSpaceList($projectId); ?>

                                <select 
                                name="spaceId" 
                                id="spaceId" 
                                data-placeholder="Choose a space..." 
                                class="form-select form-select-solid form-select-lg"
                                >
                                <option value=""> 
                                    Escolha o espaço 
                                </option>
                                <?php foreach ($customers as $customer): ?>
                                    <option value="<?= htmlspecialchars($customer['uuid']); ?>">  
                                        <?= htmlspecialchars($customer['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                                </select>
                                
                                <div class="form-text">
                                    Choose a Space to related task
                                </div>
                            </div>
                                                        
                        </div>
                        
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required"> Space Deadline  </span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input 
                                type="date" 
                                name="spaceDeadline" 
                                class="form-control form-control-lg form-control-solid" 
                                placeholder="Space deadline to delivery" 
                            />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Priority </label>
                            <div class="col-lg-8 fv-row">
                                <select 
                                name="priority" 
                                data-placeholder="Select payment method..." 
                                class="form-select form-select-solid form-select-lg"
                                >
                                <option value="high"> High </option>
                                <option value="medium"> Medium </option>
                                <option value="low"> Low </option>
                                <option value="urgent"> Urgent </option>
                                <option value="critical"> Critical </option>
                                </select>
                                <div class="form-text">
                                    The space priority in project
                                </div>
                            </div>
                        </div>

                        <div class="row mb-6">
                                          
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Supplier </label>
                            
                            <div class="col-lg-8 fv-row">

                                <?php $customers = helperCustomers::getEnabledSupplier($customersFile); ?>

                                <select 
                                name="supplierId" 
                                
                                data-placeholder="Choose a project supplier..." 
                                class="form-select form-select-solid form-select-lg"
                                >
                                <option value=""> 
                                    Escolha o fornecedor
                                </option>
                                <?php foreach ($customers as $customer): ?>
                                    <option value="<?= htmlspecialchars($customer['id']); ?>" <?= CMS::isSelected($customer['id'], $currentLanguage); ?>> 
                                        <?= htmlspecialchars($customer['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                                </select>
                                
                                <div class="form-text">
                                Choose the customer
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
                                <option value="onhold"> On Hold </option>
                                <option value="working"> Working </option>
                                <option value="cancelled"> Cancelled </option>
                                <option value="done"> Done </option>
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
                        <span class="btn btn-primary" id="task-submit"> 
                            <?= BUTTON_SUBMIT_01; ?> 
                        </span>
                    </div>

                    </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("task-submit").addEventListener("click", function (event) {
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
            const form = document.querySelector("#kt_modal_3 form");
            const formData = new FormData(form);

            const data = {
                name: formData.get('name'),
                description: formData.get('description'),
                spaceDeadline: formData.get('spaceDeadline'),
                spaceId: formData.get('spaceId'),
                supplierId: formData.get('supplierId'),
                priority: formData.get('priority'),
                status: formData.get('status'),
                id: uuid.trim(),
                projectId: formData.get('projectId'),
            };

            return fetch("<?= htmlspecialchars($CONFIG['CONF']['siteUrl']); ?>/api/space-task-add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data), 
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
            alert("Space Task added successfully!");
            console.log("Response:", data);
            location.reload();
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("There was an error while saving the space.");
        });
});
</script>
