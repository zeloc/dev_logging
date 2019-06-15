To add this to magento you will need to add it to the composer.json under "repositories"
```
    "repositories": [
        {
            "type": "composer",
            "url": "https://repo.magento.com/"
        }, 
        {
            "type": "vcs",
            "url": "https://github.com/zeloc/dev_logging.git"
        }
    ]
```	
Then you need to install it but you will need to add ```@dev``` to get around any limitations on requirements:

```
composer require dev/logdata
```
the above represents the name that is defined in the modules composer.json

To add logging you just need to call the static method, place the line:
```
\Dev\LogData\Model\LogData::log($dataToLog);

To use the controller the devtest/test/index
```
