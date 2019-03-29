To add this to magento you will need to add it to the composer.json under "repositories"
```
    "repositories": [
        {
            "type": "composer",
            "url": "https://repo.magento.com/"
        }, 
        {
            "type": "vcs",
            "url": "https://munrodev@bitbucket.org/munrodev/dev_logging.git"
        }
    ]
```	
Then you need to install it but you will need to add ```@dev``` to get around any limitations on requirements:

```
composer require doug/codetest @dev
```
the above represents the name that is defined in the modules composer.json
