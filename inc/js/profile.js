

//bind event listener to picture
document.getElementById("profileImage").addEventListener("click",uploadPic);

function uploadPic(){

    document.getElementById("imageUpload").click();

}
function activateButtons(){

    var buttons = document.getElementsByClassName("profileButtons")[0];
    
    buttons.style.display = "block";

}

//update picture
function previewFile() {
   
    activateButtons();

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
//cancel Form submission
  function buttoncancel(){

    return false;

  }

//activate field username and show buttons
  function changeUsername(){

    document.getElementById("username").readOnly = false;
    document.getElementById("userpen").style.visibility="hidden";
    activateButtons();


  }

  function changePassword(){

    document.getElementById("oldPassword").readOnly = false;
    document.getElementById("newPassword").style.display = "block";
    document.getElementById("passpen").style.visibility="hidden";
    activateButtons();

  }