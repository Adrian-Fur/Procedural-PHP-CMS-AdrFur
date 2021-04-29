$(document).ready(function(){


    //CKEDITOR 5
    ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );

    // ADMIN POSTS CHECKBOXES
    $('#selectAllBoxes').click(function(event){

        if(this.checked){
            $('.checkBoxes').each(function(){
                this.checked = true;
            });

        } else {

            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });

});

//DYNAMIC USER COUNT

function loadUsersOnline(){

    $.get("functions.php?onlineusers=result", function(data){
        $(".usersonline").text(data);
    });
}

setInterval(function(){

    loadUsersOnline();
}, 500);





