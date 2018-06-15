<?php

namespace App\Http\Forms;

use Revolution\ZendForm\Form as ZendForm;
use Zend\Form\Element;

class ConfigForm extends ZendForm
{
    /**
     * Create a new form.
     *
     * @param null|string $name
     *
     * @return void
     */
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->setAttributes([
            'action' => route('config.update'),
            'method' => 'post',
        ]);

        $this->add([
            'type'       => Element\Hidden::class,
            'name'       => '_token',
            'attributes' => [
                'value' => csrf_token(),
            ],
        ]);

        $this->add([
            'name'       => 'key',
            'type'       => Element\Text::class,
            'attributes' => [
                'id'    => 'key',
                'class' => 'form-control',
                'value' => auth()->user()->key ?? '',
            ],
            'options'    => [
                'label'            => '特典キー',
                'label_attributes' => [
                    'class' => 'col-sm-2 col-form-label',
                ],
                'wrapper-class'    => 'form-group row',
                'element-class'    => 'col-sm-10',
                'help-text'        => '<a href="https://www.pixiv.net/fanbox/creator/762638">pixivFANBOX</a>の支援特典。自動削除を解除するにはキーを空欄にします。',
            ],
        ]);

        $this->add([
            'name'       => 'send',
            'type'       => 'Submit',
            'attributes' => [
                'value' => '保存',
                'class' => 'btn btn-primary',
            ],
        ]);
    }
}
