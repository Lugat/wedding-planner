<?php

  use yii\helpers\Html;

?>

<div class="d-flex justify-content-between align-items-center">
  
  <h2>Tische</h2>

  <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#table">Tisch erstellen</button>

</div>

<hr />

<?= Html::beginForm(null, 'post', ['class' => 'update']); ?>

<div class="row">
  <div class="col-sm-6">
    
    <div class="d-flex justify-content-between align-items-center">
      <h4>Gäste</h4>
      <span class="badge">
        <span data-count="all"><?= count($event->peopleWithoutTable); ?></span> / <?= count($event->people); ?>
      </span>
    </div>
    
    <?= $this->render('../guest/_list', ['people' => $event->peopleWithoutTable, 'count' => 'all']); ?>
    
  </div>
  <div class="col-sm-6">
    
    <div class="d-flex justify-content-between align-items-center">
      <h4>Tische</h4>
      <span class="badge badge-secondary">
        <?= count($event->tables); ?>
      </span>
    </div>
    
    <h4></h4>
    
    <div class="accordion" id="tables">

      <?= $this->render('_list', ['tables' => $event->tables]); ?>

    </div>
    
  </div>
</div>

<?= Html::endForm(); ?>

<?= $this->render('_create', ['table' => $table]);