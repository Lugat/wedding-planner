<?php
  
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  
?>

<div class="modal" id="group">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Gruppe erstellen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?php $form = ActiveForm::begin(); ?>

      <div class="modal-body">

        <?= $form->field($group, 'title'); ?>
        <?= $form->field($group, 'comment')->textarea(); ?>
        <?= $form->field($group, 'color')->textInput(['type' => 'color']); ?>
        
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        
        <?= Html::submitButton('Gruppe erstellen', ['class' => 'btn btn-primary']); ?>
        
      </div>
      
      <?php ActiveForm::end(); ?>
      
    </div>
  </div>
</div>