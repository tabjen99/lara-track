# LaraTrack

LaraTrack brings you convinience to automatically create Trello card when system hitted exceptions.

## Getting Started
These instructions will get you a laravel packages.Everything is simple & easy ! 

### Dependency
* gregoriohc/laravel-trello
### Prerequisites
You must need to have a trello account, please prepare a board,and a List for laraTrack to insert cards.
Able to access trello account and generate Access Token for API integration.

[Example]

### Installation
1. Login to Trello via browser.
2. Get Access token via this link - *(https://trello.com/app-key/)
3. Get 2 items from authentication page.: Key & Token 
   p/s : Token is not auto generated. you have to grant permissions to generate token. 
   https://trello.com/1/authorize?expiration=never&scope=read,write,account&response_type=token&name=Server%20Token&key=[YOUR KEY HERE]
4. Let's begin our laravel plugin installation :
```
composer require tabjen99/lara-track
```
5. Publish Trello Config :
```
php artisan vendor:publish --provider="Gregoriohc\LaravelTrello\TrelloServiceProvider"
```
6. Configure Provider & Alias in Config/app.php

Provider
```
'providers' => [
  ...
  Gregoriohc\LaravelTrello\TrelloServiceProvider::class,
   miketan\laraTrack\laraTrackServiceProvider::class,
],
```
Alias
```
'aliases' => [
  ...
  'Trello' => Gregoriohc\LaravelTrello\Facades\Wrapper::class,
  'TrelloCrashReport' =>miketan\laraTrack\CrashReportFacade::class,
],

```
6. In config/trello.php enter api_key, api_token, board, & list
7. Publish migration file & perform migration.
```
php artisan vendor:publish --tag=migrations 
php artisan migrate
```
8. Clear Cache & log config:
```
php artisan config:cache
```
### Usage
9. Replace function report(Exception $e) in app/exceptions/Handler.php to :
```
 public function report(Exception $e)
  {
      \TrelloCrashReport::CountOrCreate($e);
      return parent::report($e);
  }
```
## Complete
If you completed steps above , laraTrack is successfully configured and running

-- -- Happy Tracking -- --
