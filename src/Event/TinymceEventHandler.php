<?php

namespace Tinymce\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Vamshop\Core\Vamshop;

/**
 * Tinymce Event Handler
 *
 * @category Event
 * @package  Tinymce
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.vamshop.com
 */
class TinymceEventHandler implements EventListenerInterface
{

    /**
     * implementedEvents
     *
     * @return array
     */
    public function implementedEvents()
    {
        return [
            'Vamshop.bootstrapComplete' => [
                'callable' => 'onBootstrapComplete',
            ],
        ];
    }

    /**
     * Hook helper
     */
    public function onBootstrapComplete($event)
    {
        foreach ((array)Configure::read('Wysiwyg.actions') as $action => $settings) {
            if (is_numeric($action)) {
                $action = $settings;
            }
            $action = base64_decode($action);
            $action = explode('/', $action);
            array_pop($action);
            Vamshop::hookHelper(implode('/', $action), 'Tinymce.Tinymce');
        }
    }

}
