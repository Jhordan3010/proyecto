function enviarValor() {
  var valor = document.getElementById('username').value;
  localStorage.setItem('valorCompartido', valor);
  window.location.href = 'perfil-postulante.php';
}