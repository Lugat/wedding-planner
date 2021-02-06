<?php foreach ($tables as $table) : ?>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2 class="mb-0">
      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#table-<?= $table->id; ?>">
        <?= $table->title; ?>
      </button>
    </h2>
    <span class="badge badge-<?= $table->state; ?>"><?= count($table->people); ?> / <?= $table->places; ?></span>
  </div>

  <div id="table-<?= $table->id; ?>" class="collapse" data-parent="#tables">
    <div class="card-body">

      <?php if (!empty($table->comment)) : ?>
      <p class="card-text"><?= $table->comment; ?></p>
      <?php endif; ?>

      <?= $this->render('_people', ['people' => $table->people, 'name' => "table[{$table->id}][]", 'showActionButtons' => false]); ?>

    </div>
  </div>
</div>

<?php endforeach; ?>