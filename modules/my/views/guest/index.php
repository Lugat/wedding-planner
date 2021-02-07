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
      <span class="badge badge-secondary">
        <span data-count="all">0</span> / <?= count($event->people); ?>
      </span>
    </div>
    
    <?= $this->render('_list', ['people' => $event->peopleWithoutGroup, 'color' => Yii::$app->params['defaultColor'], 'count' => 'all']); ?>
    
  </div>
  <div class="col-sm-6">
    
    <div class="d-flex justify-content-between align-items-center">
      <h4>Gruppen</h4>
      <span class="badge badge-secondary">
        <span data-count="group-<?= $group->id; ?>">0</span>
      </span>
    </div>
    
    <div class="accordion">

      <?= $this->render('../group/_list', ['groups' => $event->groups, 'count' => "group-{$group->id}"]); ?>

    </div>
    
  </div>
</div>

<?= Html::endForm(); ?>

<?= $this->render('../group/_create', ['group' => $group]); ?>

<?= $this->render('_create', ['person' => $person, 'event' => $event]); ?>