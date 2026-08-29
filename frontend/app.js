const form = document.getElementById("contact-form");
const statusElement = document.getElementById("status");

form.addEventListener("submit", async (event) => {
  event.preventDefault();
  statusElement.textContent = "Enviando...";

  const payload = new FormData(form);

  try {
    const response = await fetch("/api/", {
      method: "POST",
      body: payload
    });

    const data = await response.json();

    if (!response.ok) {
      throw new Error(data.message || "Não foi possível salvar a mensagem.");
    }

    statusElement.textContent = "Mensagem salva com sucesso.";
    form.reset();
  } catch (error) {
    statusElement.textContent = error.message;
  }
});
