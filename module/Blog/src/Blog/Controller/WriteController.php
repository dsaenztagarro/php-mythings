<?php

namespace Blog\Controller;

use Blog\Service\PostServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;

class WriteController extends AbstractActionController
{
    protected $postService;

    protected $postForm;

    public function __construct(
        PostServiceInterface $postService,
        FormInterface $postForm
    ) {
        $this->postService = $postService;
        $this->postForm    = $postForm;
    }

    public function addAction()
    {
    }
}
