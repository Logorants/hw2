/* FUNZIONE CHE PERMETTE DI CARICARE I PRODOTTI MONITORATI DALL'UTENTE */

function load_follows_db(){

    fetch("/servizi/follows/load").then(resp => {
        return resp.json();
    }).then(json => {
        if(json.length > 0) {
            for (let product of json) {
                add_block(product, true);
            }
            document.querySelector("#products div").classList.remove("hidden");
        }
    });
}
