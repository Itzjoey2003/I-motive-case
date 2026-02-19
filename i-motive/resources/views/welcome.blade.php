<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="i-motive\resources\css\app.css">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<style>
    table {
        padding: 3rem;
    }

    #EmailColumn {
        margin: 1rem 3rem 1rem 3rem;
    }

    td{
        padding: 1rem;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th id="EmailColumn">Email</th>
                <th>Status</th>
                <th>Source</th>
            </tr>
        </thead>
        <tbody id="leads-table">
        </tbody>
    </table>
</body>




<script>
    document.addEventListener("DOMContentLoaded", function() {

        axios.get('/api/v1/leads')
            .then(response => {

                console.log(response.data);

                const leads = response.data.data; // important

                let tableBody = document.getElementById("leads-table");

                leads.forEach(lead => {
                    tableBody.innerHTML += `
                        <tr>
                            <td>${lead.id}</td>
                            <td>${lead.name}</td>
                            <td>${lead.Email}</td>
                            <td>${lead.status}</td>
                            <td>${lead.source}</td>
                        </tr>
                    `;
                });

            })
            .catch(error => {
                console.error(error);
            });

    });
</script>


</html>