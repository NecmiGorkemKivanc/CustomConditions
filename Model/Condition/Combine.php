<?php

namespace CompanyName\ModuleName\Model\Condition;


use Magento\CatalogRule\Model\Rule\Condition\Combine as MagentoCombine;
use Magento\CatalogRule\Model\Rule\Condition\Product;
use Magento\Rule\Model\Condition\Context;
use CompanyName\ModuleName\Model\Condition\DiscountCondition;

class Combine extends MagentoCombine
{
    protected $discountCondition;

    public function __construct(
        Context $context,
        \Magento\CatalogRule\Model\Rule\Condition\ProductFactory $conditionFactory,
        DiscountCondition $discountCondition,
        array $data = []
    ) {
        $this->discountCondition = $discountCondition;
        parent::__construct($context, $conditionFactory, $data);
    }

    
    public function getNewChildSelectOptions()
    {
        $conditions = parent::getNewChildSelectOptions();

        $additionalConditions = [
            [
                'value' => DiscountCondition::class,
                'label' => __('Product Discount Percentage Condition'),
            ],
        ];

        $conditions = array_merge_recursive($conditions, [
            [
                'label' => __('Conditions by CompanyName ModuleName'),
                'value' => $additionalConditions,
            ],
        ]);
        return $conditions;
    }
}
