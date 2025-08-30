let listeArticles = window.listeArticles || [];
let indiceLigne = 1;

function mettreAJourIndices() {
    document.querySelectorAll('#articlesTable tbody tr').forEach((tr, i) => {
        tr.querySelector('td:first-child').textContent = i + 1;
        tr.querySelectorAll('select, input').forEach(input => {
            let name = input.name;
            if (name) {
                input.name = name.replace(/\d+/, i);
            }
        });
    });
}

function changementCodeArticle(select) {
    const idArticle = select.value;
    const tr = select.closest('tr');
    const article = listeArticles.find(a => a.idArticle == idArticle);
    if (article) {
        tr.querySelector('.designation').value = article.designation;
        tr.querySelector('.unite').value = article.idUnite;
    } else {
        tr.querySelector('.designation').value = '';
        tr.querySelector('.unite').value = '';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('ajouterLigne').addEventListener('click', function () {
        const tableBody = document.querySelector('#articlesTable tbody');
        const newRow = document.createElement('tr');

        let optionsHtml = `<option value="">-- Choisir --</option>`;
        listeArticles.forEach(a => {
            optionsHtml += `<option value="${a.idArticle}">${a.code}</option>`;
        });

        newRow.innerHTML = `
            <td>${tableBody.children.length + 1}</td>
            <td>
                <select name="articles[${indiceLigne}][idArticle]" class="form-control code-article-select" required>
                    ${optionsHtml}
                </select>
            </td>
            <td><input type="text" name="articles[${indiceLigne}][designation]" class="form-control designation" readonly></td>
            <td><input type="number" name="articles[${indiceLigne}][quantite]" class="form-control" min="1" value="1" required></td>
            <td><input type="text" name="articles[${indiceLigne}][idUnite]" class="form-control unite" readonly></td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm removeRow">
                    <i class="fa fa-trash-o"></i>
                </button>
            </td>
        `;

        tableBody.appendChild(newRow);
        indiceLigne++;
        mettreAJourIndices();
    });

    document.querySelector('#articlesTable').addEventListener('change', function (e) {
        if (e.target.classList.contains('code-article-select')) {
            changementCodeArticle(e.target);
        }
    });

    document.querySelector('#articlesTable').addEventListener('click', function (e) {
        if (e.target.closest('.removeRow')) {
            const rows = document.querySelectorAll('#articlesTable tbody tr');
            if (rows.length > 1) {
                e.target.closest('tr').remove();
                mettreAJourIndices();
            }
        }
    });

    // Bind déjà les selects existants
    document.querySelectorAll('.code-article-select').forEach(select => {
        select.addEventListener('change', () => changementCodeArticle(select));
    });
});
