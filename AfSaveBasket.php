<?php

namespace AfSaveBasket;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;

/**
 * Shopware-Plugin AfSaveBasket.
 */
class AfSaveBasket extends Plugin
{

    /**
    * @param ContainerBuilder $container
    */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('af_save_basket.plugin_dir', $this->getPath());
        parent::build($container);
    }
    public function install(InstallContext $install){
        $connection = $this->container->get('dbal_connection');
        $af_save_basket_items = "CREATE TABLE `af_save_basket_items`
            ( `id` INT NOT NULL AUTO_INCREMENT ,  `articlename` VARCHAR(255) NOT NULL ,
            `articleID` INT NOT NULL ,  `ordernumber` VARCHAR(255) NOT NULL ,
            `sessionid` VARCHAR(255) NOT NULL,    PRIMARY KEY  (`id`)) ENGINE = InnoDB";

        $connection->query($af_save_basket_items);
    }

    public function uninstall(UninstallContext $install){
        $connection = $this->container->get('dbal_connection');
        $drop_af_save_basket_items = "DROP TABLE af_save_basket_items";

        $connection->query($drop_af_save_basket_items);

    }

}
