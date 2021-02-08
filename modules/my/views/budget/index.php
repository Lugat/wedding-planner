<?php

  use yii\helpers\Html;

?>

<div class="d-flex justify-content-between align-items-center">

  <h2>Kosten</h2>

  <div class="btn-group">

    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#budget">Kostenpunkt hinzufügen</button>

  </div>

</div>

<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Titel</th>
      <th>Preis (einzeln)</th>
      <th>Preis (gesamt)</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    
    <?php
    
      $total = 0;
    
      foreach ($event->budgets as $i => $budget) :
        
        $total += $budget->totalPrice;
    
    ?>
    
    <tr>
      <th><?= $i+1; ?></th>
      <td><?= $budget->title; ?></td>
      <td><?= Yii::$app->formatter->asCurrency($budget->price, $event->options['currency']); ?></td>
      <td><?= Yii::$app->formatter->asCurrency($budget->totalPrice, $event->options['currency']); ?></td>
      <td class="text-right">
        
        <div class="btn-group">

          <?= Html::a('<i class="far fa-edit"></i>', ['update', 'id' => $budget->id], ['class' => 'btn btn-sm btn-outline-primary']); ?>
          <?= Html::a('<i class="far fa-trash"></i>', ['delete', 'id' => $budget->id], ['class' => 'btn btn-sm btn-outline-danger']); ?>

        </div>
        
      </td>
    </tr>
    
    <?php
        
      endforeach;
      
      $diff = $event->options['budget'] - $total;
    
    ?>
    
  </tbody>
  <tfoot>
    
    <tr>
      <td colspan="2"></td>
      <th>Gesamt</th>
      <td><?= Yii::$app->formatter->asCurrency($total, $event->options['currency']); ?></td>
      <td></td>
    </tr>
    
    <?php if ($diff > 0) : ?>
    
    <tr class="table-success">
      <td colspan="2"></td>
      <th>Freies Budget</th>
      <td><?= Yii::$app->formatter->asCurrency($diff, $event->options['currency']); ?></td>
      <td></td>
    </tr>
    
    <?php elseif ($diff < 0) : ?>
    
    <tr class="table-danger">
      <td colspan="2"></td>
      <th>Über Budget</th>
      <td><?= Yii::$app->formatter->asCurrency(abs($diff), $event->options['currency']); ?></td>
      <td></td>
    </tr>
    
    <?php endif; ?>
    
  </tfoot>
</table>

<?= $this->render('_create', ['budget' => $budget]);