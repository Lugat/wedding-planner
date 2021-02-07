<?php
  
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  
?>

<h3>Allgemein</h3>

<p class="lead">Deine ID lautet: <span class="badge badge-primary"><?= $event->uid; ?></span></p>

<hr />

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($event, 'title'); ?>
<?= $form->field($event, 'comment')->textarea(); ?>

<?php foreach (Yii::$app->params['options'] as $key => $options) : ?>

<?= $form->field($event, "options[{$key}]")->textInput($options)->label(Yii::t('app/options', $key)); ?>

<?php endforeach; ?>

<?= Html::submitButton('speichern', ['class' => 'btn btn-primary']); ?>

<?php ActiveForm::end(); ?>



