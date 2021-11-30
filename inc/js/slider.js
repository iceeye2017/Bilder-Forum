let counter = new Map();

$(document).ready(() => {
    initSlider();
});

function updateSlider(){
    deleteSlider();
    initSlider();
}

function initSlider(){
    $(".slider").each((index, elem) => {
        counter.set(index, 0);
        $(elem).addClass("slider"+index);
        initDots(index);
        switchSlide(index, 0);
    });

    $(".ctrl.prev").click(function(){
        let slider = $(this).closest(".slider");
        let sliderIndex = $(".slider").index(slider);
        let itemsCount = $('.slider' + sliderIndex + " .slide").length;
        let slideIndex = counter.get(sliderIndex);
        
        slideIndex -= 1;
        if(slideIndex < 0){
            slideIndex = itemsCount-1;
        }
        switchSlide(sliderIndex, slideIndex);
    });

    $(".ctrl.next").click(function(){
        let slider = $(this).closest(".slider");
        let sliderIndex = $(".slider").index(slider);
        let itemsCount = $('.slider' + sliderIndex + " .slide").length;
        let slideIndex = counter.get(sliderIndex);
        slideIndex += 1;
        if(slideIndex >= itemsCount){
            slideIndex = 0;
        }
        switchSlide(sliderIndex, slideIndex);
    });
}

function switchSlide(sliderIndex, slideIndex){
    counter.set(sliderIndex, slideIndex);
    $(".slider.slider" + sliderIndex + " .slide").removeClass("active");
    let slides = $(".slider.slider" + sliderIndex + " .slide");
    $(slides[slideIndex]).addClass("active");
}

function initDots(sliderIndex){
    let slider = $(".slider.slider" + sliderIndex);
    if(!slider)
        return;
    let dotsDiv = $(slider).find(".dots");
    if(!dotsDiv)
        return;

    let itemsCount = $(slider).find(".slide").length;
    for(let i = 0; i < itemsCount; i++){
        let html = "<span class='dot' onclick='switchSlide(" + sliderIndex + ", " + i + ")'></span>";
        $(dotsDiv).append(html);
    }
}

function deleteSlider(){
    // REMOVES DOTS
    $(".slider").each(function(index, slider){
        $(slider).find(".dot").remove();
    });
    // REMOVES EVENT LISTENER
    $(".ctrl.prev").unbind("click");
    $(".ctrl.next").unbind("click");

    $(".slider").removeClass (function (index, className) {
        return (className.match (/(^|\s)slider+\S+/g) || []).join(' ');
    });
}
