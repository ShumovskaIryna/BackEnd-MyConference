Example of http call
```
curl --location --request GET '/api/v1/conferences'
```

## Example of response 
```json
{
    "data": [
        {
            "id": "1",
            "name": "NAME_TEST_1",
            "date": 1232222222,
            "lat": "34",
            "lng": "35",
            "country": "UKRAINE"
        },
        {
            "id": "2",
            "name": "NAME_TEST_2",
            "date": 1232222222,
            "lat": "34",
            "lng": "35.4232",
            "country": "GREAT BRITAIN"
        }
    ]
}
```