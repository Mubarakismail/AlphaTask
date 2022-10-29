## Alpha Task

### installing

-   Clone project from `git clone https://github.com/Mubarakismail/AlphaTask.git`.
-   In directory of project type `composer install`.
-   After that type `copy .env.example .env`.
-   In .env file edit DB credentials
-   Run project in local.

### endpoints

* register new user `host\api\register` with data (name, email, password).
* user login `host\api\login` with data (email, password).
* create product `host\api\products`in post with data (name_ar => name in arabic,name_en => name in english) and api_token of user as a parameter.
* get product name `host\api\products\{id}`in get as method of request with header (lang => 'ar' or 'en') and don't forget to send api_token as a parameter.
