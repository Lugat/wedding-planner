<?php

  return [
    'options' => [
      'date' => ['type' => 'date'],
      'people' => ['type' => 'number', 'min' => 10],
      'location' => ['type' => 'text'],
      'workers' => ['type' => 'number', 'min' => 0],
      'budget' => ['type' => 'number', 'min' => 0, 'step' => 100],
      'currency' => ['type' => 'text'],
    ],
    'defaultColor' => '#6c757d',
    'defaultPlaces' => 8
  ];
