<?php

  use yii\helpers\Html;

?>

<ul class="list-group sortable <?= count($people) === 0 ? 'empty' : ''; ?>" data-name="<?= $name ?? null; ?>" data-color="<?= $color ?? null; ?>" data-count="<?= $count; ?>">

  <?php foreach ($people as $person) : ?>

  <li class="list-group-item d-flex justify-content-between align-items-center" style="border-left:5px solid <?= $person->group->color ?? Yii::$app->params['defaultColor']; ?>">
    
    <input type="hidden" name="<?= $name ?? null; ?>" value="<?= $person->id; ?>">
    
    <span <?= empty($person->comment) ? '' : 'data-toggle="tooltip" title="'.$person->comment.'"'; ?>>
      <?= $person->name; ?>
      <?php if (!empty($person->comment)) : ?>
      <i class="far fa-comment text-primary"></i>
      <?php endif; ?>
    </span>
        
    <div class="btn-group">
            
      <?= Html::a('<i class="far fa-trash"></i>', ['guest/delete', 'id' => $person->id], ['rel' => 'ajax', 'class' => 'btn btn-sm btn-outline-danger']); ?>
    
    </div>
    
  </li>

  <?php endforeach; ?>

</ul>