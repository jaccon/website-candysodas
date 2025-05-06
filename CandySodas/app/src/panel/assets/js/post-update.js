
$(document).ready(function() {
  $('#content').summernote({
    height: 300,
    toolbar: [
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['para', ['ul', 'ol']],
      ['insert', ['link', 'picture', 'video']],
      ['view', ['fullscreen', 'codeview']]
    ]
  });
});

const urlParams = new URLSearchParams(window.location.search);

if (urlParams.has('success')) {
    Swal.fire({
        title: 'Success!',
        text: 'Your data has been saved successfully.',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        const url = new URL(window.location);
        url.searchParams.delete('success');
        window.history.replaceState({}, document.title, url);
        location.reload();
    });
}

document.getElementById('title').addEventListener('input', (e) => {
  const gTitle = document.getElementById('gTitle');
  gTitle.textContent = e.target.value.trim() || 'Add new post';
});

function updateCategoryString() {
  const select = document.getElementById('categories');
  const selectedOptions = Array.from(select.selectedOptions);
  const selectedValues = selectedOptions.map(option => option.value);
  const categoriesString = selectedValues.join('|'); 
  document.getElementById('categories-string').value = categoriesString;
  console.log('Categorias selecionadas:', selectedValues);
}

document.getElementById('title').addEventListener('input', (e) => {
      const gTitle = document.getElementById('gTitle');
      const permLink = document.getElementById('permLink');
      const inputPermLink = document.getElementById('inputPermLink');
      const inputValue = e.target.value.trim();
      gTitle.textContent = inputValue || 'Update Post';

      const formattedPermlink = inputValue
          .toLowerCase() // Converte para minúsculas
          .normalize('NFD') // Remove acentos
          .replace(/[\u0300-\u036f]/g, '') // Remove diacríticos
          .replace(/[^a-z0-9\s-]/g, '') // Remove caracteres especiais
          .replace(/\s+/g, '-') // Substitui espaços por hífens
          .replace(/-+/g, '-') // Remove hífens consecutivos
          .replace(/^-+|-+$/g, ''); // Remove hífens no início e no fim

      permLink.textContent = formattedPermlink || 'new-post';
      inputPermLink.value = formattedPermlink || 'new-post';
});

document.addEventListener('DOMContentLoaded', () => {
  const statusSelect = document.getElementById('status');
  const scheduleDiv = document.getElementById('dateSchedule');

  statusSelect.addEventListener('change', () => {
    if (statusSelect.value === 'scheduled') {
      scheduleDiv.classList.remove('d-none');
    } else {
      scheduleDiv.classList.add('d-none');
    }
  });
});