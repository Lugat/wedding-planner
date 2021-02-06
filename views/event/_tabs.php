<?php

  use yii\bootstrap4\Nav;

?>

<?= Nav::widget([
  'options' => ['class' => 'nav nav-tabs'],
  'encodeLabels' => false,
  'items' => [
    ['label' => 'Allgemein', 'url' => ['index', 'uid' => $event->uid, 'tab' => 'general']],
    ['label' => 'Gäste', 'url' => ['index', 'uid' => $event->uid, 'tab' => 'guests']],
    ['label' => 'Tische', 'url' => ['index', 'uid' => $event->uid, 'tab' => 'tables']]
  ]
]);