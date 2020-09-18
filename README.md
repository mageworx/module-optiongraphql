This GraphQL extension is the add-on for the [Advanced Product Options Suite](https://www.mageworx.com/magento-2-advanced-product-options-suite.html) module for Magento 2. It adds the support of the GraphQL API to retrieve all APO features on the PWA store fronts.

Our extension extends the standard products GraphQL request to add all our fields. You can remove the unnecessay fields manually if they are not applicable to your configuration.

- **Products request:** - click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_Products_-_request.txt) to download.
- **Products response:** - click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_Products_-_response.txt) to download.

We developed the separate GraphQL request to calculate the dependency and the default state. It returns the values that should be hidden and/or selected as the default, when the customers select certain options. 

- **Dependency state request** - click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_DependencyState_-_request.txt) to download.
- **Dependency state response** - click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_DependencyState_-_response.txt) to download.
- **Dependency state errors response** - click [here](https://support.mageworx.com/images/manuals/apo/GraphQl_-_DependencyState_-_error.txt) to download. This is the error example, that can occur if certain values in the 'Dependency state' request are added as selected, but they should be hidden. I.e. this error occurs if the selected values in the 'Dependency state' request are incorrect.

**Note**:
The 'Dependency state' request should be used if you use the dependent options. You should send the 'Dependency state' request each time the customer selects an option's value on the front-end to get the list of values that should be hidden or pre-selected. You should keep all selected values in this request. I.e. you should add the new selected value, keeping the previous values in this request so the extension will be able to calculate the dependency correctly.

The 'DependencyState' response contains the objects, which include the following keys:

- **hidden_options** - the array with option IDs, which should be hidden.
- **hidden_values** - the array with values IDs, which should be hidden.
- **preselected_values** - the JSON row, which contains the array with the structure "key - array with valules", where the "key" is the option ID, the "array with valules" - values IDs.

The "preselected_values" duplicates the values, sent in the request, and adds the values, which should be shown and might be pre-selected.

If you do not want to use this approach to calculate the dependencies and the default state for some reasons, we added the 'dependency_rules' fields to the Products request and response *(see the Products request and response above for more details)*. 

Otherwise, we recommend to remove the 'dependency_rules' fields from the Products request to improve the performance.

The 'dependency_rules' is the JSON row with the array of the rules. Every rule is the arraw with the following structure:

- **conditions** - it is the array with the conditions. The possible keys inside each condition: {"values":["2418"],"type":"!eq","id":73}, where <br />
--- "id" - the option ID, <br />
--- "values" - the IDs of the values, <br />
--- "type" - possible values "eq" и "!eq", which means "equal", "not equal". <br />
The condition in this example will be valid if the value with ID "2418" of the option  "73" is not selected.

- **condition_type** - it is the logic operator, which is used to combine the conditions. Possible values: "OR", "AND".

- **actions** - it is the action that should be performed if the conditions are met. Example: {"hide":{"74":{"values":{"2420":2420},"id":74}}}. The current available action is the "hide" only. This example hides the value with ID "2420" of the option "74".

**Note**:
The values exist for "selectable" options only. For the option types like "field", the "values" will be empty.

The "hidden_dependents" row has the same structure as the "DependencyState" *(described above)*.
