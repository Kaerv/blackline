<?php
/**
 * @override Ps_Facetedsearch
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once implode(DIRECTORY_SEPARATOR, array(
    __DIR__, 'src', 'Ps_FacetedsearchProductSearchProvider.php',
));

class Ps_FacetedsearchOverride extends Ps_Facetedsearch
{
    public function hookProductSearchProvider($params)
    {
        $query = $params['query'];
        // do something with query,
        // e.g. use $query->getIdCategory()
        // to choose a template for filters.
        // Query is an instance of:
        // PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery
        if ($query->getIdCategory()) {
            return new Ps_FacetedsearchProductSearchProviderOverride($this);
        } else {
            return null;
        }
    }
}