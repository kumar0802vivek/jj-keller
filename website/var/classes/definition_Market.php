<?php 

/** 
* Generated at: 2016-12-14T11:15:36+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 127.0.0.1


Fields Summary: 
- market_name [input]
- niche_code [multiselect]
- priority [select]
*/ 


return Pimcore\Model\Object\ClassDefinition::__set_state(array(
   'name' => 'Market',
   'description' => '',
   'creationDate' => 0,
   'modificationDate' => 1481710536,
   'userOwner' => 2,
   'userModification' => 2,
   'parentClass' => '',
   'useTraits' => '',
   'allowInherit' => false,
   'allowVariants' => false,
   'showVariants' => false,
   'layoutDefinitions' => 
  Pimcore\Model\Object\ClassDefinition\Layout\Panel::__set_state(array(
     'fieldtype' => 'panel',
     'labelWidth' => 100,
     'layout' => NULL,
     'name' => 'pimcore_root',
     'type' => NULL,
     'region' => NULL,
     'title' => NULL,
     'width' => NULL,
     'height' => NULL,
     'collapsible' => NULL,
     'collapsed' => NULL,
     'bodyStyle' => NULL,
     'datatype' => 'layout',
     'permissions' => NULL,
     'childs' => 
    array (
      0 => 
      Pimcore\Model\Object\ClassDefinition\Layout\Region::__set_state(array(
         'fieldtype' => 'region',
         'name' => 'Layout',
         'type' => NULL,
         'region' => NULL,
         'title' => NULL,
         'width' => NULL,
         'height' => NULL,
         'collapsible' => false,
         'collapsed' => NULL,
         'bodyStyle' => NULL,
         'datatype' => 'layout',
         'permissions' => NULL,
         'childs' => 
        array (
          0 => 
          Pimcore\Model\Object\ClassDefinition\Layout\Panel::__set_state(array(
             'fieldtype' => 'panel',
             'labelWidth' => 100,
             'layout' => NULL,
             'name' => 'Layout',
             'type' => NULL,
             'region' => NULL,
             'title' => NULL,
             'width' => NULL,
             'height' => NULL,
             'collapsible' => false,
             'collapsed' => NULL,
             'bodyStyle' => NULL,
             'datatype' => 'layout',
             'permissions' => NULL,
             'childs' => 
            array (
              0 => 
              Pimcore\Model\Object\ClassDefinition\Data\Input::__set_state(array(
                 'fieldtype' => 'input',
                 'width' => NULL,
                 'queryColumnType' => 'varchar',
                 'columnType' => 'varchar',
                 'columnLength' => 255,
                 'phpdocType' => 'string',
                 'regex' => '',
                 'name' => 'market_name',
                 'title' => 'Market Name',
                 'tooltip' => '',
                 'mandatory' => true,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => false,
                 'style' => '',
                 'permissions' => NULL,
                 'datatype' => 'data',
                 'relationType' => false,
                 'invisible' => false,
                 'visibleGridView' => false,
                 'visibleSearch' => false,
              )),
              1 => 
              Pimcore\Model\Object\ClassDefinition\Data\Multiselect::__set_state(array(
                 'fieldtype' => 'multiselect',
                 'options' => 
                array (
                  0 => 
                  array (
                    'key' => '10',
                    'value' => '10',
                  ),
                  1 => 
                  array (
                    'key' => '9',
                    'value' => '9',
                  ),
                  2 => 
                  array (
                    'key' => '8',
                    'value' => '8',
                  ),
                  3 => 
                  array (
                    'key' => '7',
                    'value' => '7',
                  ),
                  4 => 
                  array (
                    'key' => '6',
                    'value' => '6',
                  ),
                  5 => 
                  array (
                    'key' => '5',
                    'value' => '5',
                  ),
                  6 => 
                  array (
                    'key' => '4',
                    'value' => '4',
                  ),
                  7 => 
                  array (
                    'key' => '3',
                    'value' => '3',
                  ),
                  8 => 
                  array (
                    'key' => '2',
                    'value' => '2',
                  ),
                  9 => 
                  array (
                    'key' => '1',
                    'value' => '1',
                  ),
                  10 => 
                  array (
                    'key' => '0',
                    'value' => '0',
                  ),
                ),
                 'width' => '',
                 'height' => '',
                 'maxItems' => '',
                 'queryColumnType' => 'text',
                 'columnType' => 'text',
                 'phpdocType' => 'array',
                 'name' => 'niche_code',
                 'title' => 'Niche Code',
                 'tooltip' => '',
                 'mandatory' => false,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => false,
                 'style' => '',
                 'permissions' => NULL,
                 'datatype' => 'data',
                 'relationType' => false,
                 'invisible' => false,
                 'visibleGridView' => false,
                 'visibleSearch' => false,
              )),
              2 => 
              Pimcore\Model\Object\ClassDefinition\Data\Select::__set_state(array(
                 'fieldtype' => 'select',
                 'options' => 
                array (
                  0 => 
                  array (
                    'key' => '3',
                    'value' => '3',
                  ),
                  1 => 
                  array (
                    'key' => '2',
                    'value' => '2',
                  ),
                  2 => 
                  array (
                    'key' => '1',
                    'value' => '1',
                  ),
                ),
                 'width' => '',
                 'defaultValue' => '3',
                 'queryColumnType' => 'varchar(255)',
                 'columnType' => 'varchar(255)',
                 'phpdocType' => 'string',
                 'name' => 'priority',
                 'title' => 'Priority',
                 'tooltip' => '',
                 'mandatory' => false,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => false,
                 'style' => '',
                 'permissions' => NULL,
                 'datatype' => 'data',
                 'relationType' => false,
                 'invisible' => false,
                 'visibleGridView' => false,
                 'visibleSearch' => false,
              )),
            ),
             'locked' => false,
          )),
        ),
         'locked' => false,
      )),
    ),
     'locked' => NULL,
  )),
   'icon' => '/website/static/images/class-images/market.png',
   'previewUrl' => '',
   'group' => '',
   'propertyVisibility' => 
  array (
    'grid' => 
    array (
      'id' => true,
      'path' => true,
      'published' => true,
      'modificationDate' => true,
      'creationDate' => true,
    ),
    'search' => 
    array (
      'id' => true,
      'path' => true,
      'published' => true,
      'modificationDate' => true,
      'creationDate' => true,
    ),
  ),
   'dao' => NULL,
));
