<?php

class JsonProductCategory
{
	var $user_id,$super_cat_id,$product_category_code,$product_category_desc,$p_value;
        public function SetuserId($value)
	{
		$this->user_id = $value;
	}
        public function SetSuperCatId($value)
	{
		$this->super_cat_id = $value;
	}
	public function SetProdCategoryCode($value)
	{
		$this->product_category_code = $value;
	}
	public function SetProdcatDesc($value)
	{
		$this->product_category_desc = $value;
	}
        public function SetPValue($value)
	{
		$this->p_value = $value;
	}
}
?>
