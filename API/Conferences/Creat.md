Example of http call
```curl
curl --location --request POST '/api/v1/add-conferences' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--header 'Cookie: PHPSESSID=d2ac1cbda307b1ce63341dd1a772be87' \
--data-urlencode 'name=Meeting witth Valik' \
--data-urlencode 'date=1661204937' \
--data-urlencode 'lat=25' \
--data-urlencode 'lng=32.23' \
--data-urlencode 'country=CANADA #'
```

# Response
code 200 OK
```
{
    "id": number,
}
```