Spain Validator
================

Librería que posibilita la validación de datos específicos de España con Symfony Validator

El listado de estos datos es:

 - Teléfono fijo
 - Teléfono móvil
 - Cualquier teléfono
 - Código postal
 - DNI
 - CIF
 - DNI Y CIF

## Instalación

Lanzamos instalación mediante Composer
```bash

$  composer require esteveli/spain-validator

```
## Ejemplo de uso

Uso desde la entidad:

```php
<?php

namespace App\Entity;

// Validación extra, telefono, DNI/NIF...
use Esteveli\SpainValidator\Validator\Constraints as SpainValidator;

class MyEntity {
    #[SpainValidator\AllPhone]
    private string $telefono;

    #[Assert\Length(max: 9)]
    #[SpainValidator\Phone]
    private string $telefonoFijo;
    
    #[Assert\Length(max: 9)]
    #[SpainValidator\MobilePhone]
    private $telefonoMovil;
    
    #[SpainValidator\ZipCode]
    private $codigoPostal;

    #[SpainValidator\DniCif]
    private $dniCif;

    #[SpainValidator\Dni]
    private $dni;

    #[SpainValidator\Cif]
    private $cif;
    
    # Getters and setters ....
}
```

En futuras actualizaciones se añadirá mas documentación mas detallada y tests.

Fork directo de avegao/SpainValidatorBundle (https://github.com/avegao/SpainValidatorBundle) actualizado
