<?php
$philo=0;
$maths=0;
$anglais=0;
$svt=0;
$sport=0;
$droit=0;
$coursPhilo;
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
            $GLOBALS['maths']=affiche($cours);
            break;
        case 3:
            $GLOBALS['anglais']=affiche($cours);
            break;
        case 4:
            $GLOBALS['svt']=affiche($cours);
            break;
        case 5:
            $GLOBALS['sport']=affiche($cours);
            break;
        case 6:
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
                <h2 class="text-center">Prochain Cours : le lundi 19 Octobre</h2>
            </div>
            <div class="row features">
                <?php if($GLOBALS['philo']==1) : ?>
                    <div class="col-sm-6 col-lg-4 item"><i class="fa fa-pencil icon"></i>
                        <h3 class="name">Cours régulier de Philosophie</h3>
                        <p class="description">Jours :<?php calculJours($GLOBALS['coursPhilo']) ?></p>
                        <p class="description">Fréquence : <?php echo $GLOBALS['coursPhilo']["frequence"] ?> par jour</p>
                        <p class="description">Professeur : <?php echo $GLOBALS['coursPhilo']["professeur"] ?></p>
                    </div>
                <?php endif; ?>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-calculator icon"></i>
                    <h3 class="name">Cours régulier de Maths<br><br></h3>
                    <p class="description">Jours: Lundi,Mardi,Jeudi</p>
                    <p class="description">Fréquence: 2H par jour</p>
                    <p class="description">Professeur: Mme Antone</p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-commenting-o icon"></i>
                    <h3 class="name">Cours régulier d'Anglais</h3>
                    <p class="description">Jours: Lundi,Mardi,Jeudi<br></p>
                    <p class="description">Fréquence: 2H par jour<br></p>
                    <p class="description">Professeur: Mme Claude De Bau<br></p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-medkit icon"></i>
                    <h3 class="name">Cours régulier SVT</h3>
                    <p class="description">Jours: Lundi,Mardi,Jeudi<br></p>
                    <p class="description">Fréquence: 2H par jour<br></p>
                    <p class="description">Professeur: Mr Leboeuf<br></p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-soccer-ball-o icon"></i>
                    <h3 class="name">Cours régulier Sport</h3>
                    <p class="description">Jours: Lundi,Mardi,Jeudi<br></p>
                    <p class="description">Fréquence: 2H par jour<br></p>
                    <p class="description">Professeur: Mr. Schneider<br></p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-institution icon"></i>
                    <h3 class="name">Cours régulier droit</h3>
                    <p class="description">Jours: Lundi,Mardi,Jeudi<br></p>
                    <p class="description">Fréquence: 2H par jour<br></p>
                    <p class="description">Professeur: Mme. Gastand<br></p>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>