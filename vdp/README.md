# Getting started on Visa Developer
### API key - Shared Secret (X-Pay-Token)

Some Visa APIs require API Key – Shared Secret authentication, which Visa refers to as `x-pay-token`. To invoke an API using `x-pay-token`, you will need an API Key and a Shared Secret, which is provided on the application details page as mentioned in the Visa Developer Portal introduction.

To successfully invoke Visa APIs using `x-pay-token`, your application needs to do the following:

1. Include the API Key as a query parameter
2. Include the `Accept` and `x-pay-token` in the request header as shown in the sample below.

|Field   |Value   |
| -------|:------:|
|Accept  |Application/json|
|x-pay-token|x-pay-token*|

**Note:** Refer to the section below on hwo to generate the `x-pay-token` value with SHA256 HMAC.

##### Sample Header #####
```
GET /vdp/helloworld?apikey=KSKDFJOP934ALSFDJP34 HTTP/1.0 
 Host: sandbox.api.visa.com
 Accept: application/json
 X-PAY-TOKEN: xv2:1455716783:f5d15ed23f825ac69cd42e6fa187a175ecf7e9566ce4f21e11bad49bed4cc363
 ```


**Generating the x-pay-token**

1. Build a string of concatenated values with the following parameters:

|Parameter     |Description     |
|--------------|:--------------:|
|timestamp     |Current *UTC* timestamp|
|resource_path |The API endpoint    |
|query_string  |The apiKey is a required query parameter.  |
|request_body  |The API endpoint-specific request body string.|

To get set up, navigate to:
https://developer.visa.com/vdpguide#x_pay_token
