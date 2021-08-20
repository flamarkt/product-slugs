# Product Slugs

Use unique slugs for product URLs instead of IDs.

After enabling the extension, change the driver under Admin > Basics.

To reduce the risk of issues when disabling this extension, the product database column is made unique but nullable.
If any product was created while the extension was disabled, a slug must be added for the product page to be accessible.
