
//Ajax request for more slideshows
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