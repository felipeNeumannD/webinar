
const fullPath = window.location.pathname;
const pathSegments = fullPath.split('/');

document.addEventListener('DOMContentLoaded', () => {


    const element = document.querySelectorAll('.course_select_item')
    const addElement = document.querySelectorAll('.course_select_image')

    addElement.forEach(line => {
        line.addEventListener('dblclick', () => {
            addCourseElement( pathSegments[2] );
        });
    })

})


function addCourseElement(courseId) {
    window.location.pathname = `${pathSegments[1]}/${courseId}/class/content`;
}

function toggleSelection(element) {
    document.querySelectorAll('.select-item').forEach(line => line.classList.remove('selected'));
    element.classList.toggle('selected');
    selectedId = element.getAttribute('data-id');
}