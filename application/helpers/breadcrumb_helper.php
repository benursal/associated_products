<?php
if(!defined('BASEPATH')) exit ('No direct script access allowed');
	if(!function_exists('get_breadcrumb_items')){
		function get_breadcrumb_items($module, $action, $item_id = ''){
			$CI =& get_instance();
			
			$bread_items = array();
			$CI->load->model('category_model');
			
			if($module == 'products'){
				if($action == 'viewlist'){
					if($item_id != ''){
						#Parent Categories
						$fields = 'category_id, category_name';
						$where = "category_id = '$item_id' AND parent_category IS NULL AND is_deleted = 0 AND is_active = 1";
						$category = $CI->category_model->get($fields, $where);
						
						if(count($category[0]) > 0){
							$bread_items[] = anchor('products/viewlist', 'Products').' &raquo ';
							$bread_items[] = $category[0]['category_name'];
						}else{
							$fields = 'category_id, category_name, parent_category';
							$where = "category_id = '$item_id' AND parent_category IS NOT NULL AND is_deleted = 0 AND is_active = 1";
							$category = $CI->category_model->get($fields, $where);
							
							if(count($category[0]) > 0){
								$fields = 'category_id, category_name';
								$where = "category_id = '".$category[0]['parent_category']."' 
								AND is_deleted = 0 AND is_active = 1";
								$parent = $CI->category_model->get($fields, $where);
								
								$bread_items[] = anchor('products/viewlist', 'Products').' &raquo ';
								$bread_items[] = anchor('products/viewlist/'.$parent[0]['category_id'], $parent[0]['category_name']).' &raquo ';
								$bread_items[] = $category[0]['category_name'];
							}
						}
					}
				}elseif($action == 'view'){
					$fields = 'product_id, product_name, category';
					$where = "product_id = '$item_id' AND is_deleted = 0 AND is_active = 1";
					$product = $CI->product_model->get($fields, $where);	
					
					if(count($product[0]) > 0){
						#Parent Category
						$fields = 'category_id, category_name';
						$where = "category_id = '".$product[0]['category']."' AND parent_category IS NULL 
						AND is_deleted = 0 AND is_active = 1";
						$category = $CI->category_model->get($fields, $where);
						
						if(count($category[0]) > 0){
							#echo 'tae';
							$bread_items[] = anchor('products/viewlist', 'Products').' &raquo ';
							$bread_items[] = anchor('products/viewlist/'.$category[0]['category_id'], $category[0]['category_name']).' &raquo ';
							$bread_items[] = $product[0]['product_name'];
						}else{
							#echo 'igit';
							$fields = 'category_id, category_name, parent_category';
							$where = "category_id = '".$product[0]['category']."' AND parent_category IS NOT NULL AND is_deleted = 0 AND is_active = 1";
							$category = $CI->category_model->get($fields, $where);
							
							if(count($category[0]) > 0){
								$fields = 'category_id, category_name';
								$where = "category_id = '".$category[0]['parent_category']."' 
								AND is_deleted = 0 AND is_active = 1";
								$parent = $CI->category_model->get($fields, $where);
								
								$bread_items[] = anchor('products/viewlist', 'Products').' &raquo ';
								$bread_items[] = anchor('products/viewlist/'.$parent[0]['category_id'], $parent[0]['category_name']).' &raquo ';
								$bread_items[] = anchor('products/viewlist/'.$category[0]['category_id'], $category[0]['category_name']).' &raquo ';
								$bread_items[] = $product[0]['product_name'];
							}
						}
					}	
						
				}
			}
			
			
			return $bread_items;
			#Sub Categories
			/* $fields .= ', parent_category';
			$order_by = 'parent_category ASC';
			$where = 'parent_category IS NOT NULL AND is_deleted = 0';
			$sub_categories = $CI->category_model->get($fields, $where, $order_by); */
		}
	}
?>