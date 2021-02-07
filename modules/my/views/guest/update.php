<?php
  
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($person, 'name'); ?>
<?= $form->field($person, 'comment')->textarea(); ?>
<?= $form->field($person, 'optional')->checkbox(); ?>
<?= $form->field($person, 'child')->checkbox(); ?>
<?= $form->field($person, 'confirmed')->checkbox(); ?>

<?= Html::submitButton('Gast aktualisieren', ['class' => 'btn btn-primary']); ?>

<?php ActiveForm::end();