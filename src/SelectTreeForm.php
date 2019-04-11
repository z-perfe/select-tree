<?php

namespace Zhpefe\SelectTree;

use Encore\Admin\Form\Field;

class SelectTreeForm extends Field
{
    protected $view = 'select-tree::index';

    /**
     * SelectTree constructor.
     *
     * @param array $column
     * @param array $arguments
     */

    protected $url = null;
    protected $top_id = 0;
    protected $config = [];

    public function __construct($column, $arguments)
    {
        $this->column = $column;
        $this->label = empty($arguments) ? $column : current($arguments);
    }

    public function ajax($url)
    {
        $this->url = $url;
        return $this;
    }

    public function topID($id)
    {
        $this->top_id = $id;
        return $this;
    }

    public function render()
    {
        $this->attribute('data-value', implode(',', (array) $this->value()));
        $vars = [
            'id' => 'select-tree-' . uniqid(),
            'top_id' => $this->top_id,
            'url' => $this->url,
        ];
        return parent::render()->with(compact('vars'));
    }
}