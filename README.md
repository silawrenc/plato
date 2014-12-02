Plato
=====

### Basic usage

Call `validate($value, $schema)` to validate a value, where `schema` is a callable or array of callables, each returning any string message on validation failure, or `null` on success.

````php
//returns null
validate('Reginald', message('valid.name' required()));
````

With multiple rules
````php
//returns ['valid.name']
validate('Sue', message('valid.name' [required()), minlength(5), alphanumeric()]));
````

With multiple messages
````php
//returns ['name.alphanumeric']
validate('Z*nder', [message('name.exists' required()), message('name.alphanumeric', alphanumeric())]);
````
### validating schemas

use the `plato()` and `rule()` functions to build validation schemas. e.g.

````php
$schema = plato([
  rule('name.valid', 'name', [required(), alphanumeric()]),
  rule('password.valid', 'password', [required(), minlength(8)]),
  rule('passwords.match', ['password', 'repeat'], identical())
]);

$badinput = [
  'name' => 'joe bloggs',
  'password' => 'asdf',
  'repeat' => 'aa'
];

//returns ['password.valid', 'passwords.match']
validate($badinput, $schema);

$validinput = [
  'name' => 'joe bloggs',
  'password' => 'password',
  'repeat' => 'password'
];

//returns []
validate($validinput, $schema);
````

### the message function

The `message()` function just binds a closure to a message; if the closure returns falsy then the message is returned. This is useful for closing over any of the library validation functions

### the rule function

The `rule()` function creates a schema rule by binding the given message and keys to the validation functions. The signature is
````php
rule($message, $keys, $callables)
````
where `$message` is a string, `$keys` is a string key name or array of string key names, and `$callables` is a callable or array of callables.  Calling `rule()` returns a closure that acts on an associative array, and passes all of the specified keys through to each of the given closures. If they all return true, then `null` is returned - otherwise the message is returned.


### the assert function
Assert behaves exactly like validate, except it throws a `PlatoException` with the first message as its message.
