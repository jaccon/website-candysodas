<?php 
   include(__DIR__ . '/../../config.inc.php'); 
   ?>
<!DOCTYPE html>
<html lang="en" >
   <head>
      <title> <?= PAGE_TITLE; ?>  </title>
      <meta charset="utf-8"/>
      <meta name="description" content="SGIX Content Management System, fast, secure"/>
      <meta name="keywords" content="SGIX CMS, SGIX Content Management System, Secure, Flexible"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <meta property="og:locale" content="en_US" />
      <meta property="og:type" content="article" />
      <meta property="og:title" content="SGIX CMS | Powerful CMS" />
      <meta property="og:url" content="https://www.sgix.com.br"/>
      <meta property="og:site_name" content="SGIX CMS | Powerful CMS" />
      <link rel="canonical" href="projects.html"/>
      <link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
      <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
      <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>

      <style>

        .calendar-container {
          padding: 40px;
        }
        .calendar-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: 10px;
        }

        .calendar-header h2 {
          margin: 0;
          font-size: 20px;
        }

        .btn {
          padding: 6px 12px;
          border: none;
          background-color: #007bff;
          color: white;
          border-radius: 5px;
          cursor: pointer;
        }

        .btn:hover {
          background-color: #0056b3;
        }

        .calendar-weekdays, .calendar-days {
          display: grid;
          grid-template-columns: repeat(7, 1fr);
          gap: 5px;
          text-align: center;
        }

        .calendar-weekdays div {
          font-weight: bold;
          padding-bottom: 5px;
          border-bottom: 1px solid #222;
        }

        .calendar-day {
          padding: 10px 0;
          border-radius: 5px;
          cursor: pointer;
          transition: background-color 0.2s;
        }

        .calendar-day.empty {
          background-color: transparent;
          cursor: default;
        }

        .calendar-day:hover:not(.empty) {
          background-color:rgb(110, 110, 110);
        }

        .calendar-day.selected {
          background-color: #007bff;
          color: white;
        }

        .navigation-buttons {
          margin-top: 10px;
          display: flex;
          justify-content: center;
        }
      </style>

   </head>
   <body  
      id="kt_body" 
      data-kt-app-header-stacked="true" 
      data-kt-app-header-primary-enabled="true" 
      data-kt-app-header-secondary-enabled="true" 
      data-kt-app-toolbar-enabled="true"  
      class="app-default" 
      >
      <script src="assets/js/sgix.js"></script>
      <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
      <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
         <div id="kt_app_header" class="app-header">
            <?php include($_SERVER['DOCUMENT_ROOT'] .'/panel/components/header/header.inc.php'); ?>
         </div>
         <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
            <div class="app-container  container-xxl d-flex flex-row flex-column-fluid ">
               <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                  <div class="d-flex flex-column flex-column-fluid">
                     <div id="kt_app_toolbar" class="app-toolbar  pt-lg-9 pt-6 ">
                        <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack flex-wrap ">
                           <div class="d-flex flex-stack flex-wrap gap-4 w-100">
                              <div class="page-title d-flex flex-column gap-3 me-3">
                                 <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bolder fs-2x my-0">
                                    Calendar
                                 </h1>
                                 <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                                    <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                       <a href="../index.html" class="text-gray-500 text-hover-primary">
                                       <i class="ki-duotone ki-home fs-3 text-gray-500 me-n1"></i>                                     
                                       </a>
                                    </li>
                                    <li class="breadcrumb-item"> 
                                       <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                    </li>
                                    <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                       Add-Ons                                           
                                    </li>
                                    <li class="breadcrumb-item"> 
                                       <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                    </li>
                                    <li class="breadcrumb-item text-gray-500">
                                       Calendar
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="kt_app_content" class="app-content  pb-0 " >
                        <?php include($_SERVER['DOCUMENT_ROOT'] .'/panel/components/my-account/resume.inc.php'); ?>
                        <div class="card mb-5 mb-xl-10">
                           <div class="card-header cursor-pointer">
                              <div class="card-title m-0">
                                 <h3 class="fw-bold m-0"> 
                                    <?php
                                       date_default_timezone_set('America/Sao_Paulo');
                                       echo date("l, d F Y ––  H:i:s"); 
                                       ?>
                                 </h3>
                              </div>
                              <button 
                                 class="btn btn-sm btn-primary align-self-center" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#add-calendar">
                              Adicionar Evento
                              </button>
                           </div>

                          <!--  Calendar -->
                           <div class="calendar-container">
                              <div class="calendar-header">
                                <button class="btn" id="prevMonthBtn">&lt;</button>
                                <h2 id="monthYearLabel">Mês Ano</h2>
                                <button class="btn" id="nextMonthBtn">&gt;</button>
                              </div>

                              <div class="calendar-weekdays">
                                <div>Dom</div>
                                <div>Seg</div>
                                <div>Ter</div>
                                <div>Qua</div>
                                <div>Qui</div>
                                <div>Sex</div>
                                <div>Sáb</div>
                              </div>

                              <div class="calendar-days" id="calendarDays"></div>
                              <div class="navigation-buttons">
                                <button class="btn" id="todayBtn">Hoje</button>
                              </div>
                              
                            </div>
                            <!--  // Calendar -->

                           <div id="kt_account_settings_profile_details" class="collapse show">
                              <div class="card-body border-top p-9">
                                 <div id="calendar-events-list"></div>
                              </div>
                           </div>
                           
                        </div>
                     </div>
                     <?php include($_SERVER['DOCUMENT_ROOT'] .'/panel/components/footer/footer.inc.php'); ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php include($_SERVER['DOCUMENT_ROOT'] .'/panel/components/customize/container.inc.php'); ?>
      <?php include($_SERVER['DOCUMENT_ROOT'] .'/panel/components/customize/button.inc.php'); ?>
      <?php include($_SERVER['DOCUMENT_ROOT'] .'/panel/components/floatButtons/float.inc.php'); ?>

      <div class="modal bg-body fade" tabindex="-1" id="add-calendar">
         <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
               <div class="modal-header">
                  <h5 class="modal-title">
                     Adicionar Evento no Calendário                
                  </h5>
                  <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                     <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                  </div>
               </div>
               <div class="modal-body">
                     <div class="card-body p-9">
                        <div class="row mb-6">
                           <label class="col-lg-4 col-form-label fw-semibold fs-6">
                           <span class="required"> Título  </span>
                           <span class="ms-1"  data-bs-toggle="tooltip" title="Descreva o nome do espaço que desejar adicionar" >
                           <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span>
                           <span class="path2"></span><span class="path3"></span></i></span>
                           </label>
                           <div class="col-lg-8 fv-row">
                                <input id="swal-title" 
                                  class="form-control form-control-lg form-control-solid"
                                  placeholder="Título do Evento" 
                                  required
                                />
                           </div>
                        </div>
                        <div class="row mb-6">
                           <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Data do evento </label>
                           <div class="col-lg-8">
                              <div class="row">
                                 <div class="col-lg-12 fv-row">
                                       <input 
                                        id="swal-date" 
                                        type="date" 
                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                        required
                                        />
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="row mb-6">
                           <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Horário do evento </label>
                           <div class="col-lg-8 fv-row">
                              <input 
                                id="swal-time" 
                                type="time" 
                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                required
                              />
                           </div>
                        </div>

                        <div class="row mb-6">
                           <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Descrição do evento </label>
                           <div class="col-lg-8 fv-row">
                              <textarea 
                                id="swal-message" 
                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                placeholder="Descrição da tarefa" 
                                required></textarea>
                           </div>
                        </div>

                        <input type="hidden" id="customerId" name="customerId" value="9b636e3e-bfc1-11ef-9cd2-0242ac120002">
                     </div>
                     <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <span class="btn btn-primary" id="space-submit"> 
                          Salvar Alterações 
                        </span>
                     </div>
               </div>
            </div>
         </div>
      </div>
      
      <script src="assets/plugins/global/plugins.bundle.js"></script>
      <script src="assets/js/scripts.bundle.js"></script>
      <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
      <script src="assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
      <script src="assets/js/widgets.bundle.js"></script>
      <script src="assets/js/custom/apps/chat/chat.js"></script>
      <script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
      <script src="assets/js/custom/utilities/modals/create-app.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/type.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/budget.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/settings.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/team.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/targets.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/files.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/complete.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/main.js"></script>
      <script src="assets/js/custom/utilities/modals/new-address.js"></script>
      <script src="assets/js/custom/utilities/modals/users-search.js"></script>


      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      
      <script>
          document.addEventListener("DOMContentLoaded", function () {
          document.getElementById("space-submit").addEventListener("click", function () {
            const title = document.getElementById("swal-title").value.trim();
            const date = document.getElementById("swal-date").value;
            const time = document.getElementById("swal-time").value;
            const message = document.getElementById("swal-message").value.trim();
            const customerId = document.getElementById("customerId").value;

            if (!title || !date || !time || !message) {
              Swal.fire({
                icon: "warning",
                title: "Atenção",
                text: "Preencha todos os campos obrigatórios."
              });
              return;
            }

            const data = {
              title: title,
              datetime: `${date}T${time}`,
              message: message,
              customerId: customerId,
              createdAt: new Date().toISOString(),
              eventType: "calendar"
            };

            fetch("/panel/calendar/calendar-save.html", {
              method: "POST",
              headers: {
                "Content-Type": "application/json"
              },
              body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
              if (result.success) {
                Swal.fire({
                  icon: "success",
                  title: "Evento salvo!",
                  text: "Seu evento foi adicionado com sucesso."
                }).then(() => {
                  const modal = bootstrap.Modal.getInstance(document.getElementById("add-calendar"));
                  if (modal) modal.hide();

                  const dateOnly = date; 
                  const url = `/panel/calendar/calendar-list.html?date=${dateOnly}`;
                });
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Erro",
                  text: result.message || "Não foi possível salvar o evento. Tente novamente."
                });
              }
            })
            .catch(error => {
              console.error("Erro:", error);
              Swal.fire({
                icon: "error",
                title: "Erro",
                text: "Ocorreu um erro inesperado ao salvar o evento."
              });
            });
          });

          // Load existing events
          const target = document.getElementById("calendar-events-list");

          if (target) {
            fetch("/panel/calendar/calendar-list.html?date=")
              .then(response => {
                if (!response.ok) {
                  throw new Error("Erro ao carregar eventos");
                }
                return response.text();
              })
              .then(html => {
                target.innerHTML = html;
              })
              .catch(error => {
                target.innerHTML = `<div class="alert alert-danger">Erro ao carregar lista de eventos: ${error.message}</div>`;
            });
          }
        });
      </script>
      <script>
        let currentDate = new Date();
        let selectedDate = null;

        const monthYearLabel = document.getElementById('monthYearLabel');
        const calendarDays = document.getElementById('calendarDays');
        const prevMonthBtn = document.getElementById('prevMonthBtn');
        const nextMonthBtn = document.getElementById('nextMonthBtn');
        const todayBtn = document.getElementById('todayBtn');
        const target = document.getElementById("calendar-events-list");

        // Função para renderizar o calendário
        function renderCalendar() {
          const year = currentDate.getFullYear();
          const month = currentDate.getMonth();
          const firstDay = new Date(year, month, 1);
          const lastDay = new Date(year, month + 1, 0);
          const numDays = lastDay.getDate();
          const firstDayOfWeek = firstDay.getDay();

          monthYearLabel.textContent = `${getMonthName(month)} ${year}`;
          calendarDays.innerHTML = '';

          for (let i = 0; i < firstDayOfWeek; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('calendar-day', 'empty');
            calendarDays.appendChild(emptyCell);
          }

          for (let day = 1; day <= numDays; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('calendar-day');
            dayCell.textContent = day;
            dayCell.onclick = () => selectDay(day);
            calendarDays.appendChild(dayCell);
          }
        }

        // Função para obter o nome do mês
        function getMonthName(monthIndex) {
          const months = [
            "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
            "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
          ];
          return months[monthIndex];
        }

        // Função para selecionar um dia
        function selectDay(day) {
          const year = currentDate.getFullYear();
          const month = currentDate.getMonth() + 1; // Adiciona 1 pois o mês é zero-indexado
          const dayStr = day < 10 ? '0' + day : day; // Garante que o dia tenha dois dígitos
          const dateStr = `${year}-${month < 10 ? '0' + month : month}-${dayStr}`;
          selectedDate = new Date(dateStr);

          // Carregar os eventos para a data selecionada
          loadEventsForDate(selectedDate);

          highlightSelectedDay(day);
        }

        // Função para destacar o dia selecionado
        function highlightSelectedDay(day) {
          const allDays = document.querySelectorAll('.calendar-day');
          allDays.forEach(cell => cell.classList.remove('selected'));
          const selectedDayCell = Array.from(allDays).find(cell => cell.textContent == day);
          if (selectedDayCell) selectedDayCell.classList.add('selected');
        }

        function loadEventsForDate(date) {
          const target = document.getElementById("calendar-events-list");

          const dateToFetch = date || new Date(); 

          const dateStr = dateToFetch.toISOString().split('T')[0]; // Formata a data no formato YYYY-MM-DD

            // 
            fetch(`/panel/calendar/calendar-list.html?date=${dateStr}`)
                .then(response => {
                  if (!response.ok) {
                    throw new Error("Erro ao carregar eventos");
                  }
                  return response.text();
                })
                .then(html => {
                  target.innerHTML = html;
                })
                .catch(error => {
                  target.innerHTML = `<div class="alert alert-danger">Erro ao carregar lista de eventos: ${error.message}</div>`;
              });
            // 
        }

        // Navegação entre meses
        prevMonthBtn.addEventListener('click', () => {
          currentDate.setMonth(currentDate.getMonth() - 1);
          renderCalendar();
          loadEventsForDate(null); // Carrega eventos para o dia de hoje ao mudar o mês
        });

        nextMonthBtn.addEventListener('click', () => {
          currentDate.setMonth(currentDate.getMonth() + 1);
          renderCalendar();
          loadEventsForDate(null); // Carrega eventos para o dia de hoje ao mudar o mês
        });

        // Botão Hoje
        todayBtn.addEventListener('click', () => {
          currentDate = new Date();
          renderCalendar();
          loadEventsForDate(null); // Carrega eventos para o dia de hoje ao clicar em "Hoje"
        });

        // Inicializa o calendário e carrega eventos para o dia de hoje
        renderCalendar();
        loadEventsForDate(null); // Carrega eventos para o dia de hoje inicialmente
      </script>

      <script>
      document.addEventListener('click', function(event) {
        if (event.target && event.target.matches('.delete-btn')) {
          const eventId = event.target.dataset.id;
          console.log('ID do evento:', eventId);

          fetch(`/panel/calendar/calendar-delete.html?id=${eventId}`, {
            method: 'DELETE',
          })
          .then(response => response.json())
          .then(data => {
            console.log('Evento excluído:', data);
            if (data.success || data.status === 'ok') {
              location.reload(); // Recarrega a página ao excluir com sucesso
            } else {
              alert('Não foi possível excluir o evento.');
            }
          })
          .catch(error => {
            console.error('Erro ao excluir evento:', error);
            alert('Erro ao excluir evento.');
          });
        }
      });
      </script>

      <script>
       document.addEventListener('click', function(event) {
    if (event.target && event.target.matches('.form-check-input')) {
        const eventId = event.target.dataset.id;
        const status = event.target.checked ? 'done' : 'pending';  // Define o status com base no checkbox

        fetch('/panel/calendar/calendar-update-status.html', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: eventId,
                status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mostrar SweetAlert com sucesso
                Swal.fire({
                    title: 'Sucesso',
                    text: data.success,
                    icon: 'success'
                });
            } else {
                // Exibir erro se houver
                Swal.fire({
                    title: 'Erro',
                    text: data.error || 'Erro desconhecido.',
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            Swal.fire({
                title: 'Erro',
                text: 'Ocorreu um erro ao atualizar o status.',
                icon: 'error'
            });
        });
    }
});
      </script>



   </body>
</html>