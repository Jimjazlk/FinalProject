document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    form.addEventListener("submit", function (event) {
        let isValid = true;
        const fields = ["nombre", "correo", "asunto", "comentario"];
        
        fields.forEach(function (field) {
            const input = document.getElementById(field);
            const feedback = input.nextElementSibling;
            if (input.value.trim() === "") {
                feedback.classList.remove("d-none");
                feedback.style.display = "block";
                input.classList.add("is-invalid");
                isValid = false;
            } else {
                feedback.classList.add("d-none");
                feedback.style.display = "none";
                input.classList.remove("is-invalid");
            }
        });
        
        if (!isValid) {
            event.preventDefault();
        }
    });
});