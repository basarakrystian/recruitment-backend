
# Requirements
- PHP 8.1
- Composer 2

# SETUP
- Clone repo: https://github.com/basarakrystian/recruitment-backend
- Open terminal and cd into project directory
```bash
composer install
cp .env.example .env
```
- Update .env file with database credentials
```bash
php artisan key:generate
php artisan config:cache
php artisan migrate
php artisan db:seed
php artisan serve
```
- You're ready to visit library at: http://127.0.0.1:8000

# API Examples


1. **Index (GET Request):**
   - Retrieve a list of books with optional query parameters.

```bash
curl -X GET "http://127.0.0.1:8000/books?category=1&search=Harry Potter" \ 
     -H "Authorization: Bearer your_access_token" \
     -H "X-Requested-With: XMLHttpRequest"
```

2. **Store (POST Request):**
   - Create a new book.

```bash
curl -X POST "http://127.0.0.1:8000/books" -H "Authorization: Bearer your_access_token" \
     -H "X-Requested-With: XMLHttpRequest"\
     -d "title=New Book" \
     -d "author=John Doe" \
     -d "description=This is a new book" \
     -d "year=2023" \
     -d "quantity=10" \
     -d "category_id=1"
```

3. **Show (GET Request):**
   - Retrieve details of a specific book by its ID.

```bash
curl -X GET "http://127.0.0.1:8000/books/1" -H "Authorization: Bearer your_access_token" \
     -H "X-Requested-With: XMLHttpRequest"
```

4. **Update (PUT Request):**
   - Update an existing book by its ID.

```bash
curl -X PUT "http://127.0.0.1:8000/books/1" -H "Authorization: Bearer your_access_token" \
     -H "X-Requested-With: XMLHttpRequest"\
     -d "title=Updated Book" \
     -d "author=Jane Doe" \
     -d "description=This is an updated book" \
     -d "year=2024" \
     -d "quantity=5" \
     -d "category_id=2"
```

5. **Destroy (DELETE Request):**
   - Delete a specific book by its ID.

```bash
curl -X DELETE "http://127.0.0.1:8000/books/1" -H "Authorization: Bearer your_access_token" \
     -H "X-Requested-With: XMLHttpRequest"
```


6. **Index (GET Request):**
    - Retrieve a list of categories.

```bash
curl -X GET "http://127.0.0.1:8000/categories" -H "Authorization: Bearer your_access_token" \
     -H "X-Requested-With: XMLHttpRequest"
```