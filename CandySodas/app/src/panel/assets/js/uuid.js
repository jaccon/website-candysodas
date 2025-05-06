async function fetchUuid() {
  try {
      const response = await fetch('https://www.uuidgenerator.net/api/version1');
      if (!response.ok) {
          throw new Error('Erro ao buscar UUID');
      }
      const uuid = await response.text();
      document.getElementById('uuid').value = uuid;
      console.log(uuid);
  } catch (error) {
      console.error(error);
      alert('Erro ao obter UUID');
  }
}
window.onload = fetchUuid;