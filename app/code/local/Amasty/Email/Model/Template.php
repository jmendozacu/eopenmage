<?php
/**
 * @copyright   Copyright (c) 2010 Amasty (http://www.amasty.com)
 */

class Amasty_Email_Model_Template extends Mage_Core_Model_Email_Template
{
    protected $_customTemplateText;

    public function setCustomTemplateText($text)
    {
        $this->_customTemplateText = $text;
    }

    public function send($email, $name = null, array $variables = array())
    {
        if ($this->_customTemplateText)
            $this->setTemplateText($this->_customTemplateText);

        return parent::send($email, $name, $variables);
    }
}
