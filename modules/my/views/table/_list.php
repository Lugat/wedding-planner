<?php

  use yii\helpers\Html;

?>

<?php foreach ($tables as $table) : ?>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2 class="mb-0">
      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#table-<?= $table->id; ?>">
        <?= $table->title; ?>
      </button>
    </h2>
    <span class="badge">
      <span data-count="table-<?= $table->id; ?>">0</span> / <?= $table->places; ?>
    </span>
  </div>

  <div id="table-<?= $table->id; ?>" class="collapse">
    <div class="card-body">

      <?php if (!empty($table->comment)) : ?>
      <p class="card-text"><?= $table->comment; ?></p>
      <?php endif; ?>

      <?= $this->render('../guest/_list', ['people' => $table->people, 'name' => "table[{$table->id}][]", 'count' => "table-{$table->id}"]); ?>

    </div>
    <div class="card-footer">

      <div class="btn-group">

        <?= Html::a('<i class="far fa-trash"></i>', ['table/delete', 'id' => $table->id], ['class' => 'btn btn-sm btn-outline-danger']); ?>

      </div>

    </div>
  </div>
  
</div>

<?php endforeach; ?>