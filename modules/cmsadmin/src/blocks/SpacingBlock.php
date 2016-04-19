<?php

namespace cmsadmin\blocks;

use cmsadmin\Module;

class SpacingBlock extends \cmsadmin\base\Block
{
    public $module = 'cmsadmin';
    
    public $cacheEnabled = true;

    public $spacingProperties = [
        ['value' => 1, 'label' => 'Kleiner Abstand'],
        ['value' => 2, 'label' => 'Mittlerer Abstand'],
        ['value' => 3, 'label' => 'Grosser Abstand'],
    ];

    public $defaultValue = 1;

    public function name()
    {
        return Module::t('block_spacing_name');
    }

    public function icon()
    {
        return 'format_line_spacing';
    }

    public function config()
    {
        return [
            'vars' => [
                ['var' => 'spacing', 'label' => Module::t('block_spacing_spacing_label'), 'initvalue' => 1, 'type' => 'zaa-select', 'options' => $this->spacingProperties],
            ],
        ];
    }

    public function extraVars()
    {
        return [
            'spacing' => $this->getVarValue('spacing', $this->defaultValue),
            'spacingLabel' => $this->spacingProperties[$this->getVarValue('spacing', $this->defaultValue) - 1]['label'],
        ];
    }

    public function twigFrontend()
    {
        return '<p class="m-t-{{extras.spacing}}">{% for i in 1..extras.spacing %}</br>{% endfor %}</p>';
    }

    public function twigAdmin()
    {
        return '<span class="block__empty-text">{{ extras.spacingLabel }}</span>';
    }
}
