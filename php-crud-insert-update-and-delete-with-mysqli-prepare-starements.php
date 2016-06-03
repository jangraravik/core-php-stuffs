<?php

 /* insert-update-and-delete-with-mysqli-prepare-starements */
// INSERT
$stmt = $mysqli->prepare("INSERT INTO movies(filmName,filmDescription,filmImage,filmPrice,filmReview) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param('sssdi',$_POST['filmName'],$_POST['filmDescription'],$_POST['filmImage'],$_POST['filmPrice'],$_POST['filmReview']);
$stmt->execute(); 
$stmt->close();

// Getting Auto Increment Key Values with insert_id
$stmt = $mysqli->prepare("INSERT INTO movies(filmName,filmDescription,filmImage,filmPrice,filmReview) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param('sssdi',$_POST['filmName'],$_POST['filmDescription'],$_POST['filmImage'],$_POST['filmPrice'],$_POST['filmReview']);
$stmt->execute();
$newId = $stmt->insert_id;
$stmt->close();

// UPDATE
$stmt = $mysqli->prepare("UPDATE movies SET filmName = ?,filmDescription = ?,filmImage = ?,filmPrice = ?,filmReview = ? WHERE filmID = ?");
$stmt->bind_param('sssdii',$_POST['filmName'],$_POST['filmDescription'],$_POST['filmImage'],$_POST['filmPrice'],$_POST['filmReview'],$_POST['filmID']);
$stmt->execute();
$stmt->close();

// DELETE
$stmt = $mysqli->prepare("DELETE FROM movies WHERE filmID = ?");
$stmt->bind_param('i',$_POST['filmID']);
$stmt->execute(); 
$stmt->close();