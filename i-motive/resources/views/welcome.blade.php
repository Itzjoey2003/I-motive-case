<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js']) <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<header>
    <h1>Leads overzicht</h1>
</header>

<body>
    <div id="pageContainer">
        <div id="recordsTable">
            <div id="filter">
                <h4>Filter op status</h4>
                <select id="statusFilter">
                    <option value="">-- All --</option>
                    <option value="nieuw">nieuw</option>
                    <option value="opgepakt">opgepakt</option>
                    <option value="proefrit">proefrit</option>
                    <option value="offerte">offerte</option>
                    <option value="verkocht">verkocht</option>
                    <option value="afgevallen">afgevallen</option>
                </select>
            </div>
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
        </div>
        <div id="formDiv">
            <form id="postForm">
                @csrf
                <h3>Create new lead</h3>
                <div class="formItems">
                    <label for="name">Naam</label>
                    <input type="text" id="postName" name="Name" required>
                </div>

                <div class="formItems">
                    <label for="email">E-mail</label>
                    <input type="email" id="postEmail" name="Email" required>
                </div>

                <div class="formItems">
                    <label for="source">Bron</label>
                    <select id="postSource" name="Source" required>
                        <option value="">-- Kies bron --</option>
                        <option value="website">Website</option>
                        <option value="e-mail">E-mail</option>
                        <option value="telefoon">Telefoon</option>
                        <option value="whatsapp">WhatsApp</option>
                        <option value="showroom">Showroom</option>
                        <option value="overig">Overig</option>
                    </select>
                </div>

                <div class="formItems">
                    <label for="status">Status</label>
                    <select id="postStatus" name="Status" required>
                        <option value="">-- Kies status --</option>
                        <option value="nieuw">Nieuw</option>
                        <option value="opgepakt">Opgepakt</option>
                        <option value="proefrit">Proefrit</option>
                        <option value="offerte">Offerte</option>
                        <option value="verkocht">Verkocht</option>
                        <option value="afgevallen">Afgevallen</option>
                    </select>
                </div>

                <button id="saveButton" type="submit">Lead opslaan</button>
            </form>
            <form id="putForm">
                @csrf
                <h3>update Lead</h3>

                <div class="formItems">
                    <label for="id">Lead ID</label>
                    <input type="number" id="setLeadId" name="Id" required>
                </div>

                <div class="formItems">
                    <label for="name">Naam</label>
                    <input type="text" id="putName" name="Name" required>
                </div>

                <div class="formItems">
                    <label for="email">E-mail</label>
                    <input type="email" id="putEmail" name="Email" required>
                </div>

                <div class="formItems">
                    <label for="source">Bron</label>
                    <select id="putSource" name="Source" required>
                        <option value="">-- Kies bron --</option>
                        <option value="website">Website</option>
                        <option value="e-mail">E-mail</option>
                        <option value="telefoon">Telefoon</option>
                        <option value="whatsapp">WhatsApp</option>
                        <option value="showroom">Showroom</option>
                        <option value="overig">Overig</option>
                    </select>
                </div>

                <div class="formItems">
                    <label for="status">Status</label>
                    <select id="putStatus" name="Status" required>
                        <option value="">-- Kies status --</option>
                        <option value="nieuw">Nieuw</option>
                        <option value="opgepakt">Opgepakt</option>
                        <option value="proefrit">Proefrit</option>
                        <option value="offerte">Offerte</option>
                        <option value="verkocht">Verkocht</option>
                        <option value="afgevallen">Afgevallen</option>
                    </select>
                </div>

                <button id="saveButton" type="submit">Lead wijzigen</button>
            </form>
            <div id="successMessage"></div>
             <div>
            <form id="deleteForm">
                @csrf
                <h3>Verwijder Lead</h3>

                <div class="formItems">
                    <label for="id">Lead ID</label>
                    <input type="number" id="setLeadIdForDelete" name="Id" required>
                </div>

                <button id="saveButton" type="submit">Lead verwijderen</button>
            </form>
        </div>
        </div>
       
    </div>
    </div>


</body>




<script>
    document.addEventListener("DOMContentLoaded", function() {

        // loads the table with all leads records
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

        // Dropdown listener for filters
        document.getElementById("statusFilter")
            .addEventListener("change", function() {
                loadLeads(this.value);
            });

        //create new lead form API request
        document.getElementById('postForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            axios.post("{{ route('leads.store') }}", formData)
                .then(response => {
                    document.getElementById('successMessage').innerHTML =
                        '<p style="color: green;">Lead succesvol aangemaakt!</p>';

                    document.getElementById('postForm').reset();
                    loadLeads();

                })
                .catch(error => {
                    console.log(error.response.data);

                    if (error.response.status === 422) {
                        let errors = error.response.data.errors;



                        Object.keys(errors).forEach(function(key) {
                            document.getElementById('error-' + key).innerHTML =
                                '<p style="color:red;">' + errors[key][0] + '</p>';
                        });
                    }
                });
        });

        //update lead form API request
        document.getElementById('putForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let leadId = document.getElementById('setLeadId').value; //sets the leadID in the update form

            axios.put(`/api/v1/leads/${leadId}`, {
                    Name: document.getElementById('putName').value,
                    Email: document.getElementById('putEmail').value,
                    Source: document.getElementById('putSource').value,
                    Status: document.getElementById('putStatus').value
                })
                .then(response => {
                    console.log("Lead succesfully updated")

                    document.getElementById('putForm').reset();
                    loadLeads();

                })
                .catch(error => {
                    console.log(error.response.data);

                    if (error.response.status === 422) {
                        let errors = error.response.data.errors;



                        Object.keys(errors).forEach(function(key) {
                            document.getElementById('error-' + key).innerHTML =
                                '<p style="color:red;">' + errors[key][0] + '</p>';
                        });
                    }
                });
        });

        //delete lead form API request
        document.getElementById('deleteForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let leadId = document.getElementById('setLeadId').value; //sets the leadID in the update form

            axios.delete(`/api/v1/leads/${leadId}`)
                .then(response => {
                    console.log("Lead succesfully updated")

                    document.getElementById('deleteForm').reset();
                    loadLeads();

                })
                .catch(error => {
                    console.log(error.response.data);

                    if (error.response.status === 422) {
                        let errors = error.response.data.errors;



                        Object.keys(errors).forEach(function(key) {
                            document.getElementById('error-' + key).innerHTML =
                                '<p style="color:red;">' + errors[key][0] + '</p>';
                        });
                    }
                });
        });

    });
</script>

</html>