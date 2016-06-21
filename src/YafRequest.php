<?php

namespace Imj;

/**
 * Class YafRequest
 * @package Imj
 */
class YafRequest
{
    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var yaf_request_Abstract
     */
    private $yafRequest;

    private $filter_vars;

    public function __construct()
    {
        if (!class_exists('Yaf_Application')) {
            throw new \RuntimeException('Yaf extension required');
        }
        $this->yafRequest = \Yaf_Application::app()->getDispatcher()->getRequest();
        $this->filter = new Filter();
    }

    /**
     * 取$_GET参数
     * @param $name
     * @param null $var_type
     * @param array $options
     * @return mixed|null
     */
    public function get($name, $var_type = null, $options = [])
    {
        return $this->_getVar('g', $name, $var_type, $options);
    }

    /**
     * 取$_POST参数
     * @param $name
     * @param null $var_type
     * @param array $options
     * @return mixed|null
     */
    public function post($name, $var_type = null, $options = [])
    {
        return $this->_getVar('p', $name, $var_type, $options);
    }

    /**
     * 取$_REQUEST参数
     * @param $name
     * @param null $var_type
     * @param array $options
     * @return mixed|null
     */
    public function request($name, $var_type = null, $options = [])
    {
        return $this->_getVar('r', $name, $var_type, $options);
    }

    /**
     * 取$_COOKIE参数
     * @param $name
     * @param null $var_type
     * @param array $options
     * @return mixed|null
     */
    public function cookie($name, $var_type = null, $options = [])
    {
        return $this->_getVar('c', $name, $var_type, $options);
    }

    /**
     * @param $var_class
     * @param $name
     * @param null $var_type
     * @param array $options
     * @return null
     */
    private function _getVar($var_class, $name, $var_type = null, $options = [])
    {
        $vt = $var_type === null ? 'null' : $var_type;
        if (isset($this->filter_vars[$var_class][$name][$vt])) {
            return $this->filter_vars[$var_class][$name][$vt];
        }

        if (empty($options)) {
            $options = [];
        }
        switch ($var_class) {
            case 'g':
                $value = $this->yafRequest->getQuery($name);
                break;
            case 'p':
                $value = $this->yafRequest->getPost($name);
                break;
            case 'r':
                $value = $this->yafRequest->getRequest($name);
                break;
            case 'c':
                $value = $this->yafRequest->getCookie($name);
                break;
            default:
                return null;
        }
        $filter_value = $this->filter->validate($value, $var_type, $options);
        $this->filter_vars[$var_class][$name][$vt] = $filter_value;

        return $filter_value;
    }
}
