<?php

require_once implode(DIRECTORY_SEPARATOR, array(
    __DIR__, '..', '..', '..', '..', 'modules', 'ps_facetedsearch', 'src', 'Ps_FacetedsearchProductSearchProvider.php',
));

require_once implode(DIRECTORY_SEPARATOR, array(
    __DIR__, '..', '..', '..', '..', 'modules', 'ps_facetedsearch', 'src', 'Ps_FacetedsearchFiltersConverter.php',
));

require_once implode(DIRECTORY_SEPARATOR, array(
    __DIR__, '..', '..', '..', '..', 'modules', 'ps_facetedsearch', 'src', 'Ps_FacetedsearchFacetsURLSerializer.php',
));

use PrestaShop\PrestaShop\Core\Product\Search\URLFragmentSerializer;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchProviderInterface;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchResult;
use PrestaShop\PrestaShop\Core\Product\Search\Facet;
use PrestaShop\PrestaShop\Core\Product\Search\FacetCollection;
use PrestaShop\PrestaShop\Core\Product\Search\Filter;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class Ps_FacetedsearchProductSearchProviderOverride extends Ps_FacetedsearchProductSearchProvider
{
    private $module;

    public function __construct(Ps_Facetedsearch $module)
    {
        $this->module = $module;
    }

    public function runQuery(
        ProductSearchContext $context,
        ProductSearchQuery $query
    ) {
        $facetedSearch = new Ps_FacetedsearchProductSearchProvider($this->module);
        $result = $facetedSearch->runQuery($context, $query);

        $sortOrders = $this->getAvailableSortOrders();
        foreach ($sortOrders as $sortOrder) {
            $result->addAvailableSortOrder($sortOrder);
        }

        return $result;
    }

    /**
     * New sort order that needs to be appended
     * 
     * @return array
     */
    private function getAvailableSortOrders()
    {
        return [
            (new SortOrder('product', 'posif', 'asc'))->setLabel(
                $this->module->getTranslator()->trans('Relevance', array(), 'Modules.Facetedsearch.Shop')
            )
        ];
    }
}