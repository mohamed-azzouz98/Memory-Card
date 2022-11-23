
const buttonBegin = document.querySelector('#begin')

buttonBegin.addEventListener('click', (e) => {
    e.preventDefault();
    const formParam = document.querySelector('#paramRevision')

    if (formParam.style.display === 'none') {
        formParam.style.display = 'bock'
    } else {
        formParam.style.display = 'none'
    }
});
