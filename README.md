# Mini ERP system
Installation:
1. ```composer update```
2. Set up your ```.env``` file
3. ```php artisan migrate --seed```

Test admin:
- Login: ```admin@admin.admin```
- Pass: ```123456```

Test user:
- Login: ```user@user.user```
- Pass: ```123456```

Test Excel sheet:
- In the project derectory you may find a test excel sheet ```test.xlsx``` for import.

RESTful API:

The Passport service provider registers its own database migration directory. Make sure to ```php artisan migrate``` and ```php artisan passport:install```

1. Register and login:
After ```/api/login``` you receive the token for API operations (api:auth)

2. CRUD for ```Project```:
- Default routes (resource)
```/api/projects```
!! Auth middleware is disabled !!
