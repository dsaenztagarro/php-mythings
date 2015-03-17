<?php

namespace Blog\Form;

use Zend\Form\Form;

class PostForm extends Form
{
    public function __construct()
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'post-fieldset',
            'type' => 'Blog\Form\PostFieldset'
        ));

        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Insert new Post'
            )
        ));
    }
}
