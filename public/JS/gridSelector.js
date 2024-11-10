let href; 
let selectedId = null;

const fullPath = window.location.pathname;
const pathSegments = fullPath.split('/');

const mainSegment = pathSegments[1];
const itemId = pathSegments[2]; 


switch(mainSegment){
    case "line":
        href = "machine"
        break;
    case "machine":
        href = "courses"
        break
}


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