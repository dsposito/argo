# Argo

Argo is a useful utility for shipping-related tasks. In particular, it deduces the shipping carrier, provider and other information based on a provided package tracking number.

In [Greek mythology](http://en.wikipedia.org/wiki/Argo), Argo (in Greek, meaning 'swift') was the ship on which Jason and the Argonauts sailed from Iolcos to retrieve the Golden Fleece. Argo was said to have been planned with the help of Athena - constructed with magical pieces of timber from the sacred forest of Dodona.

## Usage
Simply provide a tracking number when initializing a new package instance.

```
$package = Argo\Package::instance('420 90401 9405 5108 9841 6000 5592 67');

print_r($package);
```

Example output:

```
Argo\Package Object
(
    [tracking_code] => 9405510898416000559267
    [carrier] => Argo\Carrier Object
        (
            [code] => usps
            [name] => USPS
        )
    [provider] => Argo\Provider Object
        (
            [code] => endicia
            [name] => Endicia
        )
)
```
