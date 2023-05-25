document.addEventListener("DOMContentLoaded", function() {
    var unidadeCreate = document.getElementById("unidade");
    var addon = document.getElementById("addon");
    var quantidadeCreate = document.getElementById("quantidade");
    var perecivelCreate = document.getElementById("perecivel");
    var divValidade = document.getElementById("div_validade");
    var dataValidadeCreate = document.getElementById("data_validade");
    var productForm = document.getElementById("product_form");

    unidadeCreate.addEventListener("change", function(event) {
        var unidade = this.value;
        if (unidade) {
            addon.classList.remove("d-none");
            switch (unidade) {
                case "unidade":
                    quantidadeCreate.step = "1";
                    addon.innerHTML = "un";
                    break;
                case "litro":
                    quantidadeCreate.step = "0.001";
                    addon.innerHTML = "lt";
                    break;
                case "quilograma":
                    quantidadeCreate.step = "0.001";
                    addon.innerHTML = "kg";
                    break;
                default:
                    quantidadeCreate.step = "1";
                    addon.classList.add("d-none");
                    addon.innerHTML = "";
                    break;
            }
        } else {
            quantidadeCreate.step = "1";
            addon.classList.add("d-none");
            addon.innerHTML = "";
        }
    });

    perecivelCreate.addEventListener("change", function() {
        if (this.checked) {
            this.value = 1;
            divValidade.classList.remove("d-none");
        } else {
            this.value = 0;
            divValidade.classList.add("d-none");
            dataValidadeCreate.value = "";
        }
    });

    productForm.addEventListener("submit", function(event) {
        event.preventDefault();

        if (validation(document.querySelectorAll(".form-register input, .form-register select"))) {
            this.removeEventListener("submit", arguments.callee);
            this.submit();
        }
    });
});

function validation(campos) {
    var validation = true;

    campos.forEach(function(campo) {
        if (campo.value === "" && campo.getAttribute("name") !== "validade") {
            toastr.warning("O campo " + campo.getAttribute("name").charAt(0).toUpperCase() + campo.getAttribute("name").slice(1) + " é obrigatório!");
            campo.style.border = "1px solid red";
            validation = false;
        } else if (campo.getAttribute("name") === "validade" && document.getElementById("perecivel").checked) {
            if (campo.value === "") {
                validation = false;
                toastr.warning("O campo Validade é obrigatório!");
                campo.style.border = "1px solid red";
            } else if (campo.value < document.getElementById("data_fabricacao").value) {
                toastr.warning("A data de validade não pode ser menor que a data de fabricação!");
                validation = false;
            } else {
                campo.style.border = "1px solid #222";
            }
        } else {
            campo.style.border = "1px solid #222";
        }
    });

    return validation;
}
