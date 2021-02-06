<?php

  use yii\helpers\Html;

?>

<div class="d-flex justify-content-between align-items-center">

  <h2>Gästeliste</h2>

  <div class="btn-group">

    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#person">Gast hinzufügen</button>
    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#group">Gruppe erstellen</button>

  </div>

</div>

<hr />

<?= Html::beginForm(null, 'post', ['class' => 'update']); ?>

<div class="row">
  <div class="col-sm-6">
    
    <div class="d-flex justify-content-between align-items-center">
      <h4>Gäste</h4>
      <span class="badge badge-secondary"><?= count($event->peopleWithoutGroup); ?> / <?= count($event->people); ?></span>
    </div>
    
    <?= $this->render('list/_people', ['people' => $event->peopleWithoutGroup, 'color' => Yii::$app->params['defaultColor'], 'showActionButtons' => true]); ?>
    
  </div>
  <div class="col-sm-6">
    
    <div class="d-flex justify-content-between align-items-center">
      <h4>Gruppen</h4>
      <span class="badge badge-secondary"><?= count($event->groups); ?></span>
    </div>
    
    <div class="accordion" id="groups">

      <?= $this->render('list/_groups', ['groups' => $event->groups]); ?>

    </div>
    
  </div>
</div>

<?= Html::endForm(); ?>

<?= $this->render('modal/_group', ['group' => $group]); ?>

<?= $this->render('modal/_person', ['person' => $person, 'event' => $event]); ?>