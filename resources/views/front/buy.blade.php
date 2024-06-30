<?php
$categories=[1=>'MAN',2=>'WOMEN'];
?>
@extends('layouts.master')

@section('content')
<div class="text-center p-5 shadow-sm">
            <h1 class="text-success">Success</h1>
            <h3 class="mb-4">Produit : <?php echo ($_GET["name"])?></h3>
            <p><span class="fw-bold">Catégorie :</span> <?php echo ($_GET["genre"])?></p>
            <p class="fw-bold">Taille : <span class="text-secondary"><?php echo ($_GET["size"])?> </span></p>
            <p class="fw-bold">Prix : <span class="text-secondary"><?php echo ($_GET["price"])?></span></p>
</div>
@endsection 