<?php 
include 'init.php';

//     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
//         $sr = $_POST['search'];

//         // $sta = $con->prepare("SELECT * FROM signup WHERE username LIKE '%{$sr}%' ");
//         // $sta->execute();
//         // $row = $sta->fetchAll();

//      Search("*","pages","WHERE pagename ",$sr);


//     }

// ?>


<!-- // <form action="<?php  echo $_SERVER['PHP_SELF']; ?>" method="post"> -->
    <!-- <input type="text" name="search" >
     <input type="submit" value="search">
 </form>
 -->
 <?php  

// foreach ($search as $user) {
//     echo $user['pagename'];
// }\

?>

<?php 
function getLinkvideos($url){

    $youtubelink = "http://www.youtube.com/oembed?url=". $url ."&format=json";
    $curl = curl_init($youtubelink);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec($curl);
    curl_close($curl);
    return json_decode($ret, true) ;
}


print_r(getLinkvideos("https://www.youtube.com/watch?v=66_rXS938mQ&list=PLDoPjvoNmBAxXTPncg0W4lhVS32LO_xtQ&index=6"));


?>


