<main>

    <form name="profileForm" method="post" action="#">

        <div class = "profilePic">

            <img id="profilePic" src="https://www.inixgroup.com/wp-content/uploads/2020/12/placeholder.png" alt="Profile Picture"/>

            
            <div id="profileImage" class="p-image avatar">
                <i class="fa fa-camera upload-button"></i>

            
                    <input id="imageUpload" class="file-upload" type="file" accept="image/*" onchange="previewFile()"/>
        

            </div>
        </div>

        </div>

        <ul class="userInformation">

            <li><input name = "username" value="Username"/></li>
            <li><input name = "oldPassword" value="Password"/></li>
            <li id = "newPassword"><input name = "newPassword" value="New Password"/></li>
            

        </ul>

        <div class = "profileButtons">

            <button class="button" id ="bcancel">Cancel</button>
            <button class="button" id="bsave">Save</button>


        </div>


    </form> 

</main>