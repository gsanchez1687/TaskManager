![admin task](taskmanager.png)

### Task Mananger

# Video 1
```
https://drive.google.com/file/d/1fcHBPeF7KtKXMEBanR7tKIjurjlQzvIW/view?usp=drive_link
```

# Video 2
```
https://drive.google.com/file/d/1us9USGlv65G38JJ0DDlnZ3mbXFrbo7bz/view?usp=drive_link
```
# Requeriment
```
PHP 8.3
mysql 5.x or superior
node 18.x or superior
composer
```

# Configuration Linux & Macos

##  First we need to have the project
```
Clone repository https
git clone https://github.com/InteliClic/ChoresAppGE.git

Clone repository ssh
git clone git@github.com:InteliClic/ChoresAppGE.git
```

## We install all the dependencies that the project needs
```
composer install
```

## We installed Node in the project
```
npm install
```

## We add the alias on the host
```
sudo nano /etc/hosts
127.0.0.1  choresappge.com
```

## We add the name of the database
```
Name DB
ChoresAppGE
```

## Let's migrate the tables to the database
```
php artisan migrate
```

## Now we need to add test data to the database
```
php artisan db:seed
```

## We carried out the project under the name of alias
```
php artisan serve --host=choresappge.com --port=8000
```

## We run the node to compile the files
```
npm run dev
```

## We run the cronjob to increase the time to tasks
```
php artisan schedule:work
```

## Open the browser and type this URL
```
http://choresappge.com:8000
```