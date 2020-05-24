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
$notepadme = get_something("mynotepad","*","WHERE author_id = $userid ","fetchAll"); // get data users
?>
<body class="<?php echo $Userinformation['modes'] == 'dark'  ? "top" : " " ?>">
<?php include '../resources/templates/menu.php'; // navbar site  ?>
<!-- --------------------[START CODE ] -------------------------->
<div class="container mt-5 Notes ">
    <h5 class="py-5 text-center <?php echo $Userinformation['modes'] == 'dark'  ? "icons-co " : " " ?>">See Your Notes</h5>
    <div class="row">
        <div class="col-lg-12">
            <div class="card  p-2 <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark " : " " ?>">
            <?php foreach($notepadme as $notes): ?>
                <div id="controlshownote" class="allnotes">
                    <div class="data">
                        <h3><?php echo $notes['note_title'] ?></h3>
                    </div>
                    <div id="control" class="control">
                        <button class="btn btn-danger btn-sm">Delete</button>
                        <button class="btn btn-info btn-sm">Edit</button>
                    </div>
                </div>
                
            <?php endforeach; ?>
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
    margin-top: 3rem!important;
}

.Notes .card .allnotes 
{
    transition:.5s ease;
    position:relative;
    padding: 8px;
    width: 100%;
    border-bottom:1px solid  rgb(75, 78, 93);
    cursor:pointer;
}

.Notes .card .allnotes:hover
{
    transition:.5s ease;
    background-color: rgba(204, 204, 204, 0.09);

}
.Notes .card .allnotes .data h3
{
    font-size:15px;
    width:500px;
}

.Notes .card .allnotes .control
{
    position:absolute;
    top:6px;
    right:11px;
    opacity:1;
}
.active 
{
    opacity:1 !important;
}
</style>
<!-- END STYLE PAGE -->
<!-- --------------------[END  CODE ] -------------------------->

<?php include '../resources/templates/footer.php'; ?> 
<script>
    $(function(){

            // var notescontorl = document.querySelectorAll(".control");
            
            

            // var notescontorl = document.querySelectorAll(".allnotes");
            
            // notescontorl.forEach(e => {

            //    e.addEventListener("mouseleave",function(){
            //         var allnotes = document.querySelectorAll(".control");
            //         allnotes.forEach((s) => {

                        
            //             s.classList.add("active");
                    
                    
            //         });
            //    });
                
            // });
       
       

    });
</script>

