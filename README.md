# Installation

* U should run sql file on mysql server where /tinyscada.sql
* U should set definers where /config/default.php 
* Tag Update EndPoint is => SITE_URL/nodes/saveNodeValue?serialNumber={device_seri_no}&tagName={tag_name}&tagValue={tag_value}

serialNumber => int
tagName => string
tag_value => double

# Tag Names of the Scada

* sicaklik => u can see your temperature data in this tagName
* nem => u can see your Humiduty data in this tagName
* di1 = > u can see your digital input 1 data in this tagName
* di2 = > u can see your digital input 2 data in this tagName
* do1  = > u can see your digital output 1 data in this tagName (u can set this tag)
