<?php
  
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($event, 'title'); ?>
<?= $form->field($event, 'comment')->textarea(); ?>

<?php foreach (Yii::$app->params['options'] as $key => $options) : ?>

<?= $form->field($event, "options[{$key}]")->textInput($options)->label(Yii::t('app/options', $key)); ?>

<?php endforeach; ?>

<?= Html::submitButton('erstellen', ['class' => 'btn btn-primary']); ?>

<?php ActiveForm::end();