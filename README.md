# TD Ameritrade PHP SDK

This package acts as the PHP SDK for the [TD Ameritrade API](https://developer.tdameritrade.com/apis).

>THIS PACKAGE IS NOT COMPLETE, USE AT YOUR OWN RISK. 

>DUE TO THE DELAYS IN TDAMERITRADE API (ORDERS CREATED/FILLED/CANCELLED) DO NOT COME THROUGH THE WEB SOCKET TILL 10 MINUTES AFTER THE ACTIVITY HAPPENS. THIS HAPPENS WHEN THE MARKET IS OPEN. IF THAT DOESN'T BOTHER YOU, FEEL FREE TO USE THIS SDK AND SUBMIT PULL REQUESTS. 

Examples are located in the `/tests` directory, you can run `phpunit ./tests` after editing the `.env` and uncommenting the `return true` on specific methods you want to try. I have decided not to continue development on this SDK due to the limitations set on the API, sorry there isn't proper documentation. I guess that fits, because TD documentation is the worst. Feel free to contact me directly if you have any questions. 

## License

**tdameritrade-php-sdk** (This Repository) is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

This SDK has no affiliation with TD Ameritrade, tdameritrade.com and TD Ameritrade IP Company and acts as an unofficial SDK designed to be a simple solution with using PHP applications. **Use at your own risk**. If you have any issues with the SDK please submit an issue or pull request.