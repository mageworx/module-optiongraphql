This GraphQL module is the add-on for the [Advanced Product Options Suite](https://www.mageworx.com/magento-2-advanced-product-options-suite.html) module for Magento 2. It adds support for the GraphQL API to use the features provided by APO extension on PWA store fronts.

Our module extends original Magento products GraphQL request to add our attributes. You can remove the unnecessay attributes manually if they are not applicable for your configuration.

<details>
  <summary>Products request</summary>

```graphql 
{
  products(filter: {sku: {eq: "testMW"}}) {
    items {
      id
      name
      sku
      __typename
      dependency_rules
      hidden_dependents
      absolute_price
      absolute_cost
      absolute_weight
      sku_policy
      shareable_link
      hide_additional_product_price
      ... on CustomizableProductInterface {
        options {
          __typename
          title
          required
          sort_order
          option_id
          qty_input
          div_class
          one_time
          is_swatch
          is_hidden
          mageworx_option_gallery
          mageworx_option_image_mode
          description
          sku_policy
          is_all_customer_groups
          is_all_store_views
          customer_group
          store_view
          disabled
          disabled_by_values
          selection_limit_from
          selection_limit_to
          ... on CustomizableDropDownOption {
            dropdown_value: value {
              title
              option_type_id
              price
              price_type
              sku
              mageworx_option_type_price
              mageworx_title
              special_price
              tier_price
              description
              dependency
              dependency_type
              cost
              images_data
              is_default
              qty_multiplier
              weight
              weight_type
              qty
              manage_stock
              disabled
            }
          }
          ... on CustomizableRadioOption {
                radio_value: value {
              title
              option_type_id
              price
              price_type
              sku
              mageworx_option_type_price
              mageworx_title
              special_price
              tier_price
              description
              dependency
              dependency_type
              cost
              images_data
              is_default
              qty_multiplier
              weight
              weight_type
              qty
              manage_stock
              disabled
            }
          }
          ... on CustomizableMultipleOption {
            multiple_value: value {
              title
              option_type_id
              price
              price_type
              sku
              mageworx_option_type_price
              mageworx_title
              special_price
              tier_price
              description
              dependency
              dependency_type
              cost
              images_data
              is_default
              qty_multiplier
              weight
              weight_type
              qty
              manage_stock
              disabled
            }
          }
          ... on CustomizableCheckboxOption {
            checkbox_value: value {
              title
              option_type_id
              price
              price_type
              sku
              mageworx_option_type_price
              mageworx_title
              special_price
              tier_price
              description
              dependency
              dependency_type
              cost
              images_data
              is_default
              qty_multiplier
              weight
              weight_type
              qty
              manage_stock
              disabled
            }
          }
          ... on CustomizableFieldOption {
            field_value: value {
              max_characters
              price_type
              price
              sku
              mageworx_option_price
              mageworx_title
              dependency
              dependency_type
            }
          }
          ... on CustomizableAreaOption {
            area_value: value {
              max_characters
              price_type
              price
              sku
              mageworx_option_price
              mageworx_title
              dependency
              dependency_type
            }
          }
          ... on CustomizableFileOption {
            file_value: value {
              file_extension
              image_size_x
              image_size_y
              price_type
              price
              sku
              mageworx_option_price
              mageworx_title
              dependency
              dependency_type
            }
          }
          ... on CustomizableDateOption {
            date_value: value {
              price_type
              price
              sku
              mageworx_option_price
              mageworx_title
              dependency
              dependency_type
            }
          }
        }
      }
    }
  }
}
```
</details>
<details>
  <summary>Products response</summary>

```graphql 
{
  "data": {
    "products": {
      "items": [
        {
          "id": 24,
          "name": "testMW",
          "sku": "testMW",
          "__typename": "SimpleProduct",
          "dependency_rules": "[{\"conditions\":[{\"values\":[],\"type\":\"!eq\",\"id\":172}],\"condition_type\":\"or\",\"actions\":{\"hide\":{\"174\":{\"values\":[],\"id\":174},\"175\":{\"values\":[],\"id\":175}}}},{\"conditions\":[{\"values\":[\"1094\"],\"type\":\"!eq\",\"id\":172}],\"condition_type\":\"or\",\"actions\":{\"hide\":{\"174\":{\"values\":{\"1098\":\"1098\",\"1099\":\"1099\",\"1100\":\"1100\",\"1101\":\"1101\"},\"id\":174}}}},{\"conditions\":[{\"values\":[\"1092\",\"1093\",\"1094\"],\"type\":\"!eq\",\"id\":172}],\"condition_type\":\"and\",\"actions\":{\"hide\":{\"175\":{\"values\":[],\"id\":175}}}},{\"conditions\":[{\"values\":[],\"type\":\"!eq\",\"id\":171}],\"condition_type\":\"or\",\"actions\":{\"hide\":{\"176\":{\"values\":[],\"id\":176}}}},{\"conditions\":[{\"values\":[\"1090\",\"1091\"],\"type\":\"!eq\",\"id\":171}],\"condition_type\":\"and\",\"actions\":{\"hide\":{\"176\":{\"values\":[],\"id\":176}}}},{\"conditions\":[{\"values\":[],\"type\":\"!eq\",\"id\":170}],\"condition_type\":\"or\",\"actions\":{\"hide\":{\"177\":{\"values\":[],\"id\":177}}}},{\"conditions\":[{\"values\":[\"1087\",\"1088\",\"1089\"],\"type\":\"!eq\",\"id\":170}],\"condition_type\":\"and\",\"actions\":{\"hide\":{\"177\":{\"values\":[],\"id\":177}}}}]",
          "hidden_dependents": "{\"hidden_options\":[176,177],\"hidden_values\":[],\"preselected_values\":{\"172\":[1092,1093,1094],\"174\":[1100]}}",
          "absolute_price": "1",
          "absolute_cost": "0",
          "absolute_weight": "1",
          "sku_policy": "use_config",
          "shareable_link": null,
          "hide_additional_product_price": "0",
          "options": [
            {
              "__typename": "CustomizableDropDownOption",
              "title": "drop-down",
              "required": true,
              "sort_order": 1,
              "option_id": 170,
              "qty_input": "0",
              "div_class": "",
              "one_time": "0",
              "is_swatch": "0",
              "is_hidden": "0",
              "mageworx_option_gallery": "0",
              "mageworx_option_image_mode": "0",
              "description": "[{\"store_id\":\"0\",\"description\":\"option description\"}]",
              "sku_policy": "independent",
              "is_all_customer_groups": null,
              "is_all_store_views": null,
              "customer_group": null,
              "store_view": null,
              "disabled": "0",
              "disabled_by_values": "0",
              "selection_limit_from": "0",
              "selection_limit_to": "0",
              "dropdown_value": [
                {
                  "title": "1",
                  "option_type_id": 1087,
                  "price": 1,
                  "price_type": "FIXED",
                  "sku": "d1",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"1.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"1\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": null,
                  "dependency_type": "0",
                  "cost": "0.000000",
                  "images_data": "[{\"value\":\"/8/a/8a288a.jpg\",\"option_type_image_id\":\"667\",\"title_text\":\"\",\"sort_order\":\"1\",\"base_image\":\"1\",\"replace_main_gallery_image\":\"1\",\"custom_media_type\":\"color\",\"color\":\"8a288a\",\"disabled\":\"0\",\"overlay_image\":\"0\",\"tooltip_image\":\"1\"}]",
                  "is_default": "0",
                  "qty_multiplier": "0",
                  "weight": "0.000000",
                  "weight_type": "fixed",
                  "qty": "111.0000",
                  "manage_stock": "1",
                  "disabled": "0"
                },
                {
                  "title": "2",
                  "option_type_id": 1088,
                  "price": 110,
                  "price_type": "FIXED",
                  "sku": "d2",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"110.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"2\"}]",
                  "special_price": "[{\"price\":\"90.0000\",\"customer_group_id\":\"32000\",\"price_type\":\"fixed\",\"date_from\":\"\",\"date_to\":\"\",\"comment\":\"\"}]",
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": null,
                  "dependency_type": "0",
                  "cost": "0.000000",
                  "images_data": null,
                  "is_default": "0",
                  "qty_multiplier": "0",
                  "weight": "0.000000",
                  "weight_type": "fixed",
                  "qty": "222.0000",
                  "manage_stock": "1",
                  "disabled": "0"
                },
                {
                  "title": "3",
                  "option_type_id": 1089,
                  "price": 123,
                  "price_type": "FIXED",
                  "sku": "simple",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"123.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"3\"}]",
                  "special_price": null,
                  "tier_price": "[{\"price\":\"100.0000\",\"customer_group_id\":\"32000\",\"price_type\":\"fixed\",\"date_from\":\"\",\"date_to\":\"\",\"qty\":\"3\"},{\"price\":\"90.0000\",\"customer_group_id\":\"32000\",\"price_type\":\"fixed\",\"date_from\":\"\",\"date_to\":\"\",\"qty\":\"4\"},{\"price\":\"80.0000\",\"customer_group_id\":\"32000\",\"price_type\":\"fixed\",\"date_from\":\"\",\"date_to\":\"\",\"qty\":\"5\"}]",
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": null,
                  "dependency_type": "0",
                  "cost": null,
                  "images_data": null,
                  "is_default": "0",
                  "qty_multiplier": "0",
                  "weight": null,
                  "weight_type": "fixed",
                  "qty": "121.0000",
                  "manage_stock": "1",
                  "disabled": "0"
                }
              ]
            },
            {
              "__typename": "CustomizableRadioOption",
              "title": "radio",
              "required": true,
              "sort_order": 2,
              "option_id": 171,
              "qty_input": "0",
              "div_class": "test div class",
              "one_time": "1",
              "is_swatch": "0",
              "is_hidden": "0",
              "mageworx_option_gallery": "1",
              "mageworx_option_image_mode": "1",
              "description": "[{\"store_id\":\"0\",\"description\":\"option description\"}]",
              "sku_policy": "use_config",
              "is_all_customer_groups": null,
              "is_all_store_views": null,
              "customer_group": null,
              "store_view": null,
              "disabled": "0",
              "disabled_by_values": "0",
              "selection_limit_from": "1",
              "selection_limit_to": "2",
              "radio_value": [
                {
                  "title": "r1",
                  "option_type_id": 1090,
                  "price": 22,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"22.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"r1\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": null,
                  "dependency_type": "0",
                  "cost": "0.000000",
                  "images_data": "[{\"value\":\"/0/0/0034e0.jpg\",\"option_type_image_id\":\"668\",\"title_text\":\"\",\"sort_order\":\"1\",\"base_image\":\"1\",\"replace_main_gallery_image\":\"1\",\"custom_media_type\":\"color\",\"color\":\"0034e0\",\"disabled\":\"0\",\"overlay_image\":\"0\",\"tooltip_image\":\"1\"}]",
                  "is_default": "0",
                  "qty_multiplier": "0",
                  "weight": "0.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "0"
                },
                {
                  "title": "r2",
                  "option_type_id": 1091,
                  "price": 11,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"11.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"r2\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": null,
                  "dependency_type": "0",
                  "cost": "0.000000",
                  "images_data": "[{\"value\":\"/b/f/bf64bf.jpg\",\"option_type_image_id\":\"669\",\"title_text\":\"\",\"sort_order\":\"1\",\"base_image\":\"1\",\"replace_main_gallery_image\":\"1\",\"custom_media_type\":\"color\",\"color\":\"bf64bf\",\"disabled\":\"0\",\"overlay_image\":\"0\",\"tooltip_image\":\"1\"}]",
                  "is_default": "0",
                  "qty_multiplier": "0",
                  "weight": "0.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "0"
                }
              ]
            },
            {
              "__typename": "CustomizableCheckboxOption",
              "title": "checkbox",
              "required": true,
              "sort_order": 3,
              "option_id": 172,
              "qty_input": "0",
              "div_class": "",
              "one_time": "0",
              "is_swatch": "0",
              "is_hidden": "1",
              "mageworx_option_gallery": "0",
              "mageworx_option_image_mode": "0",
              "description": "[{\"store_id\":\"0\",\"description\":\"option description\"}]",
              "sku_policy": "use_config",
              "is_all_customer_groups": null,
              "is_all_store_views": null,
              "customer_group": null,
              "store_view": null,
              "disabled": "0",
              "disabled_by_values": "0",
              "selection_limit_from": "0",
              "selection_limit_to": "0",
              "checkbox_value": [
                {
                  "title": "c1",
                  "option_type_id": 1092,
                  "price": 1,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"1.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"c1\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": null,
                  "dependency_type": "0",
                  "cost": "0.000000",
                  "images_data": null,
                  "is_default": "1",
                  "qty_multiplier": "0",
                  "weight": "0.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "0"
                },
                {
                  "title": "c2",
                  "option_type_id": 1093,
                  "price": 2,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"2.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"c2\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": null,
                  "dependency_type": "0",
                  "cost": "0.000000",
                  "images_data": null,
                  "is_default": "1",
                  "qty_multiplier": "0",
                  "weight": "0.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "0"
                },
                {
                  "title": "c3",
                  "option_type_id": 1094,
                  "price": 3,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"3.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"c3\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": null,
                  "dependency_type": "0",
                  "cost": "0.000000",
                  "images_data": null,
                  "is_default": "1",
                  "qty_multiplier": "0",
                  "weight": "0.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "0"
                }
              ]
            },
            {
              "__typename": "CustomizableMultipleOption",
              "title": "multi-select",
              "required": true,
              "sort_order": 4,
              "option_id": 173,
              "qty_input": "0",
              "div_class": "value description",
              "one_time": "0",
              "is_swatch": "0",
              "is_hidden": "0",
              "mageworx_option_gallery": "0",
              "mageworx_option_image_mode": "0",
              "description": "[{\"store_id\":\"0\",\"description\":\"option description\"}]",
              "sku_policy": "use_config",
              "is_all_customer_groups": null,
              "is_all_store_views": null,
              "customer_group": null,
              "store_view": null,
              "disabled": "0",
              "disabled_by_values": "0",
              "selection_limit_from": "1",
              "selection_limit_to": "2",
              "multiple_value": [
                {
                  "title": "m1",
                  "option_type_id": 1095,
                  "price": 0,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"0.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"m1\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": null,
                  "dependency_type": "0",
                  "cost": "0.000000",
                  "images_data": null,
                  "is_default": "0",
                  "qty_multiplier": "0",
                  "weight": "0.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "0"
                },
                {
                  "title": "m2",
                  "option_type_id": 1096,
                  "price": 0,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"0.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"m2\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": null,
                  "dependency_type": "0",
                  "cost": "0.000000",
                  "images_data": null,
                  "is_default": "0",
                  "qty_multiplier": "0",
                  "weight": "0.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "0"
                },
                {
                  "title": "m3",
                  "option_type_id": 1097,
                  "price": 0,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"0.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"m3\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": null,
                  "dependency_type": "0",
                  "cost": "0.000000",
                  "images_data": null,
                  "is_default": "0",
                  "qty_multiplier": "0",
                  "weight": "0.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "0"
                }
              ]
            },
            {
              "__typename": "CustomizableDropDownOption",
              "title": "drop-down swatch",
              "required": true,
              "sort_order": 5,
              "option_id": 174,
              "qty_input": "0",
              "div_class": "value description",
              "one_time": "0",
              "is_swatch": "1",
              "is_hidden": "0",
              "mageworx_option_gallery": "0",
              "mageworx_option_image_mode": "0",
              "description": "[{\"store_id\":\"0\",\"description\":\"option description\"}]",
              "sku_policy": "use_config",
              "is_all_customer_groups": null,
              "is_all_store_views": null,
              "customer_group": null,
              "store_view": null,
              "disabled": "0",
              "disabled_by_values": "0",
              "selection_limit_from": "0",
              "selection_limit_to": "0",
              "dropdown_value": [
                {
                  "title": "s1",
                  "option_type_id": 1098,
                  "price": 0,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"0.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"s1\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": "[[\"172\",\"1094\"]]",
                  "dependency_type": "0",
                  "cost": "3.000000",
                  "images_data": null,
                  "is_default": "0",
                  "qty_multiplier": "0",
                  "weight": "3333.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "0"
                },
                {
                  "title": "s2",
                  "option_type_id": 1099,
                  "price": 0,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"0.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"s2\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": "[[\"172\",\"1094\"]]",
                  "dependency_type": "0",
                  "cost": "22.000000",
                  "images_data": null,
                  "is_default": "0",
                  "qty_multiplier": "0",
                  "weight": "333.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "0"
                },
                {
                  "title": "s3",
                  "option_type_id": 1100,
                  "price": 0,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"0.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"s3\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": "[[\"172\",\"1094\"]]",
                  "dependency_type": "0",
                  "cost": "123.000000",
                  "images_data": null,
                  "is_default": "1",
                  "qty_multiplier": "0",
                  "weight": "222.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "0"
                },
                {
                  "title": "s4",
                  "option_type_id": 1101,
                  "price": 0,
                  "price_type": "FIXED",
                  "sku": "",
                  "mageworx_option_type_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"0.000000\"}]",
                  "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"s4\"}]",
                  "special_price": null,
                  "tier_price": null,
                  "description": "[{\"store_id\":\"0\",\"description\":\"value description\"}]",
                  "dependency": "[[\"172\",\"1094\"]]",
                  "dependency_type": "0",
                  "cost": "123.000000",
                  "images_data": null,
                  "is_default": "0",
                  "qty_multiplier": "0",
                  "weight": "222.000000",
                  "weight_type": "fixed",
                  "qty": "0.0000",
                  "manage_stock": "0",
                  "disabled": "1"
                }
              ]
            },
            {
              "__typename": "CustomizableAreaOption",
              "title": "area default",
              "required": true,
              "sort_order": 6,
              "option_id": 175,
              "qty_input": "0",
              "div_class": "test div class",
              "one_time": "0",
              "is_swatch": "0",
              "is_hidden": "0",
              "mageworx_option_gallery": "0",
              "mageworx_option_image_mode": "0",
              "description": "[{\"store_id\":\"0\",\"description\":\"option description\"}]",
              "sku_policy": "use_config",
              "is_all_customer_groups": null,
              "is_all_store_views": null,
              "customer_group": null,
              "store_view": null,
              "disabled": "0",
              "disabled_by_values": "0",
              "selection_limit_from": "0",
              "selection_limit_to": "0",
              "area_value": {
                "max_characters": 0,
                "price_type": "FIXED",
                "price": 100,
                "sku": "",
                "mageworx_option_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"100.000000\"}]",
                "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"area\"},{\"store_id\":\"1\",\"title\":\"area default\"},{\"store_id\":\"2\",\"title\":\"area en_GB\"}]",
                "dependency": "[[\"172\",\"1092\"],[\"172\",\"1093\"],[\"172\",\"1094\"]]",
                "dependency_type": "0"
              }
            },
            {
              "__typename": "CustomizableFieldOption",
              "title": "field deafult",
              "required": true,
              "sort_order": 7,
              "option_id": 176,
              "qty_input": "0",
              "div_class": "test div class",
              "one_time": "0",
              "is_swatch": "0",
              "is_hidden": "0",
              "mageworx_option_gallery": "0",
              "mageworx_option_image_mode": "0",
              "description": "[{\"store_id\":\"0\",\"description\":\"option description\"}]",
              "sku_policy": "use_config",
              "is_all_customer_groups": null,
              "is_all_store_views": null,
              "customer_group": null,
              "store_view": null,
              "disabled": "0",
              "disabled_by_values": "0",
              "selection_limit_from": "0",
              "selection_limit_to": "0",
              "field_value": {
                "max_characters": 0,
                "price_type": "FIXED",
                "price": 200,
                "sku": "",
                "mageworx_option_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"200.000000\"}]",
                "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"field\"},{\"store_id\":\"1\",\"title\":\"field deafult\"},{\"store_id\":\"2\",\"title\":\"field en_GB \"}]",
                "dependency": "[[\"171\",\"1090\"],[\"171\",\"1091\"]]",
                "dependency_type": "0"
              }
            },
            {
              "__typename": "CustomizableDateOption",
              "title": "date",
              "required": true,
              "sort_order": 8,
              "option_id": 177,
              "qty_input": "0",
              "div_class": "test div class",
              "one_time": "0",
              "is_swatch": "0",
              "is_hidden": "0",
              "mageworx_option_gallery": "0",
              "mageworx_option_image_mode": "0",
              "description": "[{\"store_id\":\"0\",\"description\":\"option description\"}]",
              "sku_policy": "use_config",
              "is_all_customer_groups": null,
              "is_all_store_views": null,
              "customer_group": null,
              "store_view": null,
              "disabled": "0",
              "disabled_by_values": "0",
              "selection_limit_from": "0",
              "selection_limit_to": "0",
              "date_value": {
                "price_type": "FIXED",
                "price": 300,
                "sku": "",
                "mageworx_option_price": "[{\"store_id\":\"0\",\"price_type\":\"fixed\",\"price\":\"300.000000\"}]",
                "mageworx_title": "[{\"store_id\":\"0\",\"title\":\"date\"}]",
                "dependency": "[[\"170\",\"1087\"],[\"170\",\"1088\"],[\"170\",\"1089\"]]",
                "dependency_type": "0"
              }
            }
          ]
        }
      ]
    }
  }
}
```
</details>

Please also see additional GraphQL requests below:

### Dependency State:
Calculate the dependency and the default state. It returns the values that should be hidden and/or selected as the default, when the customers select certain options.

<details>
  <summary>Dependency state request</summary>

```graphql 
{
    dependencyState (
        productSku: "testMW"
        selectedValues: "2419,2420"
    ) {
        hidden_options
        hidden_values
        preselected_values
    }
}
```
</details>
<details>
  <summary>Dependency state response</summary>

```graphql 
{
  "data": {
    "dependencyState": {
      "hidden_options": [
        174,
        175,
        176,
        177
      ],
      "hidden_values": [
        1098,
        1099,
        1100,
        1101
      ],
      "preselected_values": "{\"73\":[2419]}"
    }
  }
}
```
</details>
<details>
  <summary>Dependency state errors response</summary>

```graphql 
{
  "errors": [
    {
      "message": "Selected value '2420' is wrong and should be hidden",
      "extensions": {
        "category": "graphql-input"
      },
      "locations": [
        {
          "line": 2,
          "column": 3
        }
      ],
      "path": [
        "dependencyState"
      ]
    }
  ],
  "data": {
    "dependencyState": null
  }
}
```
</details>

**Note**:
The 'Dependency state' request should be used if you use the dependent options. You should send the 'Dependency state' request each time the customer selects an option's value on the front-end to get the list of values that should be hidden or pre-selected. You should keep all selected values in this request. I.e. you should add the new selected value, keeping the previous values in this request so the extension will be able to calculate the dependency correctly.

The 'DependencyState' response contains the objects, which include the following keys:

- **hidden_options** - the array with option IDs, which should be hidden.
- **hidden_values** - the array with values IDs, which should be hidden.
- **preselected_values** - the JSON row, which contains the array with the structure "key - array with valules", where the "key" is the option ID, the "array with valules" - values IDs.

The "preselected_values" duplicates the values, sent in the request, and adds the values, which should be shown and might be pre-selected.

If you do not want to use this approach to calculate the dependencies and the default state for some reasons, we added the 'dependency_rules' fields to the Products request and response *(see the Products request and response above for more details)*.

Otherwise, we recommend to remove the 'dependency_rules' fields from the Products request to improve the performance.

The 'dependency_rules' is the JSON row with the array of the rules. Every rule is the array with the following structure:

- **conditions** - it is the array with the conditions. The possible keys inside each condition: {"values":["2418"],"type":"!eq","id":73}, where <br />
  --- "id" - the option ID, <br />
  --- "values" - the IDs of the values, <br />
  --- "type" - possible values "eq" and "!eq", which means "equal", "not equal". <br />
  The condition in this example will be valid if the value with ID "2418" of the option  "73" is not selected.

- **condition_type** - it is the logical operator, which is used to combine the conditions. Possible values: "OR", "AND".

- **actions** - it is the action that should be performed if the conditions are met. Example: {"hide":{"74":{"values":{"2420":2420},"id":74}}}. The current available action is the "hide" only. This example hides the value with ID "2420" of the option "74".

**Note**:
The values exist for "selectable" options only. For the option types like "field", the "values" will be empty.

The "hidden_dependents" row has the same structure as the "DependencyState" *(described above)*.


### Advanced Product Options Settings:
This query contains all Advanced Product Options configuration setting which you can see in the admin stores -> configuration -> Mageworx -> Advanced Product Options tab

<details>
  <summary>Advanced Product Options Settings request</summary>

```graphql 
{
  advancedProductOptionsSettings {
      product_price_display_mode
      is_enabled_additional_product_price_field
      additional_product_price_field_label
      additional_product_price_field_mode
      is_qty_input_enabled
      default_qty_label
      is_option_value_description_enabled
      is_option_description_enabled
      get_option_description_mode
      selection_limit_template_data
      base_image_thumbnail_height
      base_image_thumbnail_width
      tooltip_image_thumbnail_size
      is_enabled_shareable_link
      shareable_link_text
      shareable_link_hint_text
      shareable_link_success_text
      is_load_linked_product_enabled
      is_enabled_fide_value_price
      is_enabled_hide_product_page_value_price
      is_enabled_customize_and_add_to_cart_button
      is_show_swatch_title
      is_show_swatch_price
      swatch_width
      swatch_height
      text_swatch_max_width
      is_enabled_option_inventory
      is_display_option_inventory_on_frontend
      is_display_out_of_stock_message
      is_display_out_of_stock_message_on_options_level
      is_display_out_of_stock_options
      is_require_hidden_out_of_stock_options
      is_special_price_enabled
      is_tier_price_enabled
      is_display_tier_price_table_needed
  }
}
```
</details>

<details>
  <summary>Advanced Product Options Settings response</summary>

```graphql 
{
  "data": {
    "advancedProductOptionsSettings": {
      "product_price_display_mode": "disabled",
      "is_enabled_additional_product_price_field": false,
      "additional_product_price_field_label": "Total Price:",
      "additional_product_price_field_mode": "final_price",
      "is_qty_input_enabled": false,
      "default_qty_label": "Qty: ",
      "is_option_value_description_enabled": true,
      "is_option_description_enabled": true,
      "get_option_description_mode": 1,
      "selection_limit_template_data": "{\"selection_limit_from_message\":\"Please choose {selection_limit_from} values at least\",\"selection_limit_to_message\":\"Please choose {selection_limit_to} values max\",\"selection_limit_from_to_message\":\"Please choose from {selection_limit_from} to {selection_limit_to} values\"}",
      "base_image_thumbnail_height": 35,
      "base_image_thumbnail_width": 0,
      "tooltip_image_thumbnail_size": 130,
      "is_enabled_shareable_link": false,
      "shareable_link_text": "Get shareable link",
      "shareable_link_hint_text": "Get the link to the product with selected options",
      "shareable_link_success_text": "Link copied to clipboard",
      "is_load_linked_product_enabled": false,
      "is_enabled_fide_value_price": false,
      "is_enabled_hide_product_page_value_price": false,
      "is_enabled_customize_and_add_to_cart_button": false,
      "is_show_swatch_title": false,
      "is_show_swatch_price": false,
      "swatch_width": 35,
      "swatch_height": 35,
      "text_swatch_max_width": "90",
      "is_enabled_option_inventory": true,
      "is_display_option_inventory_on_frontend": true,
      "is_display_out_of_stock_message": true,
      "is_display_out_of_stock_message_on_options_level": false,
      "is_display_out_of_stock_options": true,
      "is_require_hidden_out_of_stock_options": true,
      "is_special_price_enabled": true,
      "is_tier_price_enabled": true,
      "is_display_tier_price_table_needed": false
    }
  }
}
```
</details>

The 'AdvancedProductOptionsSettings' response contains the params, which include the following keys:

- **product_price_display_mode** - the string with "Product Price Display Mode" param
- **is_enabled_additional_product_price_field** - the boolean with "Enable additional product price field" param
- **additional_product_price_field_label** - the string with "Addition product price field label" param
- **additional_product_price_field_mode** - the string with "Addition product price field mode" param
- **is_qty_input_enabled** - the boolean with "Enable qty input feature" param
- **default_qty_label** - the string with "Qty label" param
- **is_option_value_description_enabled** - the boolean with "nable Option's Value Description" param
- **is_option_description_enabled** - the boolean with "Enable Option Description" param
- **get_option_description_mode** - the int with "Get Option Description mode. 0 - No, 1 - Tooltip, 2 - Plain Text Beside Option" param
- **selection_limit_template_data** - the json with selection limit tamplate data
- **base_image_thumbnail_height** - the int with "Base image height" param
- **base_image_thumbnail_width** - the int with "Base image width" param
- **tooltip_image_thumbnail_size** - Int @doc(description: "Tooltip image size" param
- **is_enabled_shareable_link** - the boolean with "Enable shareable link feature" param
- **shareable_link_text** - the string with "Shareable link text" param
- **shareable_link_hint_text** - the string with "Shareable link hint text" param
- **shareable_link_success_text** - the string with "Shareable link success text" param
- **is_load_linked_product_enabled** - the boolean with "Enable Load Linked Product feature" param
- **is_enabled_fide_value_price** - the boolean with "Enable Hide Value Price feature" param
- **is_enabled_hide_product_page_value_price** - the boolean with "Enable 'Hide Value Price' On Product Page" param
- **is_enabled_customize_and_add_to_cart_button** - the boolean with "Enable 'Customize and Add to cart' button" param
- **is_show_swatch_title** - the boolean with "Display swatch as title" param
- **is_show_swatch_price** - the boolean with "Show price in swatch" param
- **swatch_width** - the int with "Swatch width" param
- **swatch_height** - the int with "Swatch height" param
- **text_swatch_max_width** - the string with "Swatch max width" param
- **is_enabled_option_inventory** - the boolean with "Enable option inventory feature" param
- **is_display_option_inventory_on_frontend** - the boolean with "Display Option Qty on Front-end" param
- **is_display_out_of_stock_message** - the boolean with "Display Out-Of-Stock message" param
- **is_display_out_of_stock_message_on_options_level** - the boolean with "Display Out-Of-Stock message on options level" param
- **is_display_out_of_stock_options** - the boolean with "Out-Of-Stock options. If true - out of stock options are disable If false - hide" param
- **is_require_hidden_out_of_stock_options** - the boolean with "Show required 'Out of stock' options" param
- **is_special_price_enabled** - the boolean with "Check if special price is enabled" param
- **is_tier_price_enabled** - the boolean with "Check if tier price is enabled" param
- **is_display_tier_price_table_needed** - the boolean with "Check if it is needed to display tier price table" param


### Product Extend Config:
This query contains different arguments which can help you to work with the advanced product options on the frontend.

<details>
  <summary>Product Extend Config request</summary>

```graphql 
{
  productExtendConfig (
      productSku: "testMW"
      qty: 1
  ) {
      option_json_config
      product_json_config
      locale_price_format
      product_final_price_incl_tax
      product_final_price_excl_tax
      product_regular_price_incl_tax
      product_regular_price_excl_tax
      price_display_mode
      catalog_price_contains_tax
  }
}
```
</details>

<details>
  <summary>Product Extend Config response</summary>

```graphql 
{
  "data": {
    "productExtendConfig": {
      "option_json_config": "{\"170\":{\"1087\":{\"prices\":{\"oldPrice\":{\"amount\":1,\"amount_excl_tax\":1,\"amount_incl_tax\":1},\"basePrice\":{\"amount\":1},\"finalPrice\":{\"amount\":1}},\"type\":\"fixed\",\"name\":\"1\",\"stockMessage\":\"(111)\",\"valuePrice\":\"$1.00\",\"tier_price_display_data\":[],\"title\":\"1\"},\"1088\":{\"prices\":{\"oldPrice\":{\"amount\":110,\"amount_excl_tax\":110,\"amount_incl_tax\":110},\"basePrice\":{\"amount\":90},\"finalPrice\":{\"amount\":90}},\"type\":\"fixed\",\"name\":\"2\",\"stockMessage\":\"(222)\",\"valuePrice\":\"$110.00\",\"special_price_display_node\":\"+$90.00 (Regular Price: $110.00. )\",\"tier_price_display_data\":[],\"title\":\"2\"},\"1089\":{\"prices\":{\"oldPrice\":{\"amount\":123,\"amount_excl_tax\":123,\"amount_incl_tax\":123},\"basePrice\":{\"amount\":123},\"finalPrice\":{\"amount\":123}},\"type\":\"fixed\",\"name\":\"3\",\"stockMessage\":\"(333)\",\"valuePrice\":\"$123.00\",\"tier_price_display_data\":{\"3\":{\"price\":100,\"customer_group_id\":\"32000\",\"price_type\":\"fixed\",\"date_from\":\"\",\"date_to\":\"\",\"qty\":\"3\",\"price_incl_tax\":100,\"percent\":19},\"4\":{\"price\":90,\"customer_group_id\":\"32000\",\"price_type\":\"fixed\",\"date_from\":\"\",\"date_to\":\"\",\"qty\":\"4\",\"price_incl_tax\":90,\"percent\":27},\"5\":{\"price\":80,\"customer_group_id\":\"32000\",\"price_type\":\"fixed\",\"date_from\":\"\",\"date_to\":\"\",\"qty\":\"5\",\"price_incl_tax\":80,\"percent\":35}},\"title\":\"3\"}},\"171\":{\"1090\":{\"prices\":{\"oldPrice\":{\"amount\":22,\"amount_excl_tax\":22,\"amount_incl_tax\":22},\"basePrice\":{\"amount\":22},\"finalPrice\":{\"amount\":22}},\"type\":\"fixed\",\"name\":\"r1\",\"valuePrice\":\"$22.00\",\"tier_price_display_data\":[],\"title\":\"r1\"},\"1091\":{\"prices\":{\"oldPrice\":{\"amount\":11,\"amount_excl_tax\":11,\"amount_incl_tax\":11},\"basePrice\":{\"amount\":11},\"finalPrice\":{\"amount\":11}},\"type\":\"fixed\",\"name\":\"r2\",\"valuePrice\":\"$11.00\",\"tier_price_display_data\":[],\"title\":\"r2\"}},\"172\":{\"1092\":{\"prices\":{\"oldPrice\":{\"amount\":1,\"amount_excl_tax\":1,\"amount_incl_tax\":1},\"basePrice\":{\"amount\":1},\"finalPrice\":{\"amount\":1}},\"type\":\"fixed\",\"name\":\"c1\",\"valuePrice\":\"$1.00\",\"tier_price_display_data\":[],\"title\":\"c1\"},\"1093\":{\"prices\":{\"oldPrice\":{\"amount\":2,\"amount_excl_tax\":2,\"amount_incl_tax\":2},\"basePrice\":{\"amount\":2},\"finalPrice\":{\"amount\":2}},\"type\":\"fixed\",\"name\":\"c2\",\"valuePrice\":\"$2.00\",\"tier_price_display_data\":[],\"title\":\"c2\"},\"1094\":{\"prices\":{\"oldPrice\":{\"amount\":3,\"amount_excl_tax\":3,\"amount_incl_tax\":3},\"basePrice\":{\"amount\":3},\"finalPrice\":{\"amount\":3}},\"type\":\"fixed\",\"name\":\"c3\",\"valuePrice\":\"$3.00\",\"tier_price_display_data\":[],\"title\":\"c3\"}},\"173\":{\"1095\":{\"prices\":{\"oldPrice\":{\"amount\":0,\"amount_excl_tax\":0,\"amount_incl_tax\":0},\"basePrice\":{\"amount\":0},\"finalPrice\":{\"amount\":0}},\"type\":\"fixed\",\"name\":\"m1\",\"valuePrice\":\"$0.00\",\"tier_price_display_data\":[],\"title\":\"m1\"},\"1096\":{\"prices\":{\"oldPrice\":{\"amount\":0,\"amount_excl_tax\":0,\"amount_incl_tax\":0},\"basePrice\":{\"amount\":0},\"finalPrice\":{\"amount\":0}},\"type\":\"fixed\",\"name\":\"m2\",\"valuePrice\":\"$0.00\",\"tier_price_display_data\":[],\"title\":\"m2\"},\"1097\":{\"prices\":{\"oldPrice\":{\"amount\":0,\"amount_excl_tax\":0,\"amount_incl_tax\":0},\"basePrice\":{\"amount\":0},\"finalPrice\":{\"amount\":0}},\"type\":\"fixed\",\"name\":\"m3\",\"valuePrice\":\"$0.00\",\"tier_price_display_data\":[],\"title\":\"m3\"}},\"174\":{\"1098\":{\"prices\":{\"oldPrice\":{\"amount\":0,\"amount_excl_tax\":0,\"amount_incl_tax\":0},\"basePrice\":{\"amount\":0},\"finalPrice\":{\"amount\":0}},\"type\":\"fixed\",\"name\":\"s1\",\"valuePrice\":\"$0.00\",\"tier_price_display_data\":[],\"title\":\"s1\"},\"1099\":{\"prices\":{\"oldPrice\":{\"amount\":0,\"amount_excl_tax\":0,\"amount_incl_tax\":0},\"basePrice\":{\"amount\":0},\"finalPrice\":{\"amount\":0}},\"type\":\"fixed\",\"name\":\"s2\",\"valuePrice\":\"$0.00\",\"tier_price_display_data\":[],\"title\":\"s2\"},\"1100\":{\"prices\":{\"oldPrice\":{\"amount\":0,\"amount_excl_tax\":0,\"amount_incl_tax\":0},\"basePrice\":{\"amount\":0},\"finalPrice\":{\"amount\":0}},\"type\":\"fixed\",\"name\":\"s3\",\"valuePrice\":\"$0.00\",\"tier_price_display_data\":[],\"title\":\"s3\"},\"1101\":{\"prices\":{\"oldPrice\":{\"amount\":0,\"amount_excl_tax\":0,\"amount_incl_tax\":0},\"basePrice\":{\"amount\":0},\"finalPrice\":{\"amount\":0}},\"type\":\"fixed\",\"name\":\"s4\",\"valuePrice\":\"$0.00\",\"tier_price_display_data\":[],\"title\":\"s4\"}},\"175\":{\"prices\":{\"oldPrice\":{\"amount\":100,\"amount_excl_tax\":100,\"amount_incl_tax\":100},\"basePrice\":{\"amount\":100},\"finalPrice\":{\"amount\":100}},\"type\":\"fixed\",\"name\":\"area default\",\"valuePrice\":\"$100.00\",\"title\":\"area default\"},\"176\":{\"prices\":{\"oldPrice\":{\"amount\":200,\"amount_excl_tax\":200,\"amount_incl_tax\":200},\"basePrice\":{\"amount\":200},\"finalPrice\":{\"amount\":200}},\"type\":\"fixed\",\"name\":\"field deafult\",\"valuePrice\":\"$200.00\",\"title\":\"field deafult\"},\"177\":{\"prices\":{\"oldPrice\":{\"amount\":300,\"amount_excl_tax\":300,\"amount_incl_tax\":300},\"basePrice\":{\"amount\":300},\"finalPrice\":{\"amount\":300}},\"type\":\"fixed\",\"name\":\"date\",\"valuePrice\":\"$300.00\",\"title\":\"date\"}}",
      "product_json_config": "{\"absolute_price\":\"1\",\"type_id\":\"simple\",\"extended_tier_prices\":[],\"regular_price_excl_tax\":123,\"regular_price_incl_tax\":123,\"final_price_excl_tax\":123,\"final_price_incl_tax\":123,\"is_display_both_prices\":false,\"price\":123}",
      "locale_price_format": "{\"pattern\":\"$%s\",\"precision\":2,\"requiredPrecision\":2,\"decimalSymbol\":\".\",\"groupSymbol\":\",\",\"groupLength\":3,\"integerRequired\":false,\"priceSymbol\":\"$\"}",
      "product_final_price_incl_tax": 123,
      "product_final_price_excl_tax": 123,
      "product_regular_price_incl_tax": 123,
      "product_regular_price_excl_tax": 123,
      "price_display_mode": 1,
      "catalog_price_contains_tax": false
    }
  }
}
```
</details>

The 'ProductExtendConfig' response contains the params, which include the following keys:

- **option_json_config** - the json with option config
- **product_json_config** - the json with product config
- **locale_price_format** - the json with local price format
- **product_final_price_incl_tax** - the float with product final price incl tax param
- **product_final_price_excl_tax** - the float with product final price excl tax param
- **product_regular_price_incl_tax** - the float with product regular price incl tax param
- **product_regular_price_excl_tax** - the float with product regular price excl tax param
- **price_display_mode** - the int with price display mode param
- **catalog_price_contains_tax** - the boolean with catalog price contains tax param

The 'option_json_config' has all value prices with included and excluded taxes, also has tier and special value data in
ready to display format.

The 'product_json_config' contains advanced product option attributes, product tier price data, product type,
regular and final prouct prices with inc. and excl. taxes and product price display mode.

The 'locale_price_format' has params to display product price format.


### Product Final Price:
The query has base and final product prices which contain a total price with selected options and option values

<details>
  <summary>Product Final Price request</summary>

```graphql 
{
    productFinalPrice (
        productSku: "testMW"
        currentOptions: "{\"170\":\"1088\",\"175\":\"\"}"
        currentQty: 1
    ) {
        final_price
        base_price
    }
}
```
</details>

<details>
  <summary>Product Final Price response</summary>

```graphql 
{
  "data": {
    "productFinalPrice": {
      "final_price": 190,
      "base_price": 190
    }
  }
}
```
</details>

The 'ProductFinalPrice' request contains the next arguments:

- **productSku** - product sku
- **currenctOptions** - it is the json with the seleted options ans option values. The example condition: {\"170\":\"1088\",\"175\":\"\"}, where <br />
  --- "170" and "175" - the option ID, <br />
  --- "1088" - the option value ID, <br />
- **currentQty** - current product qty
  Note: The values exist for "selectable" options only. For the option types like "field", the "value ID" will be empty.

The 'ProductFinalPrice' response contains the actual base and final prices which will be calculated with selected options using this query, which include the following keys:

- **base_price** - the float with base product price param
- **final_price** - the float with final product price param


### Swatch Media Data
Contains all data about advanced product option swatch feature. It's like images paths, roles, mode and others.

<details>
  <summary>Swatch Media Data request</summary>

```graphql 
{
    swatchMediaData (
        productSku: "testMW"
        width: 90
        height: 90
    ) {
        swatch_media_data
    }
}
```
</details>
<details>
  <summary>Swatch Media Data response</summary>

```graphql 
{
  "data": {
    "swatchMediaData": {
      "swatch_media_data": "{\"options\":{\"170\":{\"type\":\"drop_down\",\"mageworx_option_gallery\":\"0\",\"mageworx_option_image_mode\":\"0\",\"sort_order\":\"1\",\"values\":{\"1087\":{\"sort_order\":\"1\",\"images\":{\"667\":{\"value_id\":\"667\",\"option_type_id\":\"1087\",\"position\":\"1\",\"file\":\"\\/8\\/a\\/8a288a.jpg\",\"label\":\"\",\"custom_media_type\":\"color\",\"color\":\"8a288a\",\"disabled\":\"0\",\"url\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/8\\/a\\/35x35\\/8a288a.jpg\",\"replace_main_gallery_image\":\"1\",\"overlay_image\":\"0\",\"base_image\":\"1\",\"tooltip_image\":\"1\",\"full\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/8\\/a\\/8a288a.jpg\",\"img\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/8\\/a\\/8a288a.jpg\",\"thumb\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/8\\/a\\/90x90\\/8a288a.jpg\"}},\"overlay_image_url\":\"\"},\"1088\":{\"sort_order\":\"2\"},\"1089\":{\"sort_order\":\"3\"}}},\"171\":{\"type\":\"radio\",\"mageworx_option_gallery\":\"1\",\"mageworx_option_image_mode\":\"1\",\"sort_order\":\"2\",\"values\":{\"1090\":{\"sort_order\":\"1\",\"images\":{\"668\":{\"value_id\":\"668\",\"option_type_id\":\"1090\",\"position\":\"1\",\"file\":\"\\/0\\/0\\/0034e0.jpg\",\"label\":\"\",\"custom_media_type\":\"color\",\"color\":\"0034e0\",\"disabled\":\"0\",\"url\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/0\\/0\\/35x35\\/0034e0.jpg\",\"replace_main_gallery_image\":\"1\",\"overlay_image\":\"0\",\"base_image\":\"1\",\"tooltip_image\":\"1\",\"full\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/0\\/0\\/0034e0.jpg\",\"img\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/0\\/0\\/0034e0.jpg\",\"thumb\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/0\\/0\\/90x90\\/0034e0.jpg\"}},\"overlay_image_url\":\"\"},\"1091\":{\"sort_order\":\"2\",\"images\":{\"669\":{\"value_id\":\"669\",\"option_type_id\":\"1091\",\"position\":\"1\",\"file\":\"\\/b\\/f\\/bf64bf.jpg\",\"label\":\"\",\"custom_media_type\":\"color\",\"color\":\"bf64bf\",\"disabled\":\"0\",\"url\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/b\\/f\\/35x35\\/bf64bf.jpg\",\"replace_main_gallery_image\":\"1\",\"overlay_image\":\"0\",\"base_image\":\"1\",\"tooltip_image\":\"1\",\"full\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/b\\/f\\/bf64bf.jpg\",\"img\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/b\\/f\\/bf64bf.jpg\",\"thumb\":\"http:\\/\\/magento246.test\\/media\\/mageworx\\/optionfeatures\\/product\\/option\\/value\\/b\\/f\\/90x90\\/bf64bf.jpg\"}},\"overlay_image_url\":\"\"}}},\"172\":{\"type\":\"checkbox\",\"mageworx_option_gallery\":\"0\",\"mageworx_option_image_mode\":\"0\",\"sort_order\":\"3\",\"values\":{\"1092\":{\"sort_order\":\"1\"},\"1093\":{\"sort_order\":\"2\"},\"1094\":{\"sort_order\":\"3\"}}},\"173\":{\"type\":\"multiple\",\"mageworx_option_gallery\":\"0\",\"mageworx_option_image_mode\":\"0\",\"sort_order\":\"4\",\"values\":{\"1095\":{\"sort_order\":\"1\"},\"1096\":{\"sort_order\":\"2\"},\"1097\":{\"sort_order\":\"3\"}}},\"174\":{\"type\":\"drop_down\",\"mageworx_option_gallery\":\"0\",\"mageworx_option_image_mode\":\"0\",\"sort_order\":\"5\",\"values\":{\"1098\":{\"sort_order\":\"1\"},\"1099\":{\"sort_order\":\"2\"},\"1100\":{\"sort_order\":\"3\"},\"1101\":{\"sort_order\":\"4\"}}}},\"option_types\":[\"field\",\"area\",\"file\",\"drop_down\",\"radio\",\"checkbox\",\"multiple\",\"date\",\"date_time\",\"time\"],\"render_images_for_option_types\":[\"drop_down\",\"radio\",\"checkbox\",\"multiple\"],\"option_gallery_type\":{\"disabled\":0,\"beside_option\":1,\"once_selected\":2}}"
    }
  }
}
```
</details>

The 'SwatchMediaData' response contains the params, which include the following keys:

- **swatch_media_data** - the json with swatch media data
