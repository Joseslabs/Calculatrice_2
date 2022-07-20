<?php
    session_start();
    if(!isset($_SESSION["histo"]) && !isset($_SESSION["ans"])){
        $_SESSION["histo"]= array();
        $_SESSION["ans"]="";
    }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale= 1">
        <link rel="stylesheet" href="index.css">
        <title>calculator.com</title>
    </head>
    <?php
        if(isset($_POST['run']) && isset($_POST['n1']) && isset($_POST['n2']) && $_POST['n1'] !="" && $_POST['n2'] !=""){
            $n1=$_POST["n1"];
            $n2=$_POST["n2"];
            $ope=$_POST["run"];
            switch($ope){
                case '+':
                    $ans = $n1+$n2;
                break;
                case '-':
                    $ans = $n1-$n2;
                break;
                case '×':
                    $ans = $n1*$n2;
                break;
                case '/':
                    if($n2 != 0)
                        $ans = $n1/$n2;
                    else{
                        $ans= "Syntax error";
                        $n1=0;
                        $n2=0;
                    }
                break;
                case '%':
                    if($n2 != 0)
                        $ans = $n1%$n2;
                    else{
                        $ans= "Syntax error";
                        $n1=0;
                        $n2=0;
                    }
                break;
                case 'Ans':
                    if($n1==0 && $n2==0 && isset($_SESSION["ans"]) && $_SESSION["ans"]!=""){
                        $n1 = $_SESSION["ans"];
                        $n2 = 0;
                        array_push($_SESSION["histo"],"Ans = ".$_SESSION["ans"]);
                    }
                    /*if($_SESSION["ans"]=="" || $_SESSION["ans"]="Syntax error"){
                        $n1 = 0;
                        $n2 = 0;
                    }*/
                break;
                default:
                    $ans= "Syntax error";
                    $n1=0;
                    $n2=0;
                break;
            }
            if($ope != "Ans"){
                array_push($_SESSION["histo"],$n1." ".$ope." ".$n2." = ".$ans);
                $n1=0;
                $n2=0;
            }
            if(isset($ans))
                $_SESSION["ans"]=$ans;
        }
    ?>
    <body>
        <div class="container">
            <div class="calc">
                <h1>Calculator.com</h1><br>
                <form class="" action="index.php" method="post">
                    1<sup>ère</sup> opérande : <input type="number" name="n1" value=<?php if(isset($n1)) echo $n1;else echo 0;?> placeholder="0"><br><br>
                    2<sup>ème</sup> opérande : <input type="number" name="n2" value=<?php if(isset($n2)) echo $n2;else echo ""?> placeholder="0"><br><br>
                    <input type="submit" name="run" value="+">
                    <input type="submit" name="run" value="-">
                    <input type="submit" name="run" value="×">
                    <input type="submit" name="run" value="/">
                    <input type="submit" name="run" value="%"><br><br>
                    Résultat : <input type="text" value="<?php if(isset($ans)) echo $ans;else echo "";?>" placeholder="ANS = ">
                    <input type="submit" name="run" value="Ans">
                </form>
            </div>
            <div class="histo">
                <h2>Historique des calculs</h2><br>
                Ici s'affiche l'historique des calculs effectués :<br><br>
                <?php if(isset($_SESSION["histo"])){foreach(array_reverse($_SESSION["histo"]) as $val) echo $val."<br><br>" ;}?>
            </div>
        </div>
        <footer>Done by Franck and Ramziath © Copyright 2022.</footer>
    </body>
</html>
