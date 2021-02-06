<ul class="list-group sortable <?= count($people) === 0 ? 'empty' : ''; ?>" data-name="<?= $name ?? null; ?>" data-color="<?= $color ?? null; ?>">

  <?php foreach ($people as $person) : ?>

  <li class="list-group-item d-flex justify-content-between align-items-center" style="border-left:5px solid <?= $person->group->color ?? Yii::$app->params['defaultColor']; ?>">
    
    <input type="hidden" name="<?= $name ?? null; ?>" value="<?= $person->id; ?>">
    
    <span <?= empty($person->comment) ? '' : 'data-toggle="tooltip" title="'.$person->comment.'"'; ?>>
      <?= $person->name; ?>
      <?php if (!empty($person->comment)) : ?>
      <i class="far fa-comment text-primary"></i>
      <?php endif; ?>
    </span>
    
    <?php if ($showActionButtons === true) : ?>
    
    <div class="btn-group">
    
      <button type="button" name="edit" value="<?= $person->id; ?>" class="btn btn-sm btn-outline-primary">
        <i class="far fa-edit"></i>
      </button>
      
      <button type="button" name="delete" value="<?= $person->id; ?>" class="btn btn-sm btn-outline-danger">
        <i class="far fa-trash"></i>
      </button>
    
    </div>
    
    <?php endif; ?>
    
  </li>

  <?php endforeach; ?>

</ul>