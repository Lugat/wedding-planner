<?php
  
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  
?>

<div class="modal" id="budget">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kostenpunkt hinzufügen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?php $form = ActiveForm::begin(['action' => ['create']]); ?>

      <div class="modal-body">

        <?= $form->field($budget, 'title'); ?>
        <?= $form->field($budget, 'price')->textInput(['type' => 'number', 'min' => 0]); ?>
        <?= $form->field($budget, 'per_person')->checkbox(); ?>
        
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        
        <?= Html::submitButton('Kostenpunkt hinzufügen', ['class' => 'btn btn-primary']); ?>
        
      </div>
      
      <?php ActiveForm::end(); ?>
      
    </div>
  </div>
</div>