/* FUNZIONE CHE STABILISCE SE UN PRODOTTO E' GIA' PRESENTE SUL DB */

function check_prod_db(item_id, event, elem, csrf_token) {

    fetch("/servizi/products/check/" + item_id).then(resp => {
        return resp.json();

    }).then(json => {
        check_follows_db(item_id, event, elem, json['check'], csrf_token);
    });
}
