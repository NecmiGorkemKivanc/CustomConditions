<?php

namespace CompanyName\ModuleName\Plugin\CatalogRule\Condition;

use Magento\CatalogRule\Model\Rule\Condition\Combine as Subject;
use CompanyName\ModuleName\Model\Condition\DiscountCondition;
use Magento\Framework\App\RequestInterface;

class Combine
{
    protected $discountConditionFactory;
    protected $request;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        RequestInterface $request
    ) {
        $this->discountConditionFactory = $objectManager->create(DiscountCondition::class);
        $this->request = $request;
    }

    /**
     * @param Subject $subject
     * @param array $result
     * @return array
     */
    public function afterGetNewChildSelectOptions(Subject $subject, $result)
    {
        if ($this->isTargetedModule()) {
            $additionalConditions = [
                [
                    'value' => DiscountCondition::class,
                    'label' => __('Product Discount Percentage Condition'),
                ],
            ];

            $result[] = [
                'label' => __('Conditions by CompanyName ModuleName'),
                'value' => $additionalConditions,
            ];
        }

        return $result;
    }

    /**
     * @return bool
     */
    protected function isTargetedModule()
    {
        $controllerName = $this->request->getControllerName();
        $moduleName = $this->request->getModuleName();
        if ($moduleName === 'vxproductlabels') {
            return true;
        }

        return false;
    }
}
