<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $view = new ViewModel();
        $template = $this->params('name');
        $resolver = $this->getServiceLocator()
            ->get('Zend\View\Resolver\TemplatePathStack');

        if (!$resolver->resolve($template)) {
            $this->notFoundAction();
        }

        $view->setTemplate($template);
        return $view;
    }
}
