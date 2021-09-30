# chat-app
One to One chat app. (Laravel /PusherJs/VueJs)
## Live Demo
- http://hds-chat.herokuapp.com/

## Installation Guid


- Download the Project file
- Create .env file in root folder
- Run Command Composer Install
- Run Command npm install
- Run command npm run dev 
- Create Pusher Account and create demo app




## Generate App Key
- php artisan key:generate

-

## (.env) file updates


create below rows in your .env file

- APP_URL=(http://url)
- Create Database Connection
- BROADCAST_DRIVER=pusher
- PUSHER_APP_ID="your-app-id"
- PUSHER_APP_KEY="your-app-key"
- PUSHER_APP_SECRET="your-app-secret"
- PUSHER_APP_CLUSTER="cluster"


## Database Migration and Seeding Data
- php artisan migrate --seed



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

