<?php foreach ($groups as $group) : ?>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2 class="mb-0">
      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#group-<?= $group->id; ?>">
        <?= $group->title; ?>
      </button>
    </h2>
    <span class="badge badge-secondary"><?= count($group->people); ?></span>
  </div>

  <div id="group-<?= $group->id; ?>" class="collapse" data-parent="#groups">
    <div class="card-body">

      <?php if (!empty($group->comment)) : ?>
      <p class="card-text"><?= $group->comment; ?></p>
      <?php endif; ?>

      <?= $this->render('_people', ['people' => $group->people, 'name' => "group[{$group->id}][]", 'color' => $group->color, 'showActionButtons' => false]); ?>

    </div>
  </div>
</div>

<?php endforeach; ?>