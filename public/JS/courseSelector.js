
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

function acessElement(id){
    window.location.pathname = `course/${id}/class/show_video`;
}
