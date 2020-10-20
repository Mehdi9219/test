<?php
$philo=0;
$maths=0;
$anglais=0;
$svt=0;
$sport=0;
$droit=0;
$coursPhilo;
$coursMaths;
$coursAnglais;
$coursSvt;
$coursSport;
$coursDroit;
function calculerDate()
{
    //pas de cours pendant les weekend
    $day=date('w');
    $message;
    if($day <= 5)
    {
        $message= date("d/m/yy");
    }
    else
    {
        if($day =6)
            {
                $message= Date('d/m/yy', strtotime('+3 days'));
            }
            else
                $message= Date('d/m/yy', strtotime('+3 days'));
    }
    echo $message;
}
function calculJours($cours){
    $jours="";
    if((int)$cours["lundi"]>0){
        $jours=$jours." Lundi,";
    }
    if((int)$cours["mardi"]>0){
        $jours=$jours." Mardi,";
    }
    if((int)$cours["mercredi"]>0){
        $jours=$jours." Mercredi,";
    }
    if((int)$cours["jeudi"]>0){
        $jours=$jours." Jeudi,";
    }
    if((int)$cours["vendredi"]>0){
        $jours=$jours." Vendredi,";
    }
    echo substr($jours,0,-1);
}
function affiche($cours){
    $day=date('w');
    switch ($day) {
        case 1:
            return (int)$cours["lundi"]>0;
            break;
        case 2:
            return (int)$cours["mardi"]>0;
            break;
        case 3:
            return (int)$cours["mercredi"]>0;
            break;
        case 4:
            return (int)$cours["jeudi"]>0;
            break;
        case 5:
            return (int)$cours["vendredi"]>0;
            break;
    }
}
function matiere($cours){
    switch ($cours["id"]) {
        case 1:
            $GLOBALS['coursPhilo']=$cours;
            $GLOBALS['philo']=affiche($cours);
            break;
        case 2:
            $GLOBALS['coursMaths']=$cours;
            $GLOBALS['maths']=affiche($cours);
            break;
        case 3:
            $GLOBALS['coursAnglais']=$cours;
            $GLOBALS['anglais']=affiche($cours);
            break;
        case 4:
            $GLOBALS['coursSvt']=$cours;
            $GLOBALS['svt']=affiche($cours);
            break;
        case 5:
            $GLOBALS['coursSport']=$cours;
            $GLOBALS['sport']=affiche($cours);
            break;
        case 6:
            $GLOBALS['coursDroit']=$cours;
            $GLOBALS['droit']=affiche($cours);
            break;
    }
}
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "teachr";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cours";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    matiere($row);
  }
} else {
  echo "0 results";
}
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>teachr</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Features-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search">
        <div class="container"><a class="navbar-brand" href="#">Teach'r</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#">Acceuil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Mes cours</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Mon profil</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="features-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Prochain Cours : <?php calculerDate(); ?></h2>
            </div>
            <div class="row features">
                <?php if($GLOBALS['philo']==1) : ?>
                    <div class="col-sm-6 col-lg-4 item"><i class="fa fa-pencil icon"></i>
                        <h3 class="name">Cours régulier de <?php echo $GLOBALS['coursPhilo']["libelle"] ?></h3>
                        <p class="description">Jours :<?php calculJours($GLOBALS['coursPhilo']) ?></p>
                        <p class="description">Fréquence : <?php echo $GLOBALS['coursPhilo']["frequence"] ?> par jour</p>
                        <p class="description">Professeur : <?php echo $GLOBALS['coursPhilo']["professeur"] ?></p>
                    </div>
                <?php endif; ?>
                <?php if($GLOBALS['maths']==1) : ?>
                    <div class="col-sm-6 col-lg-4 item"><i class="fa fa-calculator icon"></i>
                        <h3 class="name">Cours régulier de <?php echo $GLOBALS['coursMaths']["libelle"] ?><br><br></h3>
                        <p class="description">Jours: <?php calculJours($GLOBALS['coursMaths']) ?></p>
                        <p class="description">Fréquence: <?php echo $GLOBALS['coursMaths']["frequence"] ?> par jour</p>
                        <p class="description">Professeur: <?php echo $GLOBALS['coursMaths']["professeur"] ?></p>
                    </div>
                <?php endif; ?>
                <?php if($GLOBALS['anglais']==1) : ?>
                    <div class="col-sm-6 col-lg-4 item"><i class="fa fa-commenting-o icon"></i>
                        <h3 class="name">Cours régulier d'<?php echo $GLOBALS['coursAnglais']["professeur"] ?></h3>
                        <p class="description">Jours: <?php calculJours($GLOBALS['coursAnglais']) ?><br></p>
                        <p class="description">Fréquence: <?php echo $GLOBALS['coursAnglais']["frequence"] ?> par jour<br></p>
                        <p class="description">Professeur: <?php echo $GLOBALS['coursAnglais']["professeur"] ?><br></p>
                    </div>
                <?php endif; ?>
                <?php if($GLOBALS['svt']==1) : ?>
                    <div class="col-sm-6 col-lg-4 item"><i class="fa fa-medkit icon"></i>
                        <h3 class="name">Cours régulier <?php echo $GLOBALS['coursSvt']["libelle"] ?></h3>
                        <p class="description">Jours: <?php calculJours($GLOBALS['coursSvt']) ?><br></p>
                        <p class="description">Fréquence: <?php echo $GLOBALS['coursSvt']["frequence"] ?> par jour<br></p>
                        <p class="description">Professeur: <?php echo $GLOBALS['coursSvt']["professeur"] ?><br></p>
                    </div>
                <?php endif; ?>
                <?php if($GLOBALS['sport']==1) : ?>
                    <div class="col-sm-6 col-lg-4 item"><i class="fa fa-soccer-ball-o icon"></i>
                        <h3 class="name">Cours régulier <?php echo $GLOBALS['coursSport']["libelle"] ?></h3>
                        <p class="description">Jours: <?php calculJours($GLOBALS['coursSport']) ?><br></p>
                        <p class="description">Fréquence: <?php echo $GLOBALS['coursSport']["frequence"] ?> par jour<br></p>
                        <p class="description">Professeur: <?php echo $GLOBALS['coursSport']["professeur"] ?><br></p>
                    </div>
                <?php endif; ?>
                <?php if($GLOBALS['droit']==1) : ?>
                    <div class="col-sm-6 col-lg-4 item"><i class="fa fa-institution icon"></i>
                        <h3 class="name">Cours régulier <?php echo $GLOBALS['coursDroit']["libelle"] ?></h3>
                        <p class="description">Jours: <?php calculJours($GLOBALS['coursDroit']) ?><br></p>
                        <p class="description">Fréquence: <?php echo $GLOBALS['coursDroit']["frequence"] ?> par jour<br></p>
                        <p class="description">Professeur: <?php echo $GLOBALS['coursDroit']["professeur"] ?><br></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
