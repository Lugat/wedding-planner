<?php

  use yii\helpers\Url;
  use yii\helpers\Html;
  use yii\bootstrap4\Nav;
  
  use app\assets\AppAsset;
  use app\widgets\AlertMessages;
  
  AppAsset::register($this);
    
  $this->beginPage();
  
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
  <head>
    <meta charset="<?= Yii::$app->charset; ?>" />
    <?= Html::csrfMetaTags(); ?>
    <title><?= Yii::$app->id; ?> - <?= Html::encode(strip_tags($this->title)); ?></title>
    <?php $this->head(); ?>
  </head>
  <body>
    
    <?php $this->beginBody(); ?>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">

        <a class="navbar-brand" href="<?= Url::home(); ?>"><?= Yii::$app->id; ?></a>

        <?php if (isset($this->context->event)) : ?>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">

          <?= Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'encodeLabels' => false,
            'items' => [
              ['label' => '<i class="far fa-cog"></i> Allgemein', 'url' => ['index', 'uid' => $this->context->event->uid, 'tab' => 'general']],
              ['label' => '<i class="far fa-users"></i> Gäste', 'url' => ['index', 'uid' => $this->context->event->uid, 'tab' => 'guests']],
              ['label' => '<i class="far fa-table"></i> Tische', 'url' => ['index', 'uid' => $this->context->event->uid, 'tab' => 'tables']]
            ]
          ]); ?>

        </div>

        <?php endif; ?>
      
      </div>

    </nav>
    
    <main>
      <div class="container">

        <?= AlertMessages::widget(); ?>

        <?= $content; ?>
      
      </div>
    </main>
    
    <?php $this->endBody(); ?>

  </body>
  
</html>

<?php $this->endPage();