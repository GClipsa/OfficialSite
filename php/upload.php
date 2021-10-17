<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(!empty($_FILES['file']))
        {
            if(move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/'.$_FILES['file']['name'])){
                echo 'OK';
            }
            else{
                echo 'ERROR';
            }
        }
    }
?>