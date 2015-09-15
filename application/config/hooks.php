<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    $hook['post_controller_constructor'] = array(
        'class'    => 'MyClass',
        'function' => 'Myfunction',
        'filename' => 'MyClass.php',
        'filepath' => 'hooks',
);
