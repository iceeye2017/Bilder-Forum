var slideIndex = getAllSlides();
showAllSlides();


function getAllSlides(){

    var slidesArray = document.getElementsByClassName("slide");
    
    var indexArray = Array();

    for(var i = 0; i < slidesArray.length;i++){

        indexArray[i] = 1;

    }

    return indexArray;

}


// Next/previous controls
function plusSlides(slideNr, plus) {

    slideIndex[slideNr] += plus;
    showSlides(slideNr, slideIndex[slideNr]);

}

function showAllSlides(){

    for(var i = 0; slideIndex.length > i; i++)

        showSlides(i, 0);


}


function showSlides(slideShowNr, pictureNr) {

    var i;
    var slides = $((".slideshow-container".concat(slideShowNr, " .mySlides")));

    console.log((".slideshow-container".concat(slideShowNr, " .mySlides")));
    console.log(slides);

    if(pictureNr > slides.length){slideIndex[slideNr]=0}; 
    if(pictureNr < 0){slideIndex[slideNr]=slideIndex[slideShowNr].length-1}; 

    for(i = 1; i < slideIndex[slideShowNr].length; i++){

        slides[i].style.display ="none";

    }

    slides[pictureNr].style.display = "block";


}