
<!-- PROJECT SETUP -->
Copy the contents of env.example to .env
ADDITIONAL VARIABLES
ORDER_STEPS='["",""]' -> A list of steps an order takes when being processed
MONKEY_LEARN_API_KEY = ''
MONKEY_LEARN_MODEL = ''


External packages used: (composer)

MonkeyLearn/php

Queues and Jobs
- run php artisan queue:work --verbose (can also run as a daemon)

Remember to change APP_URL for mails to be rendered with the correct endpoint