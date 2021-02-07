<?php
  
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  
?>

<div class="modal" id="person">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Gast hinzufügen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?php $form = ActiveForm::begin(['action' => ['guest/create']]); ?>

      <div class="modal-body">

        <?= $form->field($person, 'name'); ?>
        <?= $form->field($person, 'comment')->textarea(); ?>
        <?= $form->field($person, 'optional')->checkbox(); ?>
        
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        
        <?= Html::submitButton('Gast hinzufügen', ['class' => 'btn btn-primary']); ?>
        
      </div>
      
      <?php ActiveForm::end(); ?>
      
    </div>
  </div>
</div>