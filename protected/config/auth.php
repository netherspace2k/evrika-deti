<?php
  return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'partner' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Partner',
        'children' => array(
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Admin',
        'children' => array(
            'partner',         // позволим админу всё, что позволено партнёру
        ),
        'bizRule' => null,
        'data' => null
    ),
);
?>
