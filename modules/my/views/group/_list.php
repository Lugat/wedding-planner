<?php

  use yii\helpers\Html;

?>

<?php foreach ($groups as $group) : ?>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2 class="mb-0">
      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#group-<?= $group->id; ?>">
        <?= $group->title; ?>
      </button>
    </h2>
    <span class="badge badge-secondary">
      <span data-count="group-<?= $group->id; ?>">0</span>
    </span>
  </div>

  <div id="group-<?= $group->id; ?>" class="collapse">
    <div class="card-body">

      <?php if (!empty($group->comment)) : ?>
      <p class="card-text"><?= $group->comment; ?></p>
      <?php endif; ?>

      <?= $this->render('../guest/_list', ['people' => $group->people, 'count' => "group-{$group->id}", 'name' => "group[{$group->id}][]", 'color' => $group->color]); ?>

    </div>
    <div class="card-footer">

      <div class="btn-group">

        <?= Html::a('<i class="far fa-edit"></i>', ['group/update', 'id' => $group->id], ['class' => 'btn btn-sm btn-outline-primary']); ?>
        <?= Html::a('<i class="far fa-trash"></i>', ['group/delete', 'id' => $group->id], ['class' => 'btn btn-sm btn-outline-danger']); ?>

      </div>

    </div>
  </div>
</div>

<?php endforeach; ?>