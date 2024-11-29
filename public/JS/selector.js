let selectedLineId = null;
const ref = window.location.href

document.addEventListener('DOMContentLoaded', () => {
    const lines = document.querySelectorAll('.selectable-line');

    lines.forEach(line => {
        line.addEventListener('click', () => {
            selectLine(line);
        });
    });



    document.getElementById('verButton').addEventListener('click', () => {
        if (selectedLineId) {
            window.location.href = ref + `/${selectedLineId}/description`;
        } else {
            alert('Por favor, selecione uma linha primeiro.');
        }
    });

    document.getElementById('editButton').addEventListener('click', () => {
        if (selectedLineId) {
            window.location.href = ref + `/${selectedLineId}/edit`;
        } else {
            alert('Por favor, selecione uma linha primeiro.');
        }
    });

    document.getElementById('deleteButton').addEventListener('click', () => {
        if (selectedLineId && confirm('Tem certeza que deseja deletar esta linha?')) {
            document.getElementById('deleteForm').action = ref + `/${selectedLineId}`;
            document.getElementById('deleteForm').submit();
        } else {
            alert('Por favor, selecione uma linha primeiro.');
        }
    });
});

function selectLine(element) {

    selectedLineId = element.getAttribute('data-id');

    document.querySelectorAll('.selectable-line').forEach(line => line.classList.remove('selected'));

    element.classList.add('selected');
}
