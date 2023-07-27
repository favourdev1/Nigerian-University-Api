# Nigerian University API

This API provides information about Nigerian universities, including details such as name, state, city, abbreviation, website, and university type. Below are the available routes and their functionalities:

## Routes

### Get All Universities

- **URL:** `/university`
- **Method:** GET
- **Description:** Retrieves a list of all Nigerian universities (limited to 20 universities).
- **Success Response:**
  - Status Code: 200 OK
  - Format: JSON
  - Example:

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


