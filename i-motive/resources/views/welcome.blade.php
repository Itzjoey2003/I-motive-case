<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js']) <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<header>
    <h1>I-motive leads overzicht</h1>
</header>

<body>
    <div id="filter">
        <div id="leftFilter">
            <div class="filterOption">
                <select id="statusFilter">
                    <option value="">Filter op status</option>
                    <option value="nieuw">nieuw</option>
                    <option value="opgepakt">opgepakt</option>
                    <option value="proefrit">proefrit</option>
                    <option value="offerte">offerte</option>
                    <option value="verkocht">verkocht</option>
                    <option value="afgevallen">afgevallen</option>
                </select>
            </div>
            <div>
                <input type="text" id="searchBar" name="Name" placeholder="Zoek op naam of e-mail">
            </div>
            <div id="sortButtonDiv">
                <button id="sortButton">Sorteer op laatst gewijzigd ↑</button>
            </div>
        </div>
        <div id="rightFilter">
            <div>
                <button id="openCreateDialog">Nieuwe lead toevoegen</button>
            </div>
            <div>
                <button id="openUpdateDialog">Lead updaten</button>
            </div>
        </div>


    </div>
    <div id="pageContainer">
        <div id="recordsTable">

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
        <dialog id="createDialog">
            <form id="postForm" method="dialog">
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

                <div class="dialogButtonsDiv">
                    <button type="submit" class="dialogButton">Lead opslaan</button>
                    <button type="button" class="dialogButton" id="closeCreateDialog">Annuleren</button>
                </div>
            </form>
        </dialog>
        <dialog id="updateDialog">
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
                <div class="dialogButtonsDiv">
                    <button id="saveButton" type="submit" class="dialogButton">Lead wijzigen</button>
                    <button type="button" id="closeUpdateDialog" class="dialogButton">Annuleren</button>

                </div>

            </form>
        </dialog>
    </div>

    </div>
    </div>


</body>




<script>
    document.addEventListener("DOMContentLoaded", function() {

        const createDialog = document.getElementById("createDialog");

        document.getElementById("openCreateDialog").addEventListener("click", function() {
            createDialog.showModal();
        });

        document.getElementById("closeCreateDialog").addEventListener("click", function() {
            createDialog.close();
        });

        const updateDialog = document.getElementById("updateDialog");

        // Open the update dialog
        document.getElementById("openUpdateDialog").addEventListener("click", function() {
            updateDialog.showModal();
        });

        // Close the update dialog
        document.getElementById("closeUpdateDialog").addEventListener("click", function() {
            updateDialog.close();
        });

        let currentSortDirection = "desc";
        // if the direction is asc, change to desc. Otherwise change to asc
        document.getElementById("sortButton").addEventListener("click", function() {
            currentSortDirection = currentSortDirection === "asc" ? "desc" : "asc";
            // update button text based on current sorting
            this.innerText =
                currentSortDirection === "asc" ?
                "Sorteer op laatst gewijzigd ↓" :
                "Sorteer op laatst gewijzigd ↑";

            console.log(`${currentSortDirection}`);

            // reload the table with the new sort direction
            loadLeads(
                document.getElementById("statusFilter").value,
                document.getElementById("searchBar").value
            );
        });

        // loads the table with all leads
        function loadLeads(statusFilter = "", searchBar = "") {

            let url = `/api/v1/leads?direction=${currentSortDirection}`;

            // Adds status filter if there is one
            if (statusFilter !== "") {
                url += `&Status[eq]=${statusFilter}`;
            }

            axios.get(url)
                .then(response => {

                    const leads = response.data.data;
                    let tableBody = document.getElementById("leads-table");
                    tableBody.innerHTML = "";

                    // filters for records matching the name or email
                    const filteredLeads = leads.filter(lead => {
                        const nameMatch = lead.name.toLowerCase().includes(searchBar.toLowerCase());
                        const emailMatch = lead.Email.toLowerCase().includes(searchBar.toLowerCase());
                        return nameMatch || emailMatch;
                    });

                    // generate tables 
                    filteredLeads.forEach(lead => {
                        tableBody.innerHTML += `
                            <tr>
                                <td>${lead.id}</td>
                                <td>${lead.name}</td>
                                <td>${lead.Email}</td>
                                <td>${lead.status}</td>
                                <td>${lead.source}</td>
                                <td id="deleteColumn">
                                    <button class="delete-btn" data-id="${lead.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                    });

                    // Attach event listeners to the delete buttons AFTER adding them
                    document.querySelectorAll(".delete-btn").forEach(button => {
                        button.addEventListener("click", () => {
                            const leadId = button.getAttribute("data-id");

                            axios.delete(`/api/v1/leads/${leadId}`)
                                .then(response => {
                                    console.log(`Lead #${leadId} deleted`);
                                    loadLeads(); // refresh table
                                })
                                .catch(error => console.error(error.response?.data || error));
                        });
                    });

                })
                .catch(error => console.error(error));
        }



        // Load all leads on page load
        loadLeads();

        // listens for changes in the status filter
        document.getElementById("statusFilter").addEventListener("change", function() {
            const searchValue = document.getElementById("searchBar").value;
            loadLeads(this.value, searchValue);
        });

        // listens for changes in the searchbar
        document.getElementById("searchBar").addEventListener("input", function() {
            const statusValue = document.getElementById("statusFilter").value;
            loadLeads(statusValue, this.value);
        });

        //create new lead form API request
        document.getElementById('postForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            axios.post("{{ route('leads.store') }}", formData)
                .then(response => {
                    console.log("Lead succesfully created")

                    document.getElementById('postForm').reset();
                    createDialog.close();
                    loadLeads();

                })
                .catch(error => {
                    console.log(error.response.data);
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
                });
        });

        //delete lead form API request
        document.getElementById('deleteForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let leadId = document.getElementById('setLeadIdForDelete').value; //sets the leadID in the delete form

            axios.delete(`/api/v1/leads/${leadId}`)
                .then(response => {
                    console.log("Lead succesfully deleted")

                    document.getElementById('deleteForm').reset();
                    loadLeads();

                })
                .catch(error => {
                    console.log(error.response.data);
                });
        });
    });
</script>

</html>