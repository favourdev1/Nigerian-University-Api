# Nigerian University API

This API provides information about Nigerian universities, including details such as name, state, city, abbreviation, website, and university type. Below are the available routes and their functionalities:


## Endpoints

- [Get All Universities](#get-all-universities)
- [Get University Details by Name or Abbreviation](#get-university-details-by-name-or-abbreviation)
- [Get Universities in a Particular City](#get-universities-in-a-particular-city)
- [Get Universities in a Particular State](#get-universities-in-a-particular-state)
- [Get All Private Universities](#get-all-private-universities)
- [Get Private Universities in a Particular State](#get-private-universities-in-a-particular-state)

## Response Format

The API follows a structured response format in JSON. Both success and error responses contain a `success` key to indicate the status of the request.

- **Success Response:**
  - Status Code: 200 OK
  - Format: JSON

```json
{
  "success": true,
  "data": {
    "universities": [
      {
        "name": "University of Lagos",
        "state": "Lagos",
        "city": "Lagos",
        "abbreviation": "UNILAG",
        "website": "https://www.unilag.edu.ng",
        "university_type": "Federal"
      },
      // More universities...
    ]
  }
}
```



- **Success Response:**
  - Status Code: 403 OK
  - Format: JSON

``` 
{
  "success": false,
  "error": {
    "code": 403,
    "message": "Invalid parameter passed"
  }
}
```

       

## Endpoints

- ### Get All Universities
    - **Url** : **`/university`**
    - **Method**: GET
    - **Description: Retrieves a list of all Nigerian universities (limited to 20 universities).

- ### Get University Details by Name or Abbreviation
    - **Url**: **`/university/details/{name}`**
    - **Method**: GET
    - **Description: Retrieves university details based on its name or abbreviation.

- ### Get Universities in a Particular City
    - **Url**: **`/university/city/{city}`**
    - **Method**: GET
    - **Description**: Retrieves a list of universities located in a particular city.
    
- ### Get Universities in a Particular State
    - **Url**: **`/university/state/{state}`**
    - **Method**: GET
    - **Description**: Retrieves a list of universities located in a particular state.
- ### Get All Private Universities
    - **Url**: **`/university/private/`**
    - **Method**: GET
    - **Description**: Retrieves a list of all private Nigerian universities (limited to 20 universities).
- ### Get Private Universities in a Particular State
    - **Url**: **`/university/private/{state}`**
    - **Method**: GET
    - **Description**: Retrieves a list of private universities located in a particular state.
    <br>
  
## Note
The API is for educational and informational purposes only.
The data provided is based on the available records at the time of retrieval and may be subject to change.
