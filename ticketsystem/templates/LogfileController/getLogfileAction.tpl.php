<?php
$rang = intval($_GET['rang']);
$supporter = $_GET['supporter'];
?>
<a href="index.php?action=zeige&amp;rang=<?php echo $rang ?>&amp;supporter=<?php echo $supporter ?>">Zur Startseite</a>

<?php
require_once 'src/Entities/Logfile.Class.php';

$log->setDatum();
$log->setFormat('txt');
$log->setDateiName();
$log->setInput();
$log->setDatei();
$log->setInhalt();
echo'<pre/>';
echo $log->getInhalt();

