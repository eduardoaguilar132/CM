const canvas = document.getElementById("canvasFirma");
const ctx = canvas.getContext("2d");
let dibujando = false;

function obtenerPosicion(evento) {
  const rect = canvas.getBoundingClientRect();
  if (evento.touches) {
    return {
      x: evento.touches[0].clientX - rect.left,
      y: evento.touches[0].clientY - rect.top
    };
  } else {
    return {
      x: evento.clientX - rect.left,
      y: evento.clientY - rect.top
    };
  }
}

// Eventos para PC
canvas.addEventListener("mousedown", e => {
  dibujando = true;
  const pos = obtenerPosicion(e);
  ctx.beginPath();
  ctx.moveTo(pos.x, pos.y);
});

canvas.addEventListener("mousemove", e => {
  if (!dibujando) return;
  const pos = obtenerPosicion(e);
  ctx.lineTo(pos.x, pos.y);
  ctx.stroke();
  ctx.beginPath();
  ctx.moveTo(pos.x, pos.y);
});

canvas.addEventListener("mouseup", () => {
  dibujando = false;
  ctx.beginPath();
});

// Eventos para móviles
canvas.addEventListener("touchstart", e => {
  e.preventDefault();
  dibujando = true;
  const pos = obtenerPosicion(e);
  ctx.beginPath();
  ctx.moveTo(pos.x, pos.y);
});

canvas.addEventListener("touchmove", e => {
  e.preventDefault();
  if (!dibujando) return;
  const pos = obtenerPosicion(e);
  ctx.lineTo(pos.x, pos.y);
  ctx.stroke();
  ctx.beginPath();
  ctx.moveTo(pos.x, pos.y);
});

canvas.addEventListener("touchend", e => {
  dibujando = false;
  ctx.beginPath();
});

// Botón para limpiar
function limpiarCanvas() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
}

// Guardar firma en input oculto
document.getElementById("formFirma").addEventListener("submit", function(e) {
  const dataURL = canvas.toDataURL();
  document.getElementById("firmaInput").value = dataURL;
});
