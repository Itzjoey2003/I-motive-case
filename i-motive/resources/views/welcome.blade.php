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

    td {
        padding: 1rem;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<body>
    <select id="statusFilter">
        <option value="">-- All --</option>
        <option value="nieuw">nieuw</option>
        <option value="opgepakt">opgepakt</option>
        <option value="proefrit">proefrit</option>
        <option value="offerte">offerte</option>
        <option value="verkocht">verkocht</option>
        <option value="afgevallen">afgevallen</option>
    </select>

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

        function loadLeads(filter = "") {

            let url = "/api/v1/leads";

            if (filter !== "") {
                url += `?Status[eq]=${filter}`;
            }

            axios.get(url)
                .then(response => {

                    console.log(response.data);

                    const leads = response.data.data;
                    let tableBody = document.getElementById("leads-table");

                    tableBody.innerHTML = "";

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
                .catch(error => console.error(error));
        }

        // Load all leads on page load
        loadLeads();

        // Dropdown listener
        document.getElementById("statusFilter")
            .addEventListener("change", function() {
                loadLeads(this.value);
            });

    });
</script>

</html>