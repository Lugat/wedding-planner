<?php
  
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($budget, 'title'); ?>
<?= $form->field($budget, 'price')->textInput(['type' => 'number', 'min' => 0]); ?>
<?= $form->field($budget, 'per_person')->checkbox(); ?>

<?= Html::submitButton('Kostenpunkt aktualisieren', ['class' => 'btn btn-primary']); ?>

<?php ActiveForm::end();