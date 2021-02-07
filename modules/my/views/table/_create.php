<?php
  
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  
?>

<div class="modal" id="table">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tisch erstellen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?php $form = ActiveForm::begin(['action' => ['table/create']]); ?>

      <div class="modal-body">

      <?= $form->field($table, 'title'); ?>
      <?= $form->field($table, 'comment')->textarea(); ?>
      <?= $form->field($table, 'places')->textInput(['type' => 'number', 'min' => 2]); ?>
        
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        
        <?= Html::submitButton('Tisch erstellen', ['class' => 'btn btn-primary']); ?>
        
      </div>
      
      <?php ActiveForm::end(); ?>
      
    </div>
  </div>
</div>