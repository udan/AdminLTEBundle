<?php
/**
 * WidgetHelper.php
 * avanzu-admin
 * Date: 16.03.14
 */

namespace Avanzu\AdminThemeBundle\Helper;


use Symfony\Component\Templating\Helper\Helper;

class WidgetHelper  extends  Helper {

    public function getName()
    {
        return 'widget';
    }

    public function box() {}
}