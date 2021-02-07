<?php
  
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($table, 'title'); ?>
<?= $form->field($table, 'comment')->textarea(); ?>
<?= $form->field($table, 'places')->textInput(['type' => 'number', 'min' => 2]); ?>

<?= Html::submitButton('Tisch aktualisieren', ['class' => 'btn btn-primary']); ?>

<?php ActiveForm::end();