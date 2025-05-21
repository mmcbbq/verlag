<?php
$authoren = $data['authors']
?>

<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>
</head>

<style>



</style>
<body style='background-color: deepskyblue'>
<div>
    <?php
    foreach ($authoren as $author) {
        $flage = "<div style='background-color: white; width: 200px; height: 20px'></div>";
        if ($author->getCountry() === 'USA') {
            $flage = "<div style='display: inline-grid; grid-template-columns: 40px 160px '>";
            $flage .= "<div style='background-color: blue;grid-row-start: 1; grid-row-end: 3 ; width: 200px; height: 30px'></div>";
            $flage .= "<div style='background-color: red; width: 160px; height: 15px'> </div> ";
            $flage .= "<div style='background-color: white; width: 160px; height: 15px'> </div>";
            $flage .= "<div style='background-color: red; grid-column-start: 1; grid-column-end: 3 ; width: 200px; height: 15px'> </div>";
            $flage .= "<div style='background-color: white; grid-column-start: 1; grid-column-end: 3 ; width: 200px; height: 15px'> </div>";
            $flage .= "</div>";


            $color = 'blue';
        } elseif ($author->getCountry() === 'Deutschland') {
            $flage = "<div style='background-color: black; width: 200px; height: 20px'></div>";
            $flage .= "<div style='background-color: red; width: 200px; height: 20px'></div>";
            $flage .= "<div style='background-color: yellow; width: 200px; height: 20px'></div>";

            $color = 'yellow';
        } elseif ($author->getCountry() === 'Türkei') {
            $flage = "<div style='background-color: red; width: 200px;  height: 60px'>
<div  style='position: relative; top: 35%;left: 45% ;  width: 20px;height: 20px; border-width: 20px; background-color: white;border-radius: 10px '>

</div></div>";

        }
        echo '<div  style="border: 2px red solid; width: 200px">';
        echo $author->getFname() . ' ' . $author->getLname() . '<br>';
        echo 'alter in Tagen' . date_diff($author->getBday(), new DateTime('now'))->format('%a') . '<br>';
        echo $author->getCountry()."<br>";
        echo $flage;
        echo '</div><br>';
    }
    ?>
</div>
</body>
</html>
