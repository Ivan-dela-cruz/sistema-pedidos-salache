const url_host ="https://tiendavirtualutc.com/"
//const url_host ="http://localhost/salache/public/"
// Simple list
Sortable.create(simpleList, {
    animation: 150,
    group: "media",
    store: {
        set: (sortable) => {
            const orden = sortable.toArray()
            updateOrder(orden)
        }
    }
});

function updateOrder(orden) {
    console.log(orden)
    let url = url_host + 'update-order-slider'
    axios.put(url, {
        'data': orden
    }).then(function (response) {
        console.log(response.data)
    }).catch(function (error) {
        console.log(error);
    });

}
