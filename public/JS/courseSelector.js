
document.addEventListener('DOMContentLoaded', () => {


    const element = document.querySelectorAll('.select-item');

    element.forEach(line => {
        line.addEventListener('dblclick', () => {
            changePage();
        });

    });

})

function changePage() {
    window.location.pathname = `${href}/${selectedId}/description`;
}

function toggleSelection(element) {
    document.querySelectorAll('.select-item').forEach(line => line.classList.remove('selected'));
    element.classList.toggle('selected');
    selectedId = element.getAttribute('data-id');
}