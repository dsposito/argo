# Argo

Argo is a useful utility for shipping-related tasks. In particular, it deduces the shipping carrier, provider and other information based on a provided package tracking number.

In [Greek mythology](http://en.wikipedia.org/wiki/Argo), Argo (in Greek, meaning 'swift') was the ship on which Jason and the Argonauts sailed from Iolcos to retrieve the Golden Fleece. Argo was said to have been planned with the help of Athena - constructed with magical pieces of timber from the sacred forest of Dodona.

## Usage
Simply provide a tracking number when initializing a new package instance.

```
$package = Argo\Package::instance('1Z 3W4 72Y 42 9990 3055');

print_r($package);
```

Example output:

```
Argo\Package Object
(
    [tracking_code] => 1Z3W472Y4299903055
    [carrier] => Argo\Carrier Object
        (
            [code] => ups
            [name] => UPS
        )
    [provider] => Argo\Provider Object
        (
            [code] => ups
            [name] => UPS
        )
)
```
