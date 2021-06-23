/* JS FILE */

//General Functions
function error_adder(event, ...form_names) {
    event.preventDefault();
    for (let name of form_names) {
        if (!event.currentTarget[name].classList.contains("input_error"))
            event.currentTarget[name].classList.add("input_error");
    }
    return true;
}

function error_remover(event, ...form_names) {
    for (let name of form_names) {
        event.currentTarget[name].classList.remove("input_error");
    }
}

function onEmailExistsResponse(resp) {
    return resp.json();
}

function onEmailExistsJson(json) {
    email_exists = json["exists"];
}

//Event Handlers

function check_registration(event) {
    const form = document.forms['register'];
    fetch("email_exists.php", {
        method: 'POST',
        body: new FormData(form)
    }).then(onEmailExistsResponse).then(onEmailExistsJson);
}

function onLoginSubmit(event) {
    //Flag per il controllo di errori
    let err_flag = false;
    let err_array = [];
    const signup_form = event.currentTarget;

    //Check Nome
    if (!/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/.test(signup_form['name'].value)) {
        err_flag = error_adder(event, "name");
        err_array.push("la lunghezza del nome deve essere tra i 3 ed i 30 caratteri");
    } else error_remover(event, "name");

    //Check Cognome
    if (!/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/.test(signup_form['surname'].value)) {
        err_flag = error_adder(event, "surname");
        err_array.push("la lunghezza del cognome deve essere tra i 3 ed i 30 caratteri");
    } else error_remover(event, "surname");

    //Check Nome Impresa
    if (!/^(?![\s.]+$)[a-zA-Z0-9\s.]{3,30}$/.test(signup_form['company'].value)) {
        err_flag = error_adder(event, "company");
        err_array.push("la lunghezza del nome dell'impresa deve essere compresa tra i 3 ed i 30 caratteri");
    } else error_remover(event, "company");

    //Check Città Sede
    if (!/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/.test(signup_form['city'].value)) {
        err_flag = error_adder(event, "city");
        err_array.push("la lunghezza del nome della città deve essere compresa tra i 3 ed i 50 caratteri e non può contenere numeri");
    } else error_remover(event, "city");

    //Check Indirizzo Sede
    if (!/^[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/.test(signup_form['address'].value)) {
        err_flag = error_adder(event, "address");
        err_array.push("l'indirizzo della sede deve avere min 3 caratteri e max 50 caratteri");
    } else error_remover(event, "address");

    //Check e-mail
    if (!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(signup_form['email'].value)) {
        err_flag = error_adder(event, "email");
        err_array.push("formato email errato");
    } else if (email_exists) {
        err_flag = error_adder(event, "email");
        err_array.push("email già in uso");
    } else {
        error_remover(event, "email");
    }

    //Check password e retype-password
    let pass_error = false;

    if (!/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(signup_form['password'].value)) {
        err_flag = error_adder(event, "password", "retype-password");
        err_array.push("la password deve essere lunga almeno 8 caratteri ed avere almeno 1 carattere maiuscolo e minuscolo, 1 simbolo speciale ed 1 numero");
        pass_error = true;
    }

    if (signup_form['password'].value !== signup_form['retype-password'].value) {
        err_flag = error_adder(event, "password", "retype-password");
        err_array.push("Le password non coincidono");
        pass_error = true;
    }

    if (!pass_error) error_remover(event, "password", "retype-password");

    //Check Partita IVA
    if (!/^[0-9]{11}$/.test(signup_form['iva'].value)) {
        err_flag = error_adder(event, "iva");
        err_array.push("la partita IVA è costituita da 11 cifre");
    } else {
        error_remover(event, "iva");
    }

    //Mostra il div degli errori se sono stati riscontrati ed evidenzia i campi errati
    if (err_flag) {
        const err = document.querySelector(".error");
        err.innerHTML = "";

        for (let error of err_array) {
            const paragraph = document.createElement("p");
            paragraph.textContent = "> " + error;
            err.appendChild(paragraph);
        }
        err.classList.remove("hidden");
    }
}

//Code to be executed
let email_exists;
const form = document.forms['register'];
form.addEventListener('submit', onLoginSubmit);
document.forms['register']['email'].addEventListener('blur', check_registration);
