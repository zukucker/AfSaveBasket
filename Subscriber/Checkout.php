<?php

namespace AfSaveBasket\Subscriber;

use Enlight\Event\SubscriberInterface;

class Checkout implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Checkout' => 'onCheckout'
        );
    }

    public function onCheckout(\Enlight_Event_EventArgs $args)
    {
        /** @var $controller \Enlight_Controller_Action */
        $controller = $args->getSubject();
        $view = $controller->View();
        $sessionId = Shopware()->Session()->get("sessionId");
        $this->saveBasket($sessionId);
    }

    public function saveBasket($sessionId){
        $db = Shopware()->Db();

        $basketArticle = $db->fetchAll('SELECT articlename, articleID, ordernumber FROM s_order_basket WHERE sessionID= "'.$sessionId.'"');

        foreach($basketArticle as $article){
            $data[] = array(
                'articlename' => $article['articlename'],
                'articleID' => $article['articleID'],
                'ordernumber' => $article['ordernumber'],
                'sessionid' => $sessionId
            );
        }

        foreach($data as $saveArticle){
            $db->insert('af_save_basket_items', $saveArticle);
        }
    }
}
