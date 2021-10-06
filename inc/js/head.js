
const navSlider = () => {

    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-elements');
    const navElememts = document.querySelectorAll('.nav-elements li');

    
    burger.addEventListener('click', () =>{

        //Toggle
        nav.classList.toggle('nav-active');

        //Animated links
        navElememts.forEach((link,index) => {
            if(link.style.animation){

                link.style.animation="";

            }else

                link.style.animation = `navLinkFade 0.4s ease forwards ${index/3 +0.3}s`;

        });


        //Burger Animation

        burger.classList.toggle("toggle");

    });

    

}

navSlider();



