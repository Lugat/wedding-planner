<?php

  use yii\helpers\Html;

?>

<ul class="list-group sortable <?= count($people) === 0 ? 'empty' : ''; ?>" data-name="<?= $name ?? null; ?>" data-color="<?= $color ?? null; ?>" data-count="<?= $count; ?>">

  <?php foreach ($people as $person) : ?>

  <li class="list-group-item d-flex justify-content-between align-items-center <?= $person->optional ? 'optional' : ''; ?>" style="border-left:5px solid <?= $person->group->color ?? Yii::$app->params['defaultColor']; ?>">
    
    <input type="hidden" name="<?= $name ?? null; ?>" value="<?= $person->id; ?>">
    
    <span <?= empty($person->comment) ? '' : 'data-toggle="tooltip" title="'.$person->comment.'"'; ?>>
      
      <?php if ($person->confirmed) : ?>
      <i class="far fa-check text-primary"></i>
      <?php endif; ?>
      
      <?= $person->name; ?>
      
      <?php if (!empty($person->comment)) : ?>
      <i class="far fa-comment text-primary"></i>
      <?php endif; ?>

      <?php if ($person->child) : ?>
      <i class="far fa-baby text-primary"></i>
      <?php endif; ?> 
      
    </span>
        
    <div class="btn-group">
      
      <?= Html::a('<i class="far fa-edit"></i>', ['guest/update', 'id' => $person->id], ['class' => 'btn btn-sm btn-outline-primary']); ?>
      <?= Html::a('<i class="far fa-trash"></i>', ['guest/delete', 'id' => $person->id], ['rel' => 'ajax', 'class' => 'btn btn-sm btn-outline-danger']); ?>
    
    </div>
    
  </li>

  <?php endforeach; ?>

</ul>