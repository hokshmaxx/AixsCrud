# AIXS CRUD TEST

This is a simple **Post Management System** built using **Laravel Livewire**.  
It follows the **Domain-Driven Design (DDD)** approach and includes an **HTTP API** for managing posts.

## Features

- Create, edit, and delete posts.
- Uses **Livewire** for real-time updates.
- Implements **DDD** for better code organization and maintainability.
- Provides an **HTTP API** to interact with posts.
- No authentication or authorization, as this is a simple test project.

## Installation

1. Clone the repository:
   ```sh
   git clone https://github.com/your-repo.git
   cd your-repo
   ```

2. Install dependencies:
   ```sh
   composer install
   npm install
   ```

3. Set up the environment file:
   ```sh
   cp .env.example .env
   ```

4. Generate the application key:
   ```sh
   php artisan key:generate
   ```

5. Run database migrations:
   ```sh
   php artisan migrate
   ```

6. Start the development server:
   ```sh
   php artisan serve
   ```

## API Endpoints

| Method | Endpoint       | Description            |
|--------|---------------|------------------------|
| GET    | `/api/posts`  | Get all posts         |
| GET    | `/api/posts/{id}` | Get a single post  |
| POST   | `/api/posts`  | Create a new post     |
| PUT    | `/api/posts/{id}` | Update a post     |
| DELETE | `/api/posts/{id}` | Delete a post     |

### Example API Request (Create a Post)

```sh
curl -X POST "http://localhost/api/posts" \
     -H "Content-Type: application/json" \
     -d '{"title": "My First Post", "content": "This is a test post"}'
```

## Notes

- This project **does not include authentication or authorization** since it is just a simple test.
- It is designed with **DDD principles**, separating concerns and keeping domain logic structured.
- The project includes an **HTTP API** for easy interaction with posts.
- The API is implemented as a **simple HTTP API** without authentication mechanisms.

## License

This project is open-source and available under the MIT license.

