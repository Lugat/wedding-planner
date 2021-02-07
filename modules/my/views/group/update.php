<?php
  
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($group, 'title'); ?>
<?= $form->field($group, 'comment')->textarea(); ?>
<?= $form->field($group, 'color')->textInput(['type' => 'color']); ?>

<?= Html::submitButton('Gruppe aktualisieren', ['class' => 'btn btn-primary']); ?>

<?php ActiveForm::end();