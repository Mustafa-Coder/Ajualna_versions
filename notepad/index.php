<?php 
session_start();
// ---------------------
$PAGENAME = " Create Notes | JEEL "  ;
include './include.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../layout/images/logos.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../layout/css/all.min.css">
    <link rel="stylesheet" href="../layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="../layout/css/main.css">
    <link rel="stylesheet" href="../layout/css/animate.css">
    <title><?php title() ?></title>
</head>
<?php
$userid = $_SESSION['id'];
$college_session = $_SESSION['college']; 
$Userinformation = get_something("signup","*","WHERE userid = $userid ","fetch"); // get data users
?>
<body class="<?php echo $Userinformation['modes'] == 'dark'  ? "top" : " " ?>">
<?php include '../resources/templates/menu.php'; // navbar site  ?>
<!-- --------------------[START CODE ] -------------------------->
<div class="container mt-5 Notes ">
    <div class="row">
        <div class="col-lg-12"> 
            <div class="card  p-2 <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark " : " " ?>">
                <label for="title">Title Note: <span id="calcolate"></span></label>
                <input id="author" type="hidden" value="<?php echo $_SESSION['id'] ?>">
                <input id="title" class="form-control mb-2 <?php echo $Userinformation['modes'] == 'dark'  ? "input-text " : " " ?>" type="title" placeholder="title note..">
                <label for="contents">Content: <span id="calcolatecontent"></span></label>
                <textarea class="form-control mb-2 <?php echo $Userinformation['modes'] == 'dark'  ? "input-text " : " " ?>" id="content" cols="30" rows="10"></textarea>
                <button id="createnote" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
    <p class="text-center m-5 <?php echo $Userinformation['modes'] == 'dark'  ? "icons-co " : " " ?> ">JEEL Copyright &copy; <?php echo date("Y") ; ?> </p>
</div>
<!-- STYLE PAGE -->
<style>
.Notes .card
{
    width:650px;
    margin:auto;
    margin-top: 7rem!important;
}

.Notes .card label 
{
    font-weight:400;
}

.Notes .card .form-control
{
    border-radius:1px;
    border-bottom:2px solid rgb(0, 123, 255);

}

.Notes .card .btn-primary

{
    transition:.4s ease;
    width:120px;
}
.Notes .card .btn-primary:hover 
{
    transition:.4s ease;
    box-shadow:0 0 25px #5555;
}
</style>
<!-- END STYLE PAGE -->
<!-- --------------------[END  CODE ] -------------------------->

<?php include '../resources/templates/footer.php'; ?> 
<script>
$(function(){



    // This Var Before Check number : defualt 40
    var numwords = 40,
    calcolate = $("#calcolate").text(numwords);
    
    $("#title").on("keyup",function(){

            // When write more - 1 from title :
            var num = numwords -= 1,
            calcolate = $("#calcolate").text(num);

        // check if number 0 == 0 make title disabled: 
        if(num == 0){
            $("#title").attr("disabled",true);
        }

        if($("#title").val().length < 10){
            $("#title").css({"borderBottom":"2px solid red"});
        }else {
            $("#title").css({"borderBottom":"2px solid rgb(0, 123, 255)"});
        }

    


        
    });

    // This Var Before Check number : defualt 40
    var numwords2 = 65,
    calcolate = $("#calcolatecontent").text(numwords2);
    
    $("#content").on("keyup",function(){

            // When write more - 1 from title :
            var num2 = numwords2 -= 1,
            calcolate = $("#calcolatecontent").text(num2);

        // check if number 0 == 0 make title disabled: 
        if(num2 == 0){
            $("#content").attr("disabled",true);
        } 

   
        if($("#content").val().length < 10){
            $("#content").css({"borderBottom":"2px solid red"});
        }else {
            $("#content").css({"borderBottom":"2px solid rgb(0, 123, 255)"});
        }

    });



        $("#createnote").attr("disabled",false); // when the input is not empty 

        // start send data :
        $("#createnote").on("click",function(){

            let title = $("#title").val(),
                content = $("#content").val(),
                id = $("#author").val();

            $.ajax({

                method:'POST',
                url:'/Ajualna/data/settings.php',
                data:{"req":"Notes","title":title,"content":content,"id":id},
                success:function(d,s){

                    setTimeout(() => {window.location.href="main.php"}, 100);
                    
                }


            });


        });




    


});
</script>