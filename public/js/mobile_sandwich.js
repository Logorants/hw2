/* SCRIPT PER LA GESTIONE DEL MENU' A SANDWICH */

//FUNZIONI HANDLER
function openLinksMenu(event){
    modal.style.top = window.pageYOffset + "px";
    const link_container = document.createElement("div");

    const links = document.querySelectorAll("#links a");

    for(let link of links){
        link_container.appendChild(link);
    }

    modal.appendChild(link_container);
    document.body.classList.add("no_scroll");
    modal.classList.remove("hidden");
}


function closeLinksMenu(event){
    const link_container = document.querySelector("#links");
    const links = modal.querySelectorAll("div a");

    for(let link of links){
        link_container.appendChild(link);
    }

    modal.classList.add("hidden");
    modal.innerHTML = "";
    document.body.classList.remove("no_scroll");
}

/*  COSICE DA ESEGUIRE AL CARICAMENTO DELLA PAGINA  */

//AGGIUNGO GLI EVENT LISTENER AL MENU' A SANDWICH ED ALLA MODALE
const modal = document.querySelector("#link_modal");
modal.addEventListener('click', closeLinksMenu);

const menu = document.querySelector("#menu");
menu.addEventListener('click', openLinksMenu);