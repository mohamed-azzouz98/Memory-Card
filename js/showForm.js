const buttonInscription = document.querySelector('#buttonInscription')
const buttonConnexion = document.querySelector('#buttonConnexion')

buttonInscription.addEventListener('click', () =>{
    const formI = document.querySelector('#inscriptionForm')

    if(formI.style.visibility === 'hidden'){
        formI.style.visibility = 'visible'
    }
    else{
        formI.style.visibility = 'hidden'
    }
});




buttonConnexion.addEventListener('click', () =>{
    const formC = document.querySelector('#connexionForm')

    if(formC.style.visibility === 'hidden'){
        formC.style.visibility = 'visible'
    }
    else{
        formC.style.visibility = 'hidden'
    }
});


