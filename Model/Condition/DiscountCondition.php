<?php
namespace CompanyName\ModuleName\Model\Condition;

use Magento\CatalogRule\Model\Rule\Condition\Combine;
use Magento\Catalog\Model\Product;

class DiscountCondition extends \Magento\CatalogRule\Model\Rule\Condition\Product
{
   
    public function loadAttributeOptions()
    {
        $this->setAttributeOption([
            'vx_productlabel_discount_rate' => __('Discount Rate')
        ]);
        return $this;
    }
    
    public function getValueElementType()
    {
        return 'text';
    }

    public function getValueElementRenderer()
    {
        if (strpos($this->getValueElementType(), '/') !== false) {
            return $this->_layout->getBlockSingleton($this->getValueElementType());
        }

        return $this->_layout->getBlockSingleton(\Magento\Rule\Block\Editable::class);
    }

    
    public function getDefaultOperatorOptions()
    {
        return [
            '=='  => __('is equal to'),
            '!='  => __('is not equal to'),
            '>'   => __('is greater than'),
            '<'   => __('is less than'),
            '>='  => __('is greater than or equal to'),
            '<='  => __('is less than or equal to'),
        ];
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $model
     * @return bool
     */
    public function validate(\Magento\Framework\Model\AbstractModel $model)
    {
        $discountRate = $model->getData('vx_productlabel_discount_rate');

        $operator = $this->getOperator();
        $value = $this->getValue();
        switch ($operator) {
            case '==':
                return $discountRate == $value;
            case '!=':
                return $discountRate != $value;
            case '>':
                return $discountRate > $value;
            case '<':
                return $discountRate < $value;
            case '>=':
                return $discountRate >= $value;
            case '<=':
                return $discountRate <= $value;
            default:
                return false;
        }
    }

    
    public function getNewChildSelectOptions()
    {
        $conditions = parent::getNewChildSelectOptions();
        $conditions[] = [
            'value' => $this->getType(),
            'label' => __('Discount Condition')
        ];
        return $conditions;
    }
}
