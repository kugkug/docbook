# MyDrsAppt API

ackend API

## GET ALL

```bash
TYPE    : GET
URL     : https://api.mydrsappt.com/api/v1/doctors/
```

```bash
Returns list of Doctors.
```

##

## FETCH DOCTOR

```bash
TYPE    : GET
URL     : https://api.mydrsappt.com/api/v1/doctors/{id}
```

```bash
Returns single info of a Doctor.
```

##

## STORE

```bash
TYPE    : POST
URL     : https://api.mydrsappt.com/api/v1/doctors/register
```

```bash
Add new doctor.

Parameters:
{
    "title": "",
    "firstname": "",
    "lastname": "",
    "email": "",
    "password": "",
    "practice_name": "",
    "provider_specialty": "",
    "contact_number": "",
    "zip_code": "",
    "gender_info": ""
}
```

##

## UPDATE

```bash
TYPE    : PUT / PATCH
URL     : https://api.mydrsappt.com/api/v1/doctors/{id}
```

```bash
Update existing doctor

Parameters:
{
    "title": "",
    "firstname": "",
    "lastname": "",
    "email": "",
    "practice_name": "",
    "provider_specialty" : "",
    "contact_number" : "",
    "zip_code" : ""
}
```

##

# Doctor's Schedule

##

## STORE

```bash
TYPE    : POST
URL     : https://api.mydrsappt.com/api/v1/doctors/schedule
```

```bash
Headers : Bearer Token
Returns the added schedule.
```

##

## UPDATE

```bash
TYPE    : PATCH
URL     : https://api.mydrsappt.com/api/v1/doctors/schedule/{id}
```

```bash
Headers : Bearer Token
Returns the modified schedule.
```

##

## FETCH SCHEDULES

```bash
TYPE    : GET
URL     : https://api.mydrsappt.com/api/v1/doctor/schedule/
```

```bash
Headers : Bearer Token
Returns Returns the list of schedule of the doctor currently logged in.
```

##

## GET SINGLE SCHEDULE

```bash
TYPE    : GET
URL     : https://api.mydrsappt.com//api/v1/doctor/schedule/{id}
```

```bash
Headers : Bearer Token
Returns Returns specific schedule of the doctor currently logged in.
```

##

## DELETE SCHEDULE

```bash
TYPE    : DELETE
URL     : https://api.mydrsappt.com//api/v1/doctor/schedule/{id}
```

```bash
Headers : Bearer Token
Returns Soft deletes the selected schedule.
```

##

## DOCTOR LOGIN

```bash
TYPE    : GET
URL     : https://api.mydrsappt.com/api/v1/login

PARAM:

{
    "email": "",
    "password": ""
}
```

```bash
Returns Returns Bearer token
```

##
