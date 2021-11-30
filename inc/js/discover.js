/*
$(window).scroll(function(){
    // Gets current scroll level
    let scroll = $(document).scrollTop();
    // Gets height of document
    let dHeight = $(document).height();
    // Gets height of window
    let wHeight = $(window).height();
    
    let diff = dHeight - wHeight;
    if(diff - scroll < 2){
        loadDoc();
    }
});
*/

$("#load_more").click(loadDoc);

let loading = false;
function loadDoc() {
    if(loading)
        return;
    loading = true;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      console.log(this.responseText);
      $(".discover_content").append(this.responseText);
      updateSlider();
      loading = false;
    }
    xhttp.open("GET", "./?site=get_new_slider", true);
    xhttp.send();
}