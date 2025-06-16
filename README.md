# MVClearPhp

A simple and lightweight PHP framework that implements the Model-View-Controller (MVC) architectural pattern. Designed to be easy to understand and extend, MVClearPhp is an excellent starting point for building web applications or learning about MVC architecture.

## Installation

To use MVClearPhp, you'll need a web server with PHP support. Follow these steps to get started:

```bash
git clone https://github.com/Vimpil/MVClearPhp.git
```

- Configure your web server (e.g., Apache, Nginx) to point to the `public` directory.  
- If your application requires a database, set up the connection by editing the configuration file (e.g., `config/database.php`).

For a complete list of dependencies, see the `composer.json` file. If Composer is used, run:

```bash
composer install
```

## Usage

MVClearPhp follows the standard MVC structure:

- **Models**: Define your data structures and business logic in the `app/models` directory.  
- **Views**: Create your templates in the `app/views` directory.  
- **Controllers**: Handle requests and interact with models and views in the `app/controllers` directory.

### Example

**Define a route**  
In `config/routes.php`, add a new route:

```php
$router->get('/hello', 'HelloController@index');
```

**Create a controller**  
In `app/controllers/HelloController.php`:

```php
class HelloController extends Controller {
    public function index() {
        return view('hello');
    }
}
```

**Create a view**  
In `app/views/hello.php`:

```php
<h1>Hello, World!</h1>
```

Visit `/hello` in your browser to see the result.

## Features

- Simple routing system for handling HTTP requests  
- Easy-to-use templating for views  
- Basic ORM for database interactions  
- Modular structure for easy extension and customization  

## Technologies Used

- PHP  
- Composer (for dependency management)  

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue if you find any bugs or have suggestions for improvements.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
