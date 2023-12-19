This GraphQL module is the add-on for the [Advanced Product Options Suite](https://www.mageworx.com/magento-2-advanced-product-options-suite.html) module for Magento 2. It adds support for the GraphQL API to use the features provided by APO extension on PWA store fronts.

Our module extends original Magento products GraphQL request to add our attributes. You can remove the unnecessay attributes manually if they are not applicable for your configuration.

<details>
  <summary>Products request</summary>

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_Products_-_request.txt) to download.
</details>
<details>
  <summary>Products response</summary>

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_Products_-_response.txt) to download.
</details>

Please also see additional GraphQL requests below: 

### Dependency State: 
Calculate the dependency and the default state. It returns the values that should be hidden and/or selected as the default, when the customers select certain options. 

<details>
  <summary>Dependency state request</summary>

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_DependencyState_-_request.txt) to download.
</details>
<details>
  <summary>Dependency state response</summary>

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_DependencyState_-_response.txt) to download.
</details>
<details>
  <summary>Dependency state errors response</summary>

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_DependencyState_-_error.txt) to download.
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
--- "type" - possible values "eq" и "!eq", which means "equal", "not equal". <br />
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

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_AdvancedProductOptionsSettings_-_request.txt) to download.
</details>

<details>
  <summary>Advanced Product Options Settings response</summary>

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_AdvancedProductOptionsSettings_-_response.txt) to download.
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

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_ProductExtendConfig_-_request.txt) to download.
</details>

<details>
  <summary>Product Extend Config response</summary>

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_ProductExtendConfig_-_response.txt) to download.
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

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_ProductFinalPrice_-_request.txt) to download.
</details>

<details>
  <summary>Product Final Price response</summary>

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_ProductFinalPrice_-_response.txt) to download.
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

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_SwatchMediaData_-_request.txt) to download.
</details>
<details>
  <summary>Swatch Media Data response</summary>

Click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_SwatchMediaData_-_response.txt) to download.
</details>

The 'SwatchMediaData' response contains the params, which include the following keys:

- **swatch_media_data** - the json with swatch media data
