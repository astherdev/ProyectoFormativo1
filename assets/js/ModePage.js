document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.getElementById("toggle");
  const body = document.body;

  if (localStorage.getItem("modo") === "oscuro") {
    body.classList.add("dark");
    if (toggle) toggle.checked = true;
  }

  if (toggle) {
    toggle.addEventListener("change", () => {
      if (toggle.checked) {
        body.classList.add("dark");
        localStorage.setItem("modo", "oscuro");
      } else {
        body.classList.remove("dark");
        localStorage.setItem("modo", "claro");
      }
    });
  }
});
