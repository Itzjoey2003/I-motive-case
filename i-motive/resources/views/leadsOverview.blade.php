<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <body>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Source</th>
                </tr>
            </thead>
            <tbody id="leads-table">
            </tbody>
        </table>
    </body>




    <script>
    document.addEventListener("DOMContentLoaded", function () {

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
                            <td>${lead.email}</td>
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
