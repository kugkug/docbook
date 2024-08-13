# MyDrsAppt API

Backend API 

## GET ALL

```bash
TYPE    : GET
URL     : https://api.mydrsappt.com/api/v1/patients
```
```bash
Returns list of Patients.
```
##

## FETCH PATIENT

```bash
TYPE    : GET
URL     : https://api.mydrsappt.com/api/v1/patients/{id}
```
```bash
Returns single info of a Patient.
```
##

## STORE

```bash
TYPE    : POST
URL     : https://api.mydrsappt.com/api/v1/patients
```
```bash
Add new patient.

Parameters:
{
    "title": "",
    "firstname": "",
    "lastname": "",
    "gender": ""
    "email": "",
    "contact_number" : "",
    "zip_code" : ""
}
```
##

## UPDATE

```bash
TYPE    : PUT / PATCH
URL     : https://api.mydrsappt.com/api/v1/patients/{id}
```
```bash
Update existing patient

Parameters:
{
    "title": "",
    "firstname": "",
    "lastname": "",
    "gender": ""
    "email": "",
    "contact_number" : "",
    "zip_code" : ""
}
```
##