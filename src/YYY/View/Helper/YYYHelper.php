<?php  
      
namespace YYY\View\Helper;  
      
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class YYYHelper extends AbstractHelper implements ServiceLocatorAwareInterface{  
      
    protected $sm;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
        return $this;
    }
 
    public function getServiceLocator()
    {
        return $this->sm;
    }
    
    public function __invoke() {
        /* Your treatment here */ 
    }  
      
}  
      
  