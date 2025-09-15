@extends('maintenance.basefront')
@section('title', "Faire une demande")
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Demande d’Achat</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-success" id="addRow">
                <i class="fa fa-plus-circle"></i> Ajouter une ligne
            </button>
        </div>
    </div>
<div class="col-lg-12">
    <form action="{{ route('demande.store') }}" method="POST">
        @csrf
        <input type="hidden" value="0" name="counter" id="inputCounter">
        <input type="hidden" name="iddemande_travaux" value="{{ $iddemandetravaux ?? '' }}">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="demandeur" class="form-label fw-bold">Demandeur</label>
                <input type="text" class="form-control" value="{{ Auth::user()->username }}" readonly>
                <input type="hidden" name="iddemandeur" value="{{ Auth::user()->iduser }}">
            </div>
            <div class="col-md-6">
                <label for="date_demande" class="form-label fw-bold">Date de demande</label>
                <input type="date" name="datedemande" id="date_demande" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
        </div>
        <br>
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered table-striped table-hover align-middle mb-0" id="itemsTable">
                <thead class="table-primary text-center">
                <tr>
                    <th style="width: 10%">Item Nº</th>
                    <th style="width: 15%">Code Article</th>
                    <th style="width: 35%">Désignation</th>
                    <th style="width: 15%">Quantité</th>
                    <th style="width: 15%">Unité</th>
                    <th style="width: 10%">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>0</td>
                    <td>
                        <input type="text" name="items[0][code]" class="form-control form-control-sm code-article text-center fw-bold" readonly>
                    </td>
                    <td>
                        <select name="items[0][designation]" class="form-select designation">
                            @foreach($articles as $article)
                                <option value="{{ $article->idarticle }}" data-code="{{ $article->code }}" data-unite="{{ $article->unite }}">
                                    {{ $article->designation }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="items[0][quantitedemande]" class="form-control form-control-sm text-center" min="1" value="1" required>
                    </td>
                    <td>
                        <input type="text" name="items[0][unite]" class="form-control form-control-sm unite text-center" readonly>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row" disabled>
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-primary mb-2">
                <i class="bi bi-save"></i> Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
    <script>
        const inputCounter = document.getElementById("inputCounter");

        document.addEventListener("DOMContentLoaded", function () {
            new TomSelect(".designation", {
                placeholder: "Choisir un article",
                create: true,
                maxOptions: 10,
                allowEmptyOption: true,
                sortField: { field: "text", direction: "asc" },
                plugins: ['dropdown_input'],
            });

            const tbody = document.querySelector("#itemsTable tbody");

            function toggleRemoveButtons() {
                const rows = tbody.querySelectorAll("tr");
                rows.forEach((row) => {
                    const btn = row.querySelector(".remove-row");
                    btn.disabled = (rows.length === 1);

                    inputCounter.value = rows.length;
                    updateRowIndices();

                    console.log(inputCounter.value);

                });
            }

            document.addEventListener("change", function(e) {
                if (e.target.classList.contains("designation")) {
                    let option = e.target.selectedOptions[0];
                    let row = e.target.closest("tr");
                    row.querySelector(".code-article").value = option.dataset.code || '';
                    row.querySelector(".unite").value = option.dataset.unite || '';
                }
            });

            let rowIndex = 1;

            document.getElementById("addRow").addEventListener("click", function () {
                let newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>${ rowIndex }</td>
                    <td>
                        <input type="text" name="items[${rowIndex}][code]" class="form-control code-article text-center fw-bold" readonly>
                    </td>
                    <td>
                        <select name="items[${rowIndex}][designation]" class="form-select designation">
                            @foreach($articles as $article)
                <option value="{{ $article->idarticle }}" data-code="{{ $article->code }}" data-unite="{{ $article->unite }}">
                                    {{ $article->designation }}
                </option>
@endforeach
                </select>
            </td>
            <td>
                <input type="number" name="items[${rowIndex}][quantitedemande]" class="form-control text-center" min="1" value="1" required>
                    </td>
                    <td>
                        <input type="text" name="items[${rowIndex}][unite]" class="form-control unite text-center" readonly>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(newRow);

                new TomSelect(newRow.querySelector(".designation"), { placeholder: "Choisir un article",
                    create: true,
                    maxOptions: 10,
                    allowEmptyOption: true,
                    sortField: { field: "text", direction: "asc" },
                    plugins: ['dropdown_input'], });
                inputCounter.value = rowIndex;
                rowIndex++;

                updateRowIndices();
                toggleRemoveButtons();
            });

            document.addEventListener("click", function (e) {
                if (e.target.closest(".remove-row")) {
                    e.target.closest("tr").remove();
                    toggleRemoveButtons();
                }

            });
            function updateRowIndices() {
                const rows = tbody.querySelectorAll("tr");
                rows.forEach((row, index) => {
                    row.querySelector("td").textContent = index + 1;
                    const inputs = row.querySelectorAll("input, select");
                    inputs.forEach(input => {
                        const oldName = input.getAttribute("name");
                        if (oldName) {
                            const newName = oldName.replace(/\[\d+\]/, `[${index + 1}]`);
                            input.setAttribute("name", newName);
                        }
                    });
                });
            }

            toggleRemoveButtons();
        });
    </script>
@endsection
