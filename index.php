<?php 
session_start();
if(isset($_SESSION['user']))
{
    session_destroy();
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="libs/css/materialize.min.css"  media="screen,projection"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<script src="libs/js/jquery-3.1.0.min.js"></script>
</head>
<body>
<nav>
        <div class="nav-wrapper indigo darken-4">
          <a href="#" class="brand-logo center">Welcome!</a>
        </div>
      </nav>
        <div class="container">

            <div class="row">
              <div class="col m6 offset-m3">
               <br>
               <br>
               <br>
                <div class="card-panel">
                  <div class="row">
                    <form action="login.php" class="col s12" id="login">
                        <center><h4>LOGIN</h4></center>
                        <hr>
                         <br>
                      <div class="row">
                        
                        <div class="input-field col m8 offset-m2">
                          <i class="material-icons prefix">account_circle</i>
                          <input id="icon_prefix" name="uname" type="text" class="validate">
                          <label for="icon_prefix">User Name: </label>
                        </div>
                        <div class="input-field col m8 offset-m2">
                          <i class="material-icons prefix">fingerprint</i>
                          <input id="icon_telephone" name="pword" type="password" class="validate">
                          <label for="icon_telephone">Password: </label>
                        </div>
                        <center>
                            <button class="btn waves-effect waves-light indigo darken-4" type="submit" name="action">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </center>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>


<script type="text/javascript" src="libs/js/materialize.min.js"></script>
<script>
    $( "#login" ).submit(function( event ) {

        // Stop form from submitting normally
        event.preventDefault();

        // Get some values from elements on the page:
        var $form = $(this),
        pword = $form.find("input[name='pword']").val(),
        uname = $form.find("input[name='uname']").val(),
        url = $form.attr("action");
        // Send the data using post
        var posting = $.post(url,{username:uname,password:pword});

        // Put the results in a div
        posting.done(function(data) {
//          //var content = $(data).find("#content");
            if(data == 'OK'){
                 Materialize.toast('Access Granted!', 4000);
                 window.location.assign('redirect.php'); 
            }
            //$("#result").empty().append(content);
            else{
                 Materialize.toast('Access Denied!', 4000)
                    $("#uname").val("");
                    $("#pword").val("");    
            }
        });
    });
</script>
</body>
</html>
        