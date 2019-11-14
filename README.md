# Slim Framework 4 Skeleton Application

This is my first attempt to play with Slim. I am just in the process to get familiar with the framework so some things I think are a bit clunky

## Testing

```
 php -S localhost:8080 -t public public/index.php
```

### PHPUnit
I am not a fan of using the container directly in the test. I am not yet familiar how to test the Actions directly. I think that's my next part.
In addition, mostly tested the happy path. Because the rest of the classes contain almost no body, I didn't spend much time testing those


I haven't spend much time testing the domain yet. I tested just the service.

## Assumptions

I made a lot of assumption here.
* Each order will have a different and independent strategy to do the delivery
* The validation is required prior to process the order. If it fails, the order fails
* The notification to the email campaign provider is not transactional
with the processing of the order itself, therefore, could be done asyncronously (even though the implementation is still sync)

