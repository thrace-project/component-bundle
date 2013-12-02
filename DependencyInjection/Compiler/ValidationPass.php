<?php
namespace Thrace\ComponentBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

use Symfony\Component\Config\Resource\FileResource;

class ValidationPass implements CompilerPassInterface
{
    
    protected $dir;
    
    public function __construct($dir)
    {
        $this->dir = (string) $dir;
    }
    
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {  
        $this->loadXmlFiles($container);
        $this->loadYmlFiles($container);
    }
    
    protected function loadXmlFiles(ContainerBuilder $container)
    {
        if (!$container->hasParameter('validator.mapping.loader.xml_files_loader.mapping_files')) {
            return;
        }
        
        $files = $container->getParameter('validator.mapping.loader.xml_files_loader.mapping_files');
       
        foreach ($this->getValidationFiles('xml') as $file){
            $files[] = $file;
            $container->addResource(new FileResource($file));
        }
        
        $container->setParameter('validator.mapping.loader.xml_files_loader.mapping_files', $files);
    }
    
    protected function loadYmlFiles(ContainerBuilder $container)
    {
        if (!$container->hasParameter('validator.mapping.loader.yaml_files_loader.mapping_files')) {
            return;
        }
        
        $files = $container->getParameter('validator.mapping.loader.yaml_files_loader.mapping_files');
       
        foreach ($this->getValidationFiles('yml') as $file){ 
            $files[] = $file;
            $container->addResource(new FileResource($file));
        }
        
        $container->setParameter('validator.mapping.loader.yaml_files_loader.mapping_files', $files);
    }
    
    protected function getValidationFiles($format)
    {
        $iterator = new \DirectoryIterator($this->dir);
        $files = array();
        
        foreach ($iterator as $fileinfo){
            if ($fileinfo->isFile() && $fileinfo->getExtension() == $format) { 
                $files[] = $fileinfo->getPathname();
            }
        }
        
        return $files;
    }
}
