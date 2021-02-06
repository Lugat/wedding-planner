<?php

  use yii\helpers\Html;
  
?>

<div class="row">
  <div class="col-sm-6">

    <h2>Schon dabei?</h2>
    
    <p>Trage deine ID ein und fahre mit der Organisation fort.</p>

    <?= Html::beginForm(); ?>

    <div class="form-group">
      <?= Html::textInput('uid', null, ['class' => 'form-control']); ?>
    </div>

    <?= Html::submitButton('Event laden', ['name' => 'load', 'class' => 'btn btn-block btn-outline-primary']); ?>

    <?= Html::endForm(); ?>

  </div>
  <div class="col-sm-6">

    <h2>Noch nicht dabei?</h2>
    
    <p>Fange jetzt an, deine Hochzeit zu planen.</p>

    <?= Html::a('Jetzt erstellen', ['event/create'], ['class' => 'btn btn-block btn-primary']); ?>

  </div>
</div>