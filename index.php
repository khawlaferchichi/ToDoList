<?php
$taskes = [
    // [
    //     "title" => "payer la facture",
    //     "description" => "payer la facture du STEG",
    //     "date" => "10/09/2022",
    //     "priority" => "haute"
    // ],
    // [
    //     "title" => "shopping",
    //     "description" => "acheter des vetements", "date" => "11/10/2022",
    //     "priority" => "normale"
    // ],
    // [
    //     "title" => "voyage",
    //     "description" => "voyage pour tourisme", "date" => "05/03/2023",
    //     "priority" => "basse"
    // ]
];

function loadAllTasks()
{
    $tab = array();
    $file = fopen("tasks.csv", "r");
    while ($ligne = fgetcsv($file)) {
        array_push($tab, $ligne);
    }
    fclose($file);
    return $tab;
};
function saveAllTasks($newtasks)
{
    $f = fopen("tasks.csv",'w');
    for ($i=0; $i < count($newtasks) ; $i++) { 
        fputcsv($f, $newtasks[$i]);
    }
    fclose($f);
    
}





// array_push($tascks, $tasck);
function ajoutFichier()
{

    $file = fopen("tasks.csv", "a");
    $task = [
        $_POST['title'],
        $_POST['descreption'],
        $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'],
        $_POST['priority'],
    ];
    fputcsv($file, $task);
    fclose($file);
    //array_push($tascks, $tasck);
}

if (array_key_exists('enregistrer', $_POST)) {
    // $tasck = [
    //     $_POST['title'],
    //     $_POST['descreption'],
    //     $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'],
    //     $_POST['priority'],
    // ];
    // var_dump($tasck);
    ajoutFichier();
    header("Location:index.php");
    // $tascks = chargerFichier();
}
//$indexes=[2,3];

if (array_key_exists('indexes', $_POST)) 
{
    $newtasks=[];
    //var_dump($_POST["indexes"]);
    //die();
    $taskes=loadAllTasks();
    //var_dump($taskes);die();
    for ($i = 0; $i < count($taskes); $i++)
     {
        if (!in_array($i, $_POST['indexes'])) 
        {
            array_push($newtasks, $taskes[$i]);
        }
       
    }
    saveAllTasks($newtasks);
    header("Location:index.php");
}

 




$taskes = loadAllTasks();
include 'index.phtml';
?>