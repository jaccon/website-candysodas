<div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered mw-900px">
      <div class="modal-content">
         <div class="modal-header">
            <h2> <?= UPDATE_PASS_COMP_TITLE; ?> </h2>
            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
               <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>                
            </div>
         </div>
         <div class="modal-body py-lg-12 px-lg-12">

          <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-semibold fs-6"> <?= UPDATE_PASS_COMP_TXT1; ?> </label>
              <div class="col-lg-8">
                  <div class="row">
                    <div class="col-lg-12 fv-row">
                        <input 
                        type="password" 
                        name="currentPassword" 
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                        placeholder="<?= UPDATE_PASS_COMP_TXT1; ?>" 
                        />
                    </div>
                  </div>
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6"> <?= UPDATE_PASS_COMP_TXT2; ?> </label>
                <div class="col-lg-8">
                    <div class="row">
                      <div class="col-lg-12 fv-row">
                          <input 
                            type="password" 
                            name="password" 
                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                            placeholder="<?= UPDATE_PASS_COMP_TXT2; ?>" 
                          />
                      </div>
                    </div>
                  </div>
            </div>
            <div class="row mb-6">
                <div class="col-lg-12">
                    <button 
                      class="btn btn-primary"> 
                      <?= UPDATE_PASS_BTN; ?> 
                    </button>
                  </div>
              </div>
            </div>
      </div>
   </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const button = document.querySelector("#kt_modal_create_app .btn-primary");
    button.addEventListener("click", async (e) => {
        e.preventDefault();

        const currentPassword = document.querySelector("input[name='currentPassword']").value.trim();
        const newPassword = document.querySelector("input[name='password']").value.trim();

        if (!currentPassword || !newPassword) {
            alert("Preencha todos os campos.");
            return;
        }

        try {
            const res = await fetch("/api/password-update", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ currentPassword, password: newPassword })
            });

            if (res.ok) {
                alert("Senha atualizada!");
                bootstrap.Modal.getInstance(document.querySelector("#kt_modal_create_app")).hide();
            } else {
                const errorData = await res.json();
                alert(errorData.message || "Erro ao atualizar.");
            }
        } catch (err) {
            alert("Erro ao processar.");
        }
    });
});
</script>

