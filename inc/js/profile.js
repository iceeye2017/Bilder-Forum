

document.getElementById("profileImage").addEventListener("click",uploadPic);

function uploadPic(){

    document.getElementById("imageUpload").click();

}

function previewFile() {
   
    var buttons = document.getElementsByClassName("profileButtons")[0];
    
    buttons.style.display = "block";

    var img = document.getElementById("profilePic");
    var input = document.getElementById("imageUpload").files[0];

    var reader = new FileReader();

    if (input) {

        reader.readAsDataURL(input);

    } else {

        img.src = "";
        
    }

    reader.onloadend = function () {

        img.src = reader.result;

    }

  }