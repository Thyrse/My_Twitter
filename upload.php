<?php
if(isset($_FILES['avatar']))
{

/*	$repository = 'images/upload/';*/
	$files = basename($_FILES['avatar']['name']);
	$sizeMax = 1000000;
	$size = filesize($_FILES['avatar']['tmp_name']);
	$arrayExtensions = array('.png', '.gif', '.jpg', '.jpeg');
	$extension = strrchr($_FILES['avatar']['name'], '.');
	if(!in_array($extension, $arrayExtensions)) // Si l'extension n'est pas dans le tableau
		$erreur = 'Vous devez upload un fichier de type png, gif, jpg, jpeg !';
	if($size > $sizeMax)
		$erreur = 'Le fichier est trop gros...';
	if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
	{
		$files = strtr($files,
			'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
			'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
/*		$files = preg_replace('/([^.a-z0-9]+)/i', '-', $files);*/
		if(move_uploaded_file($_FILES['avatar']['tmp_name'], $files))
			echo 'Upload effectué avec succès !';
		else
			echo "Echec de l'upload !";
	}
	else
		echo $erreur;
}
?>