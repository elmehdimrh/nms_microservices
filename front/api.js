document.getElementById('token').addEventListener("click", function (event) {
    axios.post('http://localhost:7000/token', {
        grant_type: 'client_credentials',
        client_secret: '20nomalis21',
        client_id: 'gateway'
    })
        .then(function (response) {
            document.getElementById('token_input').value = response.data.access_token;
            console.log(response);
        })
        .catch(function (error) {
            alert(error);
        });
});

document.getElementById('load_actors').addEventListener("click", function (event) {

    axios.get('http://localhost:7000/acteurs', {
        headers: {'Authorization': 'Bearer ' + getToken()},
    })
        .then(function (response) {
            var html = "";
            response.data.forEach(function (item) {
                html += "<tr><td>" + item.id + "</td><td>" + item.nom + "</td></tr>";
                document.querySelector('#actors tbody').innerHTML = html;
            })
        })
        .catch(function (error) {
            alert(error);
        });


});

document.getElementById('read_actor').addEventListener("click", function (event) {

    axios.get('http://localhost:7000/acteur/details/10', {
        headers: {'Authorization': 'Bearer ' + getToken()},
    })
        .then(function (response) {

            var html = "<tr><td>" + response.data.id + "</td><td>" + response.data.nom + "</td></tr>";
            document.querySelector('#actors tbody').innerHTML = html;
        })
        .catch(function (error) {
            alert(error);
        });


});

document.getElementById('delete_actor').addEventListener("click", function (event) {

    axios.delete('http://localhost:7000/acteur/supprimer/4', {
        headers: {'Authorization': 'Bearer ' + getToken()},
    })
        .then(function (response) {
            alert(response.data)
        })
        .catch(function (error) {
            alert(error);
        });


});

document.getElementById('load_films').addEventListener("click", function (event) {

    axios.get('http://localhost:7000/films', {
        headers: {'Authorization': 'Bearer ' + getToken()},
    })
        .then(function (response) {
            var html = "";
            response.data.forEach(function (item) {
                var actors = "";
                item.acteurs.forEach(function (ac) {
                    actors += ac.nom + "--";
                });

                html += "<tr><td>" + item.id + "</td><td>" + item.nom + "</td><td>" + item.annee + "</td><td>" + actors + "</td></tr>";
                document.querySelector('#films tbody').innerHTML = html;
            })
        })
        .catch(function (error) {
            alert(error);
        });


});

document.getElementById('read_film').addEventListener("click", function (event) {

    axios.get('http://localhost:7000/films/1999', {
        headers: {'Authorization': 'Bearer ' + getToken()},
    })
        .then(function (response) {
            var html = "";
            response.data.forEach(function (item) {
                html += "<tr><td>" + item.id + "</td><td>" + item.nom + "</td><td>" + item.annee + "</td><td>" + item.acteurs + "</td></tr>";
                document.querySelector('#films tbody').innerHTML = html;
            })
        })
        .catch(function (error) {
            alert(error);
        });


});

document.getElementById('read_film_actor').addEventListener("click", function (event) {

    axios.get('http://localhost:7000/acteur/10/films', {
        headers: {'Authorization': 'Bearer ' + getToken()},
    })
        .then(function (response) {
            var html = "";
            response.data.forEach(function (item) {

                html += "<tr><td>" + item.id + "</td><td>" + item.nom + "</td><td>" + item.annee + "</td><td>-</td></tr>";
                document.querySelector('#films tbody').innerHTML = html;
            })
        })
        .catch(function (error) {
            alert(error);
        });


});


function getToken() {
    return document.getElementById('token_input').value;
}