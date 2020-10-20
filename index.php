<?php
$conn;
$result;
$sql;
$row;
function calculerDate()
{
    //pas de cours pendant les weekend
    $day=date('w');
    $message;
    if($day <= 5)
        $message= date("d/m/yy");
    else
        if($day =6)
                $message= Date('d/m/yy', strtotime('+2 days'));
            else
                $message= Date('d/m/yy', strtotime('+1 days'));
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
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "teachr";
// Create connection
$GLOBALS['$conn'] = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($GLOBALS['$conn']->connect_error) {
  die("Connection failed: " . $GLOBALS['$conn']->connect_error);
}

$GLOBALS['$sql'] = "SELECT * FROM cours";
$GLOBALS['$result'] = $GLOBALS['$conn']->query($GLOBALS['$sql']);
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
            <?php if ($GLOBALS['$result']->num_rows > 0) : while($GLOBALS['$row'] = $GLOBALS['$result']->fetch_assoc()) {?>
                <?php if( affiche($GLOBALS['$row'])) : ?>
                    <div class="col-sm-6 col-lg-4 item"><i class="<?php echo $GLOBALS['$row']["icone"] ?>"></i>
                        <h3 class="name">Cours régulier <?php echo $GLOBALS['$row']["libelle"] ?></h3>
                        <p class="description">Jours: <?php calculJours($GLOBALS['$row']) ?><br></p>
                        <p class="description">Fréquence: <?php echo $GLOBALS['$row']["frequence"] ?> par jour<br></p>
                        <p class="description">Professeur: <?php echo $GLOBALS['$row']["professeur"] ?><br></p>
                    </div>
                <?php endif; ?>
            <?php } endif; ?>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php $GLOBALS['$conn']->close(); ?>