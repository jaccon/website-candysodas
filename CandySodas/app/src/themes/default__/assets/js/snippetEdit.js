(function () {
  function loadHTML(url, callback) {
      const xhr = new XMLHttpRequest();
      xhr.open('GET', url, true);
      xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
              callback(xhr.responseText);
          }
      };
      xhr.send();
  }

  // Carregar o HTML e CSS do snippet.html
  loadHTML('/helpers/snippets/snippet.html', function (htmlContent) {
      document.body.innerHTML += htmlContent;

      // Pegando referências
      const editButton = document.getElementById('editButton');
      const editPanel = document.getElementById('editPanel');

      // Toggle para abrir/fechar o painel
      let isOpen = false;
      editButton.addEventListener('click', function () {
          if (isOpen) {
              editPanel.style.left = '-300px'; // Fecha
          } else {
              editPanel.style.left = '0'; // Abre
          }
          isOpen = !isOpen;
      });
  });
})();
